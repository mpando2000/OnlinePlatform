<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OnlineSession;
use Illuminate\Support\Facades\Auth;

class OnlineSessionController extends Controller
{
    public function index()
    {
        $online_sessions = OnlineSession::all();
        return view('teacher.onlineSessions.index', compact('online_sessions'));
    }

    public function adminIndex()
    {
        $online_sessions = OnlineSession::all();
        return view('admin.onlineSessions.index', compact('online_sessions'));
    }

    public function studentIndex()
    {
        return view('student.onlineSessions.joinOnlineSession');
    }
    public function teacherJoinIndex()
    {
        return view('teacher.onlineSessions.joinOnlineSession');
    }
    public function adminJoinIndex()
    {
        return view('admin.onlineSessions.joinOnlineSession');
    }

    public function onlineSessionForm()
    {
        return view('teacher.onlineSessions.add');
    }

    public function adminOnlineSessionForm()
    {
        return view('adminn.onlineSessions.add');
    }

    public function createMeeting()
    {
        $meetingCode = Str::random(8);
        
        $meetingUrl = "https://meet.jit.si/" . $meetingCode;


        $meeting = OnlineSession::create([
            'meeting_code' => $meetingCode,
            'meeting_url' => $meetingUrl,
            'teacher_id' => Auth::id(),
        ]);

        return view('teacher.onlineSessions.meeting', ['meeting' => $meeting]);
    }

    public function adminCreateMeeting()
    {
        $meetingCode = Str::random(8);
        
        $meetingUrl = "https://meet.jit.si/" . $meetingCode;


        $meeting = OnlineSession::create([
            'meeting_code' => $meetingCode,
            'meeting_url' => $meetingUrl,
            'teacher_id' => Auth::id(),
        ]);

        return view('admin.onlineSessions.meeting', ['meeting' => $meeting]);
    }

    public function joinMeeting(Request $request)
    {
       
        $request->validate([
            'meeting_code' => 'required|string|exists:online_sessions,meeting_code',
        ]);

       
        $meeting = OnlineSession::where('meeting_code', $request->meeting_code)->first();

     
        return redirect()->away($meeting->meeting_url);
    }
}
