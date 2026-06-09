<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Subject;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\SchoolClass;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
 

    public function index(){
        $teacher = Auth::user();
        $classes = $teacher->classes;
        $totalSubjects = $teacher->teacherSubjects->count();
        $totalAssignments = Assignment::whereIn('class_id', $classes->pluck('id'))->where('submission_deadline', '>', now())->count(); 
        
        // Get students assigned to teacher's classes
        $assignedStudents = User::whereIn('class_id', $classes->pluck('id'))
            ->where('role', 'student')
            ->get();
        
        // Get dynamic school statistics
        $schoolStats = [];
        $schools = \App\Models\School::where('status', 'active')->get();
        
        foreach($schools as $school) {
            $count = $assignedStudents->where('school_id', $school->id)->count();
            if($count > 0) {
                $schoolStats[] = [
                    'name' => $school->name,
                    'count' => $count,
                    'color' => $this->getSchoolColor($school->id)
                ];
            }
        }
        
        // Add legacy school students
        $legacyStudents = $assignedStudents->whereNull('school_id')->groupBy(function($student) {
            return $student->school ?? 'Unknown';
        });
        
        foreach($legacyStudents as $school => $students) {
            if($school !== 'Unknown') {
                $schoolStats[] = [
                    'name' => ucfirst($school),
                    'count' => $students->count(),
                    'color' => $this->getLegacySchoolColor($school)
                ];
            }
        }
        
        // Additional statistics
        $totalStudents = $assignedStudents->count();
        $totalQuizzes = \App\Models\Quiz::whereIn('class_id', $classes->pluck('id'))->count();
        $recentSubmissions = \App\Models\Submission::whereHas('assignment', function($query) use ($classes) {
            $query->whereIn('class_id', $classes->pluck('id'));
        })->where('created_at', '>=', now()->subDays(7))->count();
        
        return view('teacher.dashboard',[
            'teacher' => $teacher,
            'classes' => $classes,
            'totalSubjects' => $totalSubjects,
            'totalAssignments' => $totalAssignments,
            'schoolStats' => $schoolStats,
            'totalStudents' => $totalStudents,
            'totalQuizzes' => $totalQuizzes,
            'recentSubmissions' => $recentSubmissions,
            // Keep legacy variables for backward compatibility
            'jitegemeeStudents' => $assignedStudents->where('school', 'jitegemee')->count(),
            'kawawaStudents' => $assignedStudents->where('school', 'kawawa')->count(),
        ]);
    }
    
    private function getSchoolColor($schoolId) {
        $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'bg-info', 'bg-secondary'];
        return $colors[($schoolId - 1) % count($colors)];
    }
    
    private function getLegacySchoolColor($schoolName) {
        $colorMap = [
            'jitegemee' => 'bg-warning',
            'kawawa' => 'bg-danger',
            'makongo' => 'bg-success'
        ];
        return $colorMap[strtolower($schoolName)] ?? 'bg-secondary';
    }

    public function teacherClassForm(){
        $school_classes = SchoolClass::all();
        return view('teacher.classForm',[
            'school_classes' => $school_classes
        ]);
    }

  

    public function teacherClasses()
{
    $userId = Auth::id(); 
    $user = User::findOrFail($userId); 

    $schoolClasses = $user->classes->unique('id');

    return view('teacher.classes', [
        'schoolClasses' => $schoolClasses
    ]);
}




    public function teacherAddClass(Request $request) {
        $inputData = $request ->validate([
            'name' => 'required|string|max:255',

        ]);


        SchoolClass::create($inputData);
        return redirect(route('teacher.classes'));
       
    }


    public function teacherViewClass(SchoolClass $school_class)
{
    $userId = Auth::id();
    $subjects = DB::table('teacher_class_subject_pivots')
        ->join('subjects', 'teacher_class_subject_pivots.subject_id', '=', 'subjects.id')
        ->where('teacher_class_subject_pivots.user_id', $userId)
        ->where('teacher_class_subject_pivots.class_id', $school_class->id)
        ->select('subjects.id', 'subjects.name')
        ->get();

    return view('teacher.class', [
        'subjects' => $subjects,
        'school_class' => $school_class
    ]);
}

    public function subjectForm(SchoolClass $school_class){
        return view('teacher.subjectForm' , [
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

        
        return redirect()->route('teacher.classes');
    }

    public function destroySubject(Subject $subject)
{
    $subject->delete();
    return redirect()->back();;
}



public function viewSubject(SchoolClass $class, Subject $subject)
{
    $materials = Material::where('subject_id', $subject->id)
                            ->where('class_id', $class->id)
                            ->get();
    
    return view('teacher.subject', compact('materials', 'subject', 'class'));
}



public function materialForm(SchoolClass $class, Subject $subject){
    return view('teacher.materialForm',[
        'subject' => $subject,
        'class' =>  $class
    ]);
}

public function addMaterial(Request $request,  SchoolClass $class, Subject $subject)
{
 
    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:document,link,video',
        'file' => 'required_if:type,document,video|mimes:pdf,docx,doc,zip,mp4,avi,mov|max:92160', // Allow PDF for documents and MP4 for videos
        'url' => 'nullable|url',
        'class_id' => 'required|exists:school_classes,id',
        'subject_id' => 'required|exists:subjects,id'
    ]);


    $filePath = null;
    $url = null;

    if ($request->type === 'document' || $request->type === 'video') {
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materials', 'public');
        }
    }


    if ($request->type === 'link') {
        $url = $request->url;
    }

    Material::create([
        'title' => $request->title,
        'type' => $request->type,
        'file_path' => $filePath,
        'url' => $url,
        'subject_id' => $subject->id,
        'class_id' => $class->id
    ]);
    return response()->json(['message' => 'Material uploaded successfully']);
}

