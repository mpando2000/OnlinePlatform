<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\School;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        return view('components.login');
    }


    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user(); 

          // Check if the account is inactive
          if ($user->status === 'inactive') {
            Auth::logout();
            return redirect()->back()
                ->withErrors(['email' => 'Your account is inactive. Please contact the admin.'])
                ->withInput($request->only('email', '_auth_form'));
        }
        // dd($user);
        $user->login_at = now();
        $user->save();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }
    }

    return redirect()->back()
        ->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])
        ->withInput($request->only('email', '_auth_form'));
}

    public function regForm(){
        $school_classes = SchoolClass::all();
        $schools = School::active()->orderBy('name')->get();

        return view('components.register', compact('school_classes', 'schools'));
    }
    

    public function register(Request $request){
        // dd($request->all());
        $request->validate([
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

        // Get school code for backward compatibility
        $school = \App\Models\School::find($request->school_id);

        User::create([
            'firstname' =>$request->firstname,
            'secondname' =>$request->secondname,
            'lastname' =>$request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender'=>$request->gender,
            'school' => $school ? $school->code : null,
            'school_id' => $request->school_id,
            'role' => $request->role,
            'class_id'=>$request->class_id,

            'status' => 'inactive' 
        ]);

        return redirect()->route('loginForm')->with('success', 'Registration successful. Please wait for admin approval.');
    
    }

    public function forgotPasswordForm()
    {
        return view('components.forgot_password');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)])->onlyInput('email');
    }

    public function resetPasswordForm(Request $request, string $token)
    {
        return view('components.reset_auth_password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('loginForm')->with('success', __($status))
            : back()->withErrors(['email' => __($status)])->onlyInput('email');
    }

    public function logout(Request $request){
        $user = Auth::user();
        $user->logout_at = now();
        $user->save();
        
        Auth::logout();
        return redirect('/');
    }


        // status
        public function updateStatus(Request $request, User $user)
        {
            $request->validate([
                'status' => 'required|in:active,inactive',
            ]);

            $user->status = $request->status;
            $user->save();

            return redirect()->back()->with('status', 'User status updated successfully.');
        }

        // user change password
        public function teacherChangePasswordForm()
        {
            return view('teacher.change_password'); // Ensure this view exists
        }
        public function showChangePasswordForm()
        {
            return view('components.change_password'); // Ensure this view exists
        }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('student.dashboard')->with('success', 'Password changed successfully.');
    }

    
    public function teacherChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('teacher.dashboard')->with('success', 'Password changed successfully.');
    }

    
}
