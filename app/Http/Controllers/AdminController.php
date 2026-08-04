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
use Illuminate\Validation\Rule;
use App\Models\TeacherSubjectClass;
use App\Models\TeacherClassSubjectPivot;
use App\Models\OnlineSession;

class AdminController extends Controller
{
    private function currentAdmin(): User
    {
        /** @var User $admin */
        $admin = Auth::user();

        return $admin;
    }

    private function authorizeUserManagement(User $user): void
    {
        abort_unless($this->currentAdmin()->canManageUser($user), 403, 'You can only manage users from your school.');
    }

    private function manageableSchools()
    {
        $admin = $this->currentAdmin();

        return School::query()
            ->when(
                ! $admin->canManageAllSchools(),
                fn ($query) => $query->whereKey($admin->school_id ?? 0),
                fn ($query) => $query->where('status', 'active')
            )
            ->orderBy('name')
            ->get();
    }

    private function schoolValidationRules(): array
    {
        return [
            'required',
            Rule::exists('schools', 'id'),
            Rule::in($this->manageableSchools()->pluck('id')->all()),
        ];
    }

    public function index(){
        $admin = $this->currentAdmin();
        $visibleUsers = User::query()->visibleToAdmin($admin);
        $users = (clone $visibleUsers)->get();
        $classes = SchoolClass::all();
        $userCount = (clone $visibleUsers)->count();
        $classCount = SchoolClass::count();
        $teachersCount = (clone $visibleUsers)->where('role', 'teacher')->count();
        $studentsCount = (clone $visibleUsers)->where('role', 'student')->count();
        $inactiveCount = (clone $visibleUsers)->where('status', 'inactive')->count();
        
        // Enhanced statistics
        $schoolsCount = $this->manageableSchools()->count();
        $quizzesCount = Quiz::count();
        $recentRegistrations = (clone $visibleUsers)->where('created_at', '>=', now()->subDays(7))->count();
        
        // School distribution statistics
        $schoolStats = [];
        $schools = $this->manageableSchools();
        
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
        $legacyUsers = (clone $visibleUsers)->whereNull('school_id')->whereNotNull('school')->get();
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
        $recentUsers = (clone $visibleUsers)->orderBy('created_at', 'desc')->limit(5)->get();
        $activeUsers = (clone $visibleUsers)->where('login_at', '>=', now()->subDays(1))->count();
        
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
        $admin = $this->currentAdmin();
        $users = User::query()
            ->visibleToAdmin($admin)
            ->with(['schoolClass', 'schoolRelation'])
            ->orderBy('role')
            ->orderBy('firstname')
            ->get();
        $schools = $this->manageableSchools();

        return view ('admin.users', [
            'users' => $users,
            'schools' => $schools,
            'currentAdmin' => $admin,
        ]);
    }
    public function userForm(){
        $school_classes = SchoolClass::all();
        $schools = $this->manageableSchools();
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
            'school_id' => $this->schoolValidationRules(),
            'role' => 'required|in:teacher,student',
            'class_id' => 'required_if:role,student|exists:school_classes,id'

        ]);


        $school = School::find($inputData['school_id']);
        $inputData['school'] = $school?->code;
        User::create($inputData);
        return redirect(route('admin.users'));
       
    }



  

public function viewUser(User $user)
{
    $this->authorizeUserManagement($user);
    $user->load('schoolRelation');

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
        $this->authorizeUserManagement($user);

        return view('admin.editUser', [
            'user' => $user,
            'schools' => $this->manageableSchools(),
            'currentAdmin' => $this->currentAdmin(),
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
        $this->authorizeUserManagement($user);

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'captured_image' => 'nullable|string',
        ]);

        if ($this->currentAdmin()->canManageAllSchools()) {
            $adminData = $request->validate([
                'school_id' => $this->schoolValidationRules(),
                'can_manage_all_schools' => 'sometimes|boolean',
            ]);

            $validatedData['school_id'] = $adminData['school_id'];
            $validatedData['school'] = School::find($adminData['school_id'])?->code;

            if ($user->role === 'admin' && ! $user->is($this->currentAdmin())) {
                $validatedData['can_manage_all_schools'] = $request->boolean('can_manage_all_schools');
            }
        }

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
        $this->authorizeUserManagement($user);

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
        $this->authorizeUserManagement($user);
        $validated = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $user->status = $validated['status'];
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }


    // reset password
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $this->authorizeUserManagement($user);

        return view('components.reset_password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::findOrFail($id);
        $this->authorizeUserManagement($user);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Password reset successfully.');
    }




    public function createAdminUser()
    {
        $school_classes = SchoolClass::all();
        $schools = $this->manageableSchools();
        $currentAdmin = $this->currentAdmin();

        return view('admin.adminUsers.create', compact('school_classes', 'schools', 'currentAdmin'));
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
            'school_id' => $this->schoolValidationRules(),
            'role' => 'required|in:admin',
            'class_id' => 'required_if:role,student|exists:school_classes,id',
            'can_manage_all_schools' => 'sometimes|boolean',

        ]);

        $school = School::find($inputData['school_id']);
        $inputData['school'] = $school?->code;
        $inputData['can_manage_all_schools'] = $this->currentAdmin()->canManageAllSchools()
            && $request->boolean('can_manage_all_schools');

        User::create($inputData);

        return redirect()->route('admin.users');
    }



    public function assignClassSubject($userId)
    {
        $teacher = User::with(['teacherSubjects' => function($query) {
            $query->withPivot('class_id', 'created_at', 'updated_at');
        }])->findOrFail($userId);
        $this->authorizeUserManagement($teacher);
        abort_unless($teacher->role === 'teacher', 404);
        
        $classes = SchoolClass::all();
        $subjects = Subject::all();

        return view('admin.adminUsers.assign-class-subject', compact('teacher', 'classes', 'subjects'));
    }



public function storeClassSubjectAssignment(Request $request, $teacherId)
{
    $teacher = User::findOrFail($teacherId);
    $this->authorizeUserManagement($teacher);
    abort_unless($teacher->role === 'teacher', 404);

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
    $teacher = User::findOrFail($teacherId);
    $this->authorizeUserManagement($teacher);
    abort_unless($teacher->role === 'teacher', 404);

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
