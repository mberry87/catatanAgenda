<?php

namespace App\Http\Controllers;

use App\Models\Tipe_kapal;
use Illuminate\Http\Request;

class TipeKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hubungkan data migration
        $tipe_kapal = Tipe_kapal::all();

        $title = 'Hapus Data!';
        $text = "Anda yakin ingin hapus data?";
        confirmDelete($title, $text);

        return view('backend.tipe_kapal.index', compact('tipe_kapal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tipe_kapal.create');
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
            'nama' => 'required|unique:tipe_kapal',
            'kode' => 'required|unique:tipe_kapal',

        ]);

        Tipe_kapal::create($validatedData);

        return redirect()->route('tipe_kapal.index')->with('success', 'Data tipe kapal berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipe_kapal  $tipe_kapal
     * @return \Illuminate\Http\Response
     */
    public function show(Tipe_kapal $tipe_kapal)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipe_kapal  $tipe_kapal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipe_kapal = Tipe_kapal::find($id);

        if (!$tipe_kapal) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.tipe_kapal.edit', compact('tipe_kapal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipe_kapal  $tipe_kapal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipe_kapal = Tipe_kapal::find($id);

        if (!$tipe_kapal) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        $tipe_kapal->nama = $request->nama;
        $tipe_kapal->kode = $request->kode;
        $tipe_kapal->save();

        return redirect()->route('tipe_kapal.index')->with('success', 'tipe kapal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipe_kapal  $tipe_kapal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipe_kapal = Tipe_kapal::find($id);
        $tipe_kapal->delete();

        return redirect()->route('tipe_kapal.index')->with('success', 'Data tipe kapal berhasil dihapus.');
    }
}
