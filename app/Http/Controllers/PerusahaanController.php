<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hubungkan data migration
        $perusahaan = Perusahaan::all();

        $title = 'Hapus Data!';
        $text = "Anda yakin ingin hapus data?";
        confirmDelete($title, $text);

        return view('backend.perusahaan.index', compact('perusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',

        ]);

        Perusahaan::create($validatedData);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perusahaan = Perusahaan::find($id);

        if (!$perusahaan) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.perusahaan.edit', compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::find($id);

        if (!$perusahaan) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $perusahaan->nama = $request->nama;
        $perusahaan->status = $request->status;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->telepon = $request->telepon;
        $perusahaan->email = $request->email;
        $perusahaan->save();

        return redirect()->route('perusahaan.index')->with('success', 'perusahaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perusahaan = Perusahaan::find($id);
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
