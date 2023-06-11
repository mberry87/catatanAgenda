<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        if (!$userData) {
            // Jika data pengguna tidak ditemukan, Anda dapat menangani kasus ini sesuai kebutuhan Anda,
            // misalnya dengan menampilkan pesan kesalahan atau mengarahkan pengguna ke halaman lain.
            return redirect()->back()->with('error', 'Data profil tidak ditemukan.');
        }

        return view('backend.profil.index', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateFotoProfil(Request $request)
    {
        $request->validate([
            'photo_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('photo_profil');
        $fileName = $file->getClientOriginalName(); // Menggunakan nama file asli

        $user = auth()->user();

        // Hapus foto profil lama jika ada
        if ($user->photo_profil) {
            Storage::delete('public/photo_profil/' . $user->photo_profil);
        }

        // Simpan foto profil baru
        $file->storeAs('public/photo_profil', $fileName);

        // Update field photo_profil pada entitas pengguna
        $user->photo_profil = $fileName;

        $user->save();

        return redirect()->route('profil.index')->with('success', 'Foto profil berhasil diperbarui.');
    }
}
