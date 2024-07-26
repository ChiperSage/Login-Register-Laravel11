<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users,username,' . $user->user_id],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $user->username = $validatedData['username'];
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
