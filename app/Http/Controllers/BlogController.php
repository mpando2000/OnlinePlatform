<?php

namespace App\Http\Controllers;

use id;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $admin = Auth::user();
        
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
                            'role' => $message->user->role,
                        ]
                    ];
                })
            ]);
        }
        
        // Regular page load
        $messages = Blog::with('user')->orderBy('created_at', 'asc')->get();  
        return view('blog.index', compact('messages','admin'));
    }

    public function create()
    {
        return view('blog.create');
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
                            'role' => $message->user->role,
                        ]
                    ]
                ]);
            }
            
            // Regular form submission
            return redirect()->route('blogs.index')->with('success', 'Message sent successfully!');
            
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
            Log::error('Error storing admin blog message: ' . $e->getMessage());
            
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while sending the message. Please try again.'
                ], 500);
            }
            return back()->with('error', 'An error occurred while sending the message. Please try again.');
        }
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
            $blog=Blog::findOrFail($id);
            $blog->update($request->only('title','content'));

            return redirect()->route('blogs.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index');
    }

   
}
