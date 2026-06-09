<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\School;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherSubjectClass;
use App\Models\TeacherClassSubjectPivot;
use App\Models\OnlineSession;

class AdminController extends Controller
{
  

    public function index(){
        $users = User::all();
        $classes = SchoolClass::all();
        $userCount = User::count();
        $classCount = SchoolClass::count();
        $teachersCount = User::where('role', 'teacher')->count();
        $studentsCount = User::where('role', 'student')->count();
        $inactiveCount = User::where('status', 'inactive')->count();
        
        // Enhanced statistics
        $schoolsCount = School::where('status', 'active')->count();
        $quizzesCount = Quiz::count();
        $recentRegistrations = User::where('created_at', '>=', now()->subDays(7))->count();
        
        // School distribution statistics
        $schoolStats = [];
        $schools = School::where('status', 'active')->get();
        
        foreach($schools as $school) {
            $studentCount = User::where('school_id', $school->id)->where('role', 'student')->count();
            $teacherCount = User::where('school_id', $school->id)->where('role', 'teacher')->count();
            
            if($studentCount > 0 || $teacherCount > 0) {
                $schoolStats[] = [
                    'name' => $school->name,
                    'students' => $studentCount,
                    'teachers' => $teacherCount,
                    'total' => $studentCount + $teacherCount
                ];
            }
        }
        
        // Add legacy school users
        $legacyUsers = User::whereNull('school_id')->whereNotNull('school')->get();
        $legacySchools = $legacyUsers->groupBy('school');
        
        foreach($legacySchools as $schoolName => $users) {
            $studentCount = $users->where('role', 'student')->count();
            $teacherCount = $users->where('role', 'teacher')->count();
            
            if($studentCount > 0 || $teacherCount > 0) {
                $schoolStats[] = [
                    'name' => ucfirst($schoolName),
                    'students' => $studentCount,
                    'teachers' => $teacherCount,
                    'total' => $studentCount + $teacherCount,
                    'legacy' => true
                ];
            }
        }
        
        // Recent activity
        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();
        $activeUsers = User::where('login_at', '>=', now()->subDays(1))->count();
        
        return view('admin.dashboard', [
            'stat' => [
                'users' => $users,
                'usersCount' => $userCount,
                'classCount' => $classCount,
                'inactiveCount' => $inactiveCount,
                'teachersCount' => $teachersCount,
                'studentsCount' => $studentsCount,
                'schoolsCount' => $schoolsCount,
                'quizzesCount' => $quizzesCount,
                'recentRegistrations' => $recentRegistrations,
                'activeUsers' => $activeUsers,
            ],
            'schoolStats' => $schoolStats,
            'recentUsers' => $recentUsers,
            'currentAdmin' => Auth::user(),
        ]);
    }
    public function users(){
        
        $users = User::with('schoolClass')->get();
        
        // Manually load school relationships to avoid eager loading issues
        foreach($users as $user) {
            if($user->school_id) {
                $user->school_relation = School::find($user->school_id);
            }
        }
        
        $schools = School::active()->orderBy('name')->get();
        return view ('admin.users', [
            'users' => $users,
            'schools' => $schools
        ]);
    }
    public function userForm(){
        $school_classes = SchoolClass::all();
        $schools = School::active()->orderBy('name')->get();
        return view('admin.userForm',[
            'school_classes' => $school_classes,
            'schools' => $schools,
        ]);
    }

    public function addUser(Request $request) {
        // dd($request->all());
        $inputData = $request ->validate([
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' =>'required|string|confirmed|min:8',
            'gender'=>'required|in:male,female,other',
            'school_id'=>'required|exists:schools,id',
            'role' => 'required|in:teacher,student',
            'class_id' => 'required_if:role,student|exists:school_classes,id'

        ]);


        User::create($inputData);
        return redirect(route('admin.users'));
       
    }



  

public function viewUser(User $user)
{
    // Manually load school relationship to avoid eager loading issues
    if($user->school_id) {
        $user->school_relation = School::find($user->school_id);
    }

    // Get the teacher's classes and subjects using the pivot table
    $assignedClasses = DB::table('teacher_class_subject_pivots')
        ->join('school_classes', 'teacher_class_subject_pivots.class_id', '=', 'school_classes.id')
        ->join('subjects', 'teacher_class_subject_pivots.subject_id', '=', 'subjects.id')
        ->where('teacher_class_subject_pivots.user_id', $user->id)
        ->select('school_classes.id as class_id', 'school_classes.name as class_name', 'subjects.name as subject_name')
        ->get()
        ->groupBy('class_name'); // Group subjects by class name

    return view('admin.user', [
        'user' => $user,
        'assignedClasses' => $assignedClasses
    ]);
}


