<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private function ensureManageAccess(): void
    {
        abort_unless(
            Auth::user() && Auth::user()->hasPermission('user.manage'),
            403,
            'Anda tidak memiliki hak akses untuk mengelola user.'
        );
    }

    public function index()
    {
        $this->ensureManageAccess();
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        $this->ensureManageAccess();
        $availablePermissions = User::AVAILABLE_PERMISSIONS;

        return view('backend.user.create', compact('availablePermissions'));
    }

    public function store(Request $request)
    {
        $this->ensureManageAccess();
        $permissionKeys = implode(',', array_keys(User::AVAILABLE_PERMISSIONS));

        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'nip'           => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email',
            'role'          => 'required|in:superadmin,admin,user',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|in:' . $permissionKeys,
        ]);

        $validatedData['permissions'] = $request->input('permissions', []);
        $validatedData['password'] = bcrypt('password');

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambah, password awal : password.');
    }

    public function show($id)
    {
        $this->ensureManageAccess();
        return redirect()->route('user.edit', $id);
    }

    public function edit($id)
    {
        $this->ensureManageAccess();
        $users = User::findOrFail($id);
        $availablePermissions = User::AVAILABLE_PERMISSIONS;

        return view('backend.user.edit', compact('users', 'availablePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureManageAccess();
        $users = User::findOrFail($id);

        $permissionKeys = implode(',', array_keys(User::AVAILABLE_PERMISSIONS));

        $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username,' . $users->id,
            'nip'           => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $users->id,
            'role'          => 'required|in:superadmin,admin,user',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|in:' . $permissionKeys,
        ]);

        $users->name = $request->name;
        $users->username = $request->username;
        $users->nip = $request->nip;
        $users->email = $request->email;
        $users->role = $request->role;
        $users->permissions = $request->input('permissions', []);
        $users->save();

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->ensureManageAccess();
        $users = User::findOrFail($id);

        if (Auth::id() === $users->id) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun yang sedang digunakan.');
        }

        $users->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }
}
