<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index()
    {
        $users = User::where('role', 'user')
            ->withCount('properties')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display user details.
     */
    public function show(User $user)
    {
        abort_if($user->role !== 'user', 404);

        $user->load([
            'properties' => function ($query) {
                $query->latest();
            }
        ]);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show edit form.
     */
    public function edit(User $user)
    {
        abort_if($user->role !== 'user', 404);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        abort_if($user->role !== 'user', 404);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        abort_if($user->role !== 'user', 404);

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Activate / Deactivate user.
     */
    public function toggleStatus(User $user)
    {
        abort_if($user->role !== 'user', 404);

        $user->update([
            'status' => !$user->status,
        ]);

        return back()->with(
            'success',
            $user->status
                ? 'User activated successfully.'
                : 'User deactivated successfully.'
        );
    }
}
