<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hubungkan data migration
        $pegawai = Pegawai::all();

        return view('backend.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pegawai.create');
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
            'nama' => 'required|unique:pegawai',
            'nip' => 'required|unique:pegawai',
            'gol' => 'required',
        ]);

        Pegawai::create($validatedData);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambah.');
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
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.pegawai.edit', compact('pegawai'));
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
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'gol' => 'required',
        ]);

        $pegawai->nama = $request->nama;
        $pegawai->nip = $request->nip;
        $pegawai->gol = $request->gol;
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
