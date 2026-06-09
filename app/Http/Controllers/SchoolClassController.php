<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Material;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function classes(){
        $schoolClasses = SchoolClass::all();
        return view ('admin.classes', [
            'schoolClasses' => $schoolClasses
        ]);
    }

    public function classForm(){
        return view('admin.classForm');
    }

    public function addClass(Request $request) {
        $inputData = $request ->validate([
            'name' => 'required|string|max:255',

        ]);


        SchoolClass::create($inputData);
        return redirect(route('admin.classes'));
       
    }

    public function editClassForm(SchoolClass $school_class){
        return view('admin.editClassForm', compact('school_class'));
    }

    public function updateClass(Request $request, SchoolClass $school_class) {
        $inputData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $school_class->update($inputData);
        return redirect()->route('admin.classes')->with('success', 'Class updated successfully');
    }

    public function destroyClass(SchoolClass $school_class){
        $school_class->delete();
        return redirect()->back()->with('success', 'Class deleted successfully');
    }

    public function viewClass(SchoolClass $school_class){
       
        $subjects = $school_class->adminSubjects;
        return view ('admin.class', [
            'subjects' => $subjects ,
            'school_class' => $school_class
        ]);
    }
    public function teacherViewClass(SchoolClass $class)
    {
        $user = Auth::user(); 
    
        if (!$user || $user->role !== 'teacher') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
    
        $assignedSubjects = $class->subjects()->where('user_id', $user->id)->get();
    
        return view('teacher.class', [
            'school_class' => $class,
            'teacherSubjects' => $assignedSubjects,
        ]);
    }

    public function subjectForm(SchoolClass $school_class){
        return view('admin.subjectForm' , [
        'school_class' => $school_class
        ]);
    }



    public function addSubject(Request $request, SchoolClass $school_class) {
        // dd($request->all());
        $inputData = $request ->validate([
            'name' => 'required|string|max:255',
            'school_class_id' => 'required|exists:school_classes,id',

        ]);

        Subject::create($inputData);

        
        return redirect()->route('admin.classes');
    }

    public function destroySubject(Subject $subject)
{
    $subject->delete();
    return redirect()->back();;
}

    public function editSubjectForm(Subject $subject) {
        $school_class = $subject->schoolClass;
        return view('admin.editSubjectForm', [
            'subject' => $subject,
            'school_class' => $school_class
        ]);
    }

    public function updateSubject(Request $request, Subject $subject) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.class', $subject->school_class_id)
                        ->with('success', 'Subject updated successfully!');
    }


public function viewSubject(SchoolClass $class, Subject $subject)
{
    $materials = Material::where('subject_id', $subject->id)
                            ->where('class_id', $class->id)
                            ->get();
    
    

    return view('admin.materials.materialList', compact('materials', 'subject', 'class'));
}


public function getSubjects(Request $request)
{
    $classId = $request->query('class_id');
    if (!$classId) {
        return response()->json(['error' => 'Class ID is required'], 400);
    }
    $subjects = Subject::where('class_id', $classId)->get();
    
    return response()->json(['subjects' => $subjects]);
}


}