<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TutoringSession;


class TutoringSessionController extends Controller
{
    public function create(){
        return view('teacher.tutoringSession');
    }

    public function store(Request $request){
        $request->validate([
            'meeting_topic' => 'required|string|max:255',
        ]);

        $sessionCode = strtoupper(Str::random(8));

        $meetingLink = $this->createZoomMeeting($request->meeting_topic);

        $tutoringSession = TutoringSession::create([
            'teacher_id' => auth()->id(),
            'session_code' => $sessionCode,
            'meeting_link' => $meetingLink,

        ]);
        return redirect()->route('teacher.tutoringSession', $tutoringSession->id)
                        ->with('success', 'Tutorin session created successfully with code: ' . $sessionCode);
    }
    public function show($id)
    {
        $session = TutoringSession::findOrFail($id);
        return view('teacher.showTutoringSession', compact('session'));
    }

    public function join($session_code)
    {
        // Find the session by the code
        $session = TutoringSession::where('session_code', $session_code)->first();

        if (!$session) {
            return redirect()->back()->with('error', 'Invalid session code.');
        }

        // Redirect to Zoom meeting link
        return redirect()->away($session->meeting_link);
    }

    // private function createZoomMeeting($topic)
    // {
    //     $client = new Client();
    //     $zoomUrl = config('services.zoom.api_base_url') . '/users/me/meetings';

    //     $response = $client->post($zoomUrl, [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $this->generateZoomToken(),
    //             'Content-Type' => 'application/json',
    //         ],
    //         'json' => [
    //             'topic' => $topic,
    //             'type' => 1, // Instant meeting
    //             'settings' => [
    //                 'host_video' => true,
    //                 'participant_video' => true,
    //             ],
    //         ],
    //     ]);

    //     $data = json_decode($response->getBody(), true);

    //     return $data['join_url'];
    // }

    public function createZoomMeeting(Request $request)
    {
        $jwt = $this->generateZoomToken();

        $meetingData = [
            'topic' => $request->input('topic'),
            'type' => 2, // Scheduled meeting
            'start_time' => $request->input('start_time'),
            'duration' => $request->input('duration'),
            'agenda' => $request->input('agenda'),
        ];

        $response = $this->sendZoomRequest('/users/me/meetings', $meetingData, $jwt);

        return response()->json($response);
    }

    private function sendZoomRequest($endpoint, $data, $jwt)
    {
        $url = 'https://api.zoom.us/v2' . $endpoint;

        $response = \Http::withHeaders([
            'Authorization' => 'Bearer ' . $jwt,
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        return $response->json();
    }

    // private function generateZoomToken()
    // {
    //     $key = config('services.zoom.api_key');
    //     $secret = config('services.zoom.api_secret');

    //     $payload = [
    //         'iss' => $key,
    //         'exp' => time() + 60, // Token expiration
    //     ];

    //     // Use JWT class to encode the payload, key, and algorithm
    //     try {
    //         return JWT::encode($payload, $secret, 'HS256');
    //     } catch (\Exception $e) {
    //         // Handle JWT encoding errors
    //         throw new \Exception('Failed to encode JWT token: ' . $e->getMessage());
    //     }
    // }

    public function generateZoomToken()
    {
        $payload = [
            'iss' => env('ZOOM_API_KEY'), // Issuer (Your API Key)
            'exp' => time() + 3600, // Token expiration time
        ];

        $key = env('ZOOM_API_SECRET'); // Key for HMAC (Your API Secret)
        $algorithm = 'HS256'; // Ensure this matches your key type

        try {
            $jwt = JWT::encode($payload, $key, $algorithm);
        } catch (\Exception $e) {
            // Handle exceptions related to JWT encoding
            return response()->json(['error' => 'Failed to encode JWT token: ' . $e->getMessage()], 500);
        }

        return $jwt;
    }

   

}
