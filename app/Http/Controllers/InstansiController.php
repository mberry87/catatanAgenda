<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hubungkan data migration
        $instansi = Instansi::all();

        return view('backend.instansi.index', compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.instansi.create');
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
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',

        ]);

        Instansi::create($validatedData);

        return redirect()->route('instansi.index')->with('success', 'Data instansi berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instansi = Instansi::find($id);

        if (!$instansi) {
            // Jika instansi dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.instansi.edit', compact('instansi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instansi = Instansi::find($id);

        if (!$instansi) {
            // Jika instansi dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $instansi->nama = $request->nama;
        $instansi->alamat = $request->alamat;
        $instansi->telepon = $request->telepon;
        $instansi->email = $request->email;
        $instansi->save();

        return redirect()->route('instansi.index')->with('success', 'instansi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Data instansi berhasil dihapus.');
    }
}