    public function editForm(User $user){
        return view('admin.editUser', [
            'user' =>$user
        ]);
    }

    
    // public function updatedUser(User $user, Request $request)
    // {
    //     // Validate input fields
    //     $formData = $request->validate([
    //         'firstname' => 'required|string|max:255',
    //         'secondname' => 'required|string|max:255',
    //         'lastname' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'gender' => 'nullable|in:male,female',
    //         'school' => 'nullable|string|max:255',
    //         'role' => 'required|string|in:admin,teacher,student',
    //         'class' => 'nullable|exists:classes,id', // Optional
    //     ]);
    
    //     // Update the user
    //     $user->update($formData);
    
    //     // Redirect with success message
    //     return redirect()->route('admin.editUserForm', $user->id)->with('success', 'User updated successfully!');
    // }


    public function updatedUser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'captured_image' => 'nullable|string',
        ]);

        // $user = auth()->user();
        // if ($request->hasFile('profile_image')) {
        //     $file = $request->file('profile_image');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads/profile_images'), $filename);
    
        //     // Delete the old image if exists
        //     if ($user->profile_image && file_exists(public_path('uploads/profile_images/' . $user->profile_image))) {
        //         unlink(public_path('uploads/profile_images/' . $user->profile_image));
        //     }
    
        //     $user->profile_image = $filename;
        // }

       
    
        if ($request->has('captured_image') && $request->input('captured_image')) {
            // Handle the webcam capture image
            $imageData = $request->input('captured_image');
            
            // Decode Base64 string to actual image file
            $image = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $imageData));
            $filename = time() . '.png';
    
            // Save the decoded image to the server
            $path = public_path('uploads/profile_images/' . $filename);
            file_put_contents($path, $image);
    
            // Update the user's profile image field
            $user->profile_image = $filename;
        } elseif ($request->hasFile('profile_image')) {
            // Handle file upload
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_images'), $filename);
    
            $user->profile_image = $filename;
        }
    
        $user->update($validatedData);
    
        return redirect()->route('admin.editUserForm', $user->id)->with('success', 'User updated successfully!');
    }
    
    

    
    public function destroy(Request $request, User $user){
        // Prevent deletion when the user is referenced by online sessions
        $hasSessions = OnlineSession::where('teacher_id', $user->id)->exists();

        // If there are related sessions and no explicit force flag, block deletion with a message
        if ($hasSessions && !$request->boolean('force')) {
            return redirect()->back()->with('error', 'Cannot delete user: this user has active online sessions. Remove or reassign those sessions first, or submit with force=1 to delete sessions and the user.');
        }

        // If force parameter provided, remove related sessions first to avoid FK violation
        if ($hasSessions && $request->boolean('force')) {
            OnlineSession::where('teacher_id', $user->id)->delete();
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }



    public function updateUserStatus(Request $request, User $user)
    {
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }


    // reset password
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        return view('components.reset_password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Password reset successfully.');
    }




    public function createAdminUser()
    {
        $school_classes = SchoolClass::all();
        $schools = School::active()->orderBy('name')->get();
        return view('admin.adminUsers.create',compact('school_classes', 'schools'));
    }

    public function storeAdminUser(Request $request)
    {
        
       $inputData = $request->validate([
            'firstname' => 'required',
            'secondname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:male,female',
            'password' => 'required|confirmed|min:8',
            'school_id'=>'required|exists:schools,id',
            'role' => 'required|in:admin',
            'class_id' => 'required_if:role,student|exists:school_classes,id'

        ]);

        User::create($inputData);

        return redirect()->route('admin.users');
    }



    public function assignClassSubject($userId)
    {
        $teacher = User::with(['teacherSubjects' => function($query) {
            $query->withPivot('class_id', 'created_at', 'updated_at');
        }])->findOrFail($userId);
        
        $classes = SchoolClass::all();
        $subjects = Subject::all();

        return view('admin.adminUsers.assign-class-subject', compact('teacher', 'classes', 'subjects'));
    }



public function storeClassSubjectAssignment(Request $request, $teacherId)
{
    $validated = $request->validate([
        'classes.*' => 'required|exists:school_classes,id',
        'subjects.*' => 'required|exists:subjects,id',
    ]);


    foreach ($validated['classes'] as $index => $classId) {
        $subjectId = $validated['subjects'][$index];
        
        // Check if this class-subject pair is already assigned to the teacher
        $existingAssignment = DB::table('teacher_class_subject_pivots')
            ->where('user_id', $teacherId)
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->first();


        if (!$existingAssignment) {
            // Only insert if the assignment does not already exist
            DB::table('teacher_class_subject_pivots')->insert([
                'user_id' => $teacherId,
                'class_id' => $classId,
                'subject_id' => $subjectId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }


    return redirect()->route('admin.users')->with('success', 'Classes and subjects assigned successfully!');
}

public function removeClassAssignment(Request $request, $teacherId)
{
    $request->validate([
        'class_id' => 'required|exists:school_classes,id',
    ]);

    $classId = $request->class_id;

    // Remove all assignments for the teacher in the specific class
    DB::table('teacher_class_subject_pivots')
        ->where('user_id', $teacherId)
        ->where('class_id', $classId)
        ->delete();

    return redirect()->back()->with('success', 'Class assignment removed successfully!');
}



}

