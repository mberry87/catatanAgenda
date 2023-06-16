<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'photo_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:500',
        ]);

        $file = $request->file('photo_profil');
        $fileName = $file->getClientOriginalName(); // Menggunakan nama file asli

        $id = Auth::user()->id;
        $user = User::find($id);

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

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required|date',
            'tmp_lahir' => 'required',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'agama' => 'nullable',
        ]);

        $user = User::find(auth()->id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->tmp_lahir = $request->tmp_lahir;
        $user->alamat = $request->alamat;
        $user->telepon = $request->telepon;
        $user->agama = $request->agama;

        $user->save();

        return redirect()->route('profil.index')->with('success', ' profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);

        // Validasi input password saat ini
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini tidak sesuai.');
        }

        // Validasi konfirmasi password baru
        if ($request->input('new_password') !== $request->input('confirm_password')) {
            return redirect()->back()->with('error', 'Konfirmasi password baru tidak sesuai.');
        }

        // Update password baru
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
