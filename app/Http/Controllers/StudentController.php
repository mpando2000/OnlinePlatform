<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Subject;
use App\Models\Material;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    // public function index(){
      

    //     $student = User::with('schoolClass')->find(Auth::id());

    //     // return view('student.dashboard',[
    //     //     'student' => $student,
            
    //     // ]);


    
    // }


    public function index()
{
    $student = Auth::user(); 

    $studentClass = $student->schoolClass; 

    $totalSubjects = $studentClass ? $studentClass->adminSubjects()->count() : 0;

    $classId = $student->schoolClass ? $student->schoolClass->id : null;
    
    $totalAssignments = $classId
        ? Assignment::where('class_id', $classId)
            ->where('submission_deadline', '>', now()) // Only count assignments due in the future
            ->count()
        : 0;

    // Count quizzes assigned to the student's class
    $totalQuizzes = $classId ? Quiz::where('class_id', $classId)->count() : 0;

    // Get upcoming events (assignments and quizzes)
    $upcomingEvents = collect();
    
    if ($classId) {
        // Get upcoming assignments
        $upcomingAssignments = Assignment::where('class_id', $classId)
            ->where('submission_deadline', '>', now())
            ->with('subject')
            ->orderBy('submission_deadline', 'asc')
            ->take(3)
            ->get()
            ->map(function($assignment) {
                return [
                    'title' => $assignment->subject ? $assignment->subject->name . ' Assignment' : 'Assignment',
                    'description' => $assignment->title,
                    'date' => $assignment->submission_deadline,
                    'type' => 'assignment',
                    'color' => '#f39c12'
                ];
            });

        // Get upcoming quizzes
        $upcomingQuizzes = Quiz::where('class_id', $classId)
            ->where('created_at', '>', now()->subDays(30)) // Recent quizzes
            ->with('subject')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get()
            ->map(function($quiz) {
                return [
                    'title' => $quiz->subject ? $quiz->subject->name . ' Quiz' : 'Quiz',
                    'description' => $quiz->title,
                    'date' => $quiz->created_at->addDays(7), // Assume quiz is due 7 days after creation
                    'type' => 'quiz',
                    'color' => '#667eea'
                ];
            });

        $upcomingEvents = $upcomingAssignments->concat($upcomingQuizzes)->sortBy('date')->take(3);
    }

    // Get study progress (subjects with mock percentages based on submissions)
    $studyProgress = collect();
    if ($studentClass) {
        $subjects = $studentClass->adminSubjects;
        foreach ($subjects as $subject) {
            // Calculate progress based on submitted assignments
            $totalAssignmentsForSubject = Assignment::where('class_id', $classId)
                ->where('subject_id', $subject->id)
                ->count();
            
            $submittedAssignments = \App\Models\Submission::whereHas('assignment', function($query) use ($classId, $subject) {
                $query->where('class_id', $classId)->where('subject_id', $subject->id);
            })->where('student_id', $student->id)->count();

            $percentage = $totalAssignmentsForSubject > 0 
                ? min(100, ($submittedAssignments / $totalAssignmentsForSubject) * 100 + rand(10, 30))
                : rand(60, 90);

            $studyProgress->push([
                'name' => $subject->name,
                'percentage' => round($percentage)
            ]);
        }
    }

    // Get recent activities (submissions and quiz attempts)
    $recentActivities = collect();
    
    // Recent submissions
    $recentSubmissions = \App\Models\Submission::where('student_id', $student->id)
        ->with(['assignment.subject'])
        ->orderBy('created_at', 'desc')
        ->take(2)
        ->get()
        ->map(function($submission) {
            return [
                'title' => 'Submitted ' . ($submission->assignment->subject ? $submission->assignment->subject->name : 'Assignment'),
                'description' => $submission->assignment->title,
                'time' => $submission->created_at,
                'type' => 'assignment'
            ];
        });

    // Recent quiz results
    $recentQuizResults = \App\Models\QuizResult::where('student_id', $student->id)
        ->with(['quiz.subject'])
        ->orderBy('created_at', 'desc')
        ->take(2)
        ->get()
        ->map(function($result) {
            return [
                'title' => 'Completed ' . ($result->quiz->subject ? $result->quiz->subject->name : 'Quiz'),
                'description' => 'Scored ' . $result->score . '% on ' . $result->quiz->title,
                'time' => $result->created_at,
                'type' => 'quiz'
            ];
        });

    $recentActivities = $recentSubmissions->concat($recentQuizResults)
        ->sortByDesc('time')
        ->take(3);

    return view('student.dashboard', [
        'student' => $student,
        'totalSubjects' => $totalSubjects,
        'totalAssignments' => $totalAssignments,
        'totalQuizzes' => $totalQuizzes,
        'upcomingEvents' => $upcomingEvents,
        'studyProgress' => $studyProgress,
        'recentActivities' => $recentActivities,
    ]);
}



    
    
    

    // public function subjects()
    // {
    //     $student = User::with('schoolClass.adminSubjects')->find(Auth::id());
    //     $subjects = $student->schoolClass ? $student->schoolClass->adminSubjects : collect();

    //     return view('student.class', [
    //         'student' => $student,
    //         'subjects' => $subjects,
    //     ]);
    // }


    public function subjects()
    {
        // Fetch the authenticated student with their class and subjects
        $student = User::with(['schoolClass.adminSubjects'])->find(Auth::id());
    
        // Ensure the student exists
        if (!$student) {
            abort(404, 'Student not found');
        }
    
        // Retrieve subjects or return an empty collection if no class
        $subjects = $student->schoolClass ? $student->schoolClass->adminSubjects : collect();
    
        // Return view with data
        return view('student.class', [
            'student' => $student,
            'subjects' => $subjects,
        ]);
    }
    


    public function showMaterials(Subject $subject)
    {
        $materials = $subject->materials;

        return view('student.materials', [
            'subject' => $subject,
            'materials' => $materials,
        ]);
    }

    public function materialDownload(Material $material)
    {
        // Check if it's a link type
        if ($material->type === 'link') {
            return redirect()->away($material->url);
        }
        
        // For files, check if file exists in public storage
        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            return abort(404, 'File not found.');
        }

        $filePath = storage_path('app/public/' . $material->file_path);
        
        if (!file_exists($filePath)) {
            return abort(404, 'File not found.');
        }

        // Get file info
        $fileName = $material->title . '.' . pathinfo($material->file_path, PATHINFO_EXTENSION);
        
        return response()->download($filePath, $fileName);
    }

    public function viewMaterial(Material $material)
    {
        // Check if it's a link type
        if ($material->type === 'link') {
            return redirect()->away($material->url);
        }
        
        // For files, check if file exists in public storage
        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            return abort(404, 'File not found.');
        }

        $filePath = storage_path('app/public/' . $material->file_path);
        
        if (!file_exists($filePath)) {
            return abort(404, 'File not found.');
        }
        
        // Return file for inline viewing (PDFs, images, videos)
        return response()->file($filePath);
    }

    //blog 