public function showMaterial(Material $material)
{
    try {
        // Load the material with its subject relationship
        $material->load('subject');
        
        return view('teacher.materialView', compact('material'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Material not found or inaccessible.');
    }
}

public function downloadMaterial(Material $material)
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

public function destroyMaterial(Request $request, Material $material)
{
    try {
        // Store material title for success message
        $materialTitle = $material->title;
        
        // Delete file if it exists
        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }
        
        // Delete material record
        $material->delete();
        
        return redirect()->back()->with('success', "Material '{$materialTitle}' has been deleted successfully.");
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to delete material: ' . $e->getMessage());
    }
}



//blog 
public function blog(Request $request)
{
    $teacher = Auth::user();
    
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
    return view('teacher.blog.index', compact('messages','teacher'));
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
        return redirect()->route('teacher.blog')->with('success', 'Message sent successfully!');
        
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
        Log::error('Error storing teacher blog message: ' . $e->getMessage());
        
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the message. Please try again.'
            ], 500);
        }
        return back()->with('error', 'An error occurred while sending the message. Please try again.');
    }
}

// user management
public function users(){
    // Get all users except admins, with related data
    $users = User::with(['schoolClass', 'subjects'])
                 ->where('role', '!=', 'admin')
                 ->orderBy('role')
                 ->orderBy('firstname')
                 ->get();
    
    // Manually load school relationships since there might be conflicts with the old school field
    $users->each(function($user) {
        if ($user->school_id) {
            $user->schoolModel = \App\Models\School::find($user->school_id);
        }
    });
    
    // Separate users by role for better organization
    $students = $users->where('role', 'student');
    $teachers = $users->where('role', 'teacher');
    
    // Get statistics
    $stats = [
        'total_students' => $students->count(),
        'total_teachers' => $teachers->count(),
        'classes_count' => $students->pluck('class_id')->unique()->filter()->count(),
        'recent_registrations' => $users->where('created_at', '>=', now()->subWeeks(2))->count()
    ];
    
    return view('teacher.users', [
        'users' => $users,
        'students' => $students,
        'teachers' => $teachers,
        'stats' => $stats,
        'currentUser' => Auth::user()
    ]);
}
public function userForm(){
    $school_classes = SchoolClass::all();
    return view('teacher.usersForm',[
        'school_classes' => $school_classes,
    ]);
}

public function addUser(Request $request) {
    $inputData = $request ->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' =>'required|string|confirmed|min:8',
        'school'=>'required|in:jitegemee,kawawa',
        'role' => 'required|in:teacher,student',
        'class_id' => 'required_if:role,student|exists:school_classes,id'

    ]);


    User::create($inputData);
    return redirect(route('teacher.users'));
   
}



public function viewUser(User $user){
    $user->loadMissing(['school', 'schoolClass', 'subjects']);

    // Manually load school relationship for this user
    if ($user->school_id) {
        $user->schoolModel = \App\Models\School::find($user->school_id);
    }
    
    return view ('teacher.user', [
        'user' => $user
    ]);

}

public function editForm(User $user){
    $schools = \App\Models\School::orderBy('name')->get();
    $school_classes = SchoolClass::orderBy('name')->get();

    return view('teacher.editUser', [
        'user' => $user,
        'schools' => $schools,
        'school_classes' => $school_classes,
    ]);
}

public function updatedUser(User $user, Request $request){
    $formData = $request->validate([
        'firstname' => 'required|string|max:255',
        'secondname' => 'nullable|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'gender' => 'required|string|max:50',
        'role' => 'required|in:teacher,student',
        'school_id' => 'nullable|exists:schools,id',
        'school' => 'nullable|string|max:255',
        'class_id' => 'nullable|required_if:role,student|exists:school_classes,id',
    ]);

    if ($formData['role'] !== 'student') {
        $formData['class_id'] = null;
    }

    if (!empty($formData['school_id'])) {
        $school = \App\Models\School::find($formData['school_id']);
        $formData['school'] = $school ? $school->name : ($formData['school'] ?? null);
    }

    $user->update($formData);
    
    return redirect('/teacher/viewUser/' . $user->id)->with('success', 'User updated successfully.');

}
public function destroy(User $user){
    $user->delete();
    return redirect()->back();
}



}
    
