<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\School;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function adminLTE()
    {
        return view('index');
    }
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        $school_classes = SchoolClass::all();
        $schools = School::active()->orderBy('name')->get();

        return view('home', compact('sliders', 'school_classes', 'schools'));
    }

    public function selectRole(Request $request)
    {
        $role = $request->input('role');

        if ($role === 'teacher') {
            return redirect()->route('loginForm', ['role' => 'teacher']);
        } elseif ($role === 'student') {
            return redirect()->route('loginForm', ['role' => 'student']);
        }

        return back();
    }
}