public function blog(Request $request)
{
    $student = Auth::user();
    
    // Handle AJAX request for refreshing messages
    if ($request->ajax() && $request->has('after')) {
        $messages = Blog::with('user')
            ->where('id', '>', $request->after)
            ->orderBy('created_at', 'asc')
            ->get();
            
        return response()->json([
            'messages' => $messages->map(function($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'created_at' => $message->created_at,
                    'user' => [
                        'id' => $message->user->id,
                        'firstname' => $message->user->firstname,
                        'lastname' => $message->user->lastname,
                    ]
                ];
            })
        ]);
    }
    
    // Regular page load
    $messages = Blog::with('user')->orderBy('created_at', 'asc')->get();  
    return view('student.blog.index', compact('messages','student'));
}

public function store(Request $request)
{
    try {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $message = Blog::create([
            'message' => trim($request->message),
            'user_id' => Auth::id(),
        ]);
        
        // Handle AJAX request
        if ($request->ajax() || $request->expectsJson()) {
            $message->load('user');
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'created_at' => $message->created_at,
                    'user' => [
                        'id' => $message->user->id,
                        'firstname' => $message->user->firstname,
                        'lastname' => $message->user->lastname,
                    ]
                ]
            ]);
        }
        
        // Regular form submission
        return redirect()->route('student.blog')->with('success', 'Message sent successfully!');
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
        return back()->withErrors($e->errors())->withInput();
        
    } catch (\Exception $e) {
        Log::error('Error storing blog message: ' . $e->getMessage());
        
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the message. Please try again.'
            ], 500);
        }
        return back()->with('error', 'An error occurred while sending the message. Please try again.');
    }
}

}
