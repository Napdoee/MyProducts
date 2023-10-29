<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
       $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'roles' => ['required']
        ]);

        $user->update($request->all());

        return redirect()->route('admin.user.index')->with([
            'message' => 'User Updated',
            'status' => 'info',
        ]);
    }

    public function changePassword(Request $request, User $user) {
        $validated = $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.user.index')->with([
            'message' => 'User password changed',
            'status' => 'info',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')->with([
            'message' => 'User Deleted',
            'status' => 'danger',
        ]);
    }
}
