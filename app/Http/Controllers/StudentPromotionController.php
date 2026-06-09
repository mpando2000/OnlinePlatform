<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SchoolClass;
use App\Models\StudentPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPromotionController extends Controller
{
    /**
     * Show the promotion management page
     */
    public function index()
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        // Get students who haven't been promoted to the next year yet
        $studentsToPromote = User::where('role', 'student')
            ->where('academic_year', $currentYear)
            ->whereNotNull('class_id')
            ->with('schoolClass')
            ->get();

        $classes = SchoolClass::all();
        $promotionHistory = StudentPromotion::with('student', 'fromClass', 'toClass')
            ->orderBy('promoted_at', 'desc')
            ->paginate(20);

        return view('admin.student-promotions.index', [
            'studentsToPromote' => $studentsToPromote,
            'classes' => $classes,
            'promotionHistory' => $promotionHistory,
            'currentYear' => $currentYear,
            'nextYear' => $nextYear,
        ]);
    }

    /**
     * Show the form to select students for promotion
     */
    public function showForm()
    {
        $currentYear = date('Y');
        $classes = SchoolClass::with('students')->get();

        return view('admin.student-promotions.form', [
            'classes' => $classes,
            'currentYear' => $currentYear,
        ]);
    }

    /**
     * Promote selected students to the next class
     */
    public function promote(Request $request)
    {
        $validated = $request->validate([
            'promotions' => 'required|array',
            'promotions.*.student_id' => 'required|exists:users,id',
            'promotions.*.to_class_id' => 'required|exists:school_classes,id',
        ]);

        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        $promotedCount = 0;
        $errors = [];

        DB::beginTransaction();

        try {
            foreach ($validated['promotions'] as $promotion) {
                $student = User::find($promotion['student_id']);
                $toClass = SchoolClass::find($promotion['to_class_id']);

                if (!$student || $student->role !== 'student') {
                    $errors[] = "Invalid student ID: {$promotion['student_id']}";
                    continue;
                }

                if (!$toClass) {
                    $errors[] = "Invalid class ID: {$promotion['to_class_id']}";
                    continue;
                }

                // Record the promotion in history
                StudentPromotion::create([
                    'student_id' => $student->id,
                    'from_class_id' => $student->class_id,
                    'to_class_id' => $promotion['to_class_id'],
                    'from_academic_year' => $currentYear,
                    'to_academic_year' => $nextYear,
                    'promoted_at' => now(),
                ]);

                // Update student's class and academic year
                $student->update([
                    'class_id' => $promotion['to_class_id'],
                    'academic_year' => $nextYear,
                ]);

                $promotedCount++;
            }

            DB::commit();

            return redirect()->route('admin.promotions.index')
                ->with('success', "{$promotedCount} student(s) promoted successfully.")
                ->with('errors', $errors);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'An error occurred during promotion: ' . $e->getMessage());
        }
    }

    /**
     * Bulk promote all students in selected classes
     */
    public function bulkPromote(Request $request)
    {
        $validated = $request->validate([
            'from_class_id' => 'required|exists:school_classes,id',
            'to_class_id' => 'required|exists:school_classes,id',
        ]);

        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        // Get all students in the from_class
        $students = User::where('role', 'student')
            ->where('class_id', $validated['from_class_id'])
            ->where('academic_year', $currentYear)
            ->get();

        if ($students->isEmpty()) {
            return redirect()->route('admin.promotions.index')
                ->with('warning', 'No students found in the selected class for this academic year.');
        }

        DB::beginTransaction();

        try {
            foreach ($students as $student) {
                // Record the promotion in history
                StudentPromotion::create([
                    'student_id' => $student->id,
                    'from_class_id' => $validated['from_class_id'],
                    'to_class_id' => $validated['to_class_id'],
                    'from_academic_year' => $currentYear,
                    'to_academic_year' => $nextYear,
                    'promoted_at' => now(),
                ]);

                // Update student's class and academic year
                $student->update([
                    'class_id' => $validated['to_class_id'],
                    'academic_year' => $nextYear,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.promotions.index')
                ->with('success', count($students) . ' student(s) promoted successfully from '
                    . SchoolClass::find($validated['from_class_id'])->name . ' to '
                    . SchoolClass::find($validated['to_class_id'])->name);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'An error occurred during bulk promotion: ' . $e->getMessage());
        }
    }

    /**
     * View promotion history
     */
    public function history()
    {
        $promotionHistory = StudentPromotion::with('student', 'fromClass', 'toClass')
            ->orderBy('promoted_at', 'desc')
            ->paginate(20);

        return view('admin.student-promotions.history', [
            'promotionHistory' => $promotionHistory,
        ]);
    }

    /**
     * View a student's promotion history
     */
    public function studentHistory(User $student)
    {
        if ($student->role !== 'student') {
            return redirect()->route('admin.promotions.index')
                ->with('error', 'User is not a student.');
        }

        $promotions = $student->promotions()
            ->with('fromClass', 'toClass')
            ->orderBy('promoted_at', 'desc')
            ->get();

        return view('admin.student-promotions.student-history', [
            'student' => $student,
            'promotions' => $promotions,
        ]);
    }

    /**
     * Undo a promotion (revert student to previous class)
     */
    public function undo(StudentPromotion $promotion)
    {
        DB::beginTransaction();

        try {
            $student = $promotion->student;
            $previousYear = $promotion->from_academic_year;
            $previousClass = $promotion->from_class_id;

            // Revert student to previous class and year
            $student->update([
                'class_id' => $previousClass,
                'academic_year' => $previousYear,
            ]);

            // Delete the promotion record
            $promotion->delete();

            DB::commit();

            return redirect()->back()
                ->with('success', 'Promotion has been undone successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'An error occurred while undoing promotion: ' . $e->getMessage());
        }
    }
}
