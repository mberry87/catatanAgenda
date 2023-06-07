<?php

namespace App\Http\Controllers;

use App\Models\Bendera;
use Illuminate\Http\Request;

class BenderaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hubungkan data migration
        $bendera = Bendera::all();

        return view('backend.bendera.index', compact('bendera'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.bendera.create');
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
            'kode' => 'required',

        ]);

        Bendera::create($validatedData);

        return redirect()->route('bendera.index')->with('success', 'Data bendera berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bendera  $bendera
     * @return \Illuminate\Http\Response
     */
    public function show(Bendera $bendera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bendera  $bendera
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bendera = Bendera::find($id);

        if (!$bendera) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.bendera.edit', compact('bendera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bendera  $bendera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bendera = Bendera::find($id);

        if (!$bendera) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        $bendera->nama = $request->nama;
        $bendera->kode = $request->kode;
        $bendera->save();

        return redirect()->route('bendera.index')->with('success', 'bendera berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bendera  $bendera
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bendera = Bendera::find($id);
        $bendera->delete();

        return redirect()->route('bendera.index')->with('success', 'Data bendera berhasil dihapus.');
    }
}
