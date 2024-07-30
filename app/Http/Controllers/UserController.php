<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    // Tampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('user.create');
    }

    // Simpan pengguna baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    // Tampilkan detail pengguna
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('user.show', compact('user'));
    }

    // Tampilkan form untuk mengedit pengguna
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('user.edit', compact('user'));
    }

    // Perbarui data pengguna di database
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user_id . ',user_id',
            'username' => 'required|string|max:100|unique:users,username,' . $user_id . ',user_id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username'];
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // Hapus pengguna dari database
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function assignRole($user_id)
    {
        $user = User::with('roles')->findOrFail($user_id);
        $roles = Role::all();
        return view('user.assign_role', compact('user', 'roles'));
    }

    public function storeRoleAssignment(Request $request, $user_id)
    {
        $validatedData = $request->validate([
            'role_ids' => 'array',
            'role_ids.*' => 'exists:roles,role_id',
        ]);

        $user = User::findOrFail($user_id);
        $currentRoles = $user->roles->pluck('role_id')->toArray();
        $newRoles = $validatedData['role_ids'] ?? [];

        // Tambahkan peran baru
        foreach (array_diff($newRoles, $currentRoles) as $role_id) {
            Group::create([
                'user_id' => $user_id,
                'role_id' => $role_id,
            ]);
        }

        // Hapus peran yang tidak lagi dipilih
        foreach (array_diff($currentRoles, $newRoles) as $role_id) {
            Group::where('user_id', $user_id)->where('role_id', $role_id)->delete();
        }

        return redirect()->route('user.index')->with('success', 'Roles assigned successfully.');
    }
}
