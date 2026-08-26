<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'required|string|max:20',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // max 2MB
    ]);

    // Handle file upload
    if ($request->hasFile('profile_image')) {
        // Delete old image if exists
        if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
            Storage::delete('public/' . $user->profile_image);
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');
        $validated['profile_image'] = $path;
    }

    // Update user (only fields present in $validated)
    $user->update($validated);

    return back()->with('success', 'Profile updated successfully.');
}
}