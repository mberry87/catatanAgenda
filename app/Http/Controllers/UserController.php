<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $availablePermissions = User::AVAILABLE_PERMISSIONS;
        return view('backend.user.create', compact('users', 'availablePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissionKeys = implode(',', array_keys(User::AVAILABLE_PERMISSIONS));

        $validatedData = $request->validate([
            'name'          => 'required',
            'username'      => 'required|unique:users,username',
            'nip'           => 'required',
            'email'         => 'required|unique:users,email',
            'role'          => 'required|in:admin,user',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|in:' . $permissionKeys,
        ]);

        $validatedData['permissions'] = $request->input('permissions', []);
        $validatedData['password'] = bcrypt('password'); // membuat password tersimpan otomatis

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambah, password awal : password.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);

        if (!$users) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $availablePermissions = User::AVAILABLE_PERMISSIONS;

        return view('backend.user.edit', compact('users', 'availablePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);

        if (!$users) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $permissionKeys = implode(',', array_keys(User::AVAILABLE_PERMISSIONS));

        $request->validate([
            'name'          => 'required',
            'username'      => 'required|unique:users,username,' . $users->id,
            'nip'           => 'required',
            'email'         => 'required|unique:users,email,' . $users->id,
            'role'          => 'required|in:admin,user',
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

        return redirect()->route('user.index')->with('success', 'user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }
}
