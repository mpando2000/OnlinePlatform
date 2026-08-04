<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = $this->currentUser();
        $user->load(['schoolRelation', 'schoolClass']);

        return view('profile.show', [
            'user' => $user,
            'dashboardRoute' => $this->dashboardRoute($user),
        ]);
    }

    public function edit(): View
    {
        $user = $this->currentUser();
        $user->load(['schoolRelation', 'schoolClass']);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $this->currentUser();
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'secondname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'gender' => 'required|in:male,female,other',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $profileImage = $request->file('profile_image');
        unset($validated['profile_image']);

        $user->fill($validated);

        if ($profileImage) {
            $filename = Str::uuid().'.'.$profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('uploads/profile_images'), $filename);
            $user->profile_image = $filename;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Your profile was updated successfully.');
    }

    private function currentUser(): User
    {
        /** @var User $user */
        $user = Auth::user();

        return $user;
    }

    private function dashboardRoute(User $user): string
    {
        return match ($user->role) {
            'admin' => 'admin.dashboard',
            'teacher' => 'teacher.dashboard',
            default => 'student.dashboard',
        };
    }
}
