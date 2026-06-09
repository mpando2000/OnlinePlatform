<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function reports(){
        return view ('admin.reports');
    }


    public function userReport(){
        $users = User::all();
        return view ('admin.userReport', [
            'users' => $users
        ]);
    }

    public function userReportPrint(){
        $users = User::all();
        return view ('admin.userReportPrint', [
            'users' => $users
        ]);
    }


    public function classReport(){
        $classes = SchoolClass::withCount('subjects')->get();
        $subjectCount = \App\Models\Subject::count();
        $studentCount = User::where('role', 'student')->count();

        return view ('admin.classReport', [
            'classes' => $classes,
            'subjectCount' => $subjectCount,
            'studentCount' => $studentCount,
        ]);
    }

    public function classReportPrint(){
        $classes = SchoolClass::all();
        return view ('admin.classReportPrint', [
            'classes' => $classes
        ]);
    }

    //teacher side reports

    public function teacherReports(){
        $users = User::all();
        return view ('teacher.reports', [
            'users' => $users
        ]);
    }

    public function teacherUserReport(){
        $users = User::where('role', '!=', 'admin')->get(); // Teachers can only see non-admin users
        return view ('teacher.userReport', [
            'users' => $users
        ]);
    }

    public function teacherUserReportPrint(){
        $users = User::where('role', '!=', 'admin')->get(); // Teachers can only see non-admin users
        return view ('teacher.userReportPrint', [
            'users' => $users
        ]);
    }

    public function teacherClassReport(){
        $classes = SchoolClass::withCount('subjects')->get();
        $subjectCount = \App\Models\Subject::count();
        $studentCount = User::where('role', 'student')->count();

        return view ('teacher.classReport', [
            'classes' => $classes,
            'subjectCount' => $subjectCount,
            'studentCount' => $studentCount,
        ]);
    }

    public function teacherClassReportPrint(){
        $classes = SchoolClass::all();
        return view ('teacher.classReportPrint', [
            'classes' => $classes
        ]);
    }
}
