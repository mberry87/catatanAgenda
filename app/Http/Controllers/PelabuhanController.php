<?php

namespace App\Http\Controllers;

use App\Models\Bendera;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;

class PelabuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelabuhan = Pelabuhan::all();

        return view('backend.pelabuhan.index', compact('pelabuhan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pelabuhan.create');
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
            'kode' => 'required|unique:pelabuhan',

        ]);

        Pelabuhan::create($validatedData);

        return redirect()->route('pelabuhan.index')->with('success', 'Data pelabuhan berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelabuhan  $pelabuhan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelabuhan $pelabuhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelabuhan  $pelabuhan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhan = Pelabuhan::find($id);

        if (!$pelabuhan) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.pelabuhan.edit', compact('pelabuhan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelabuhan  $pelabuhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelabuhan = Pelabuhan::find($id);

        if (!$pelabuhan) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        $pelabuhan->nama = $request->nama;
        $pelabuhan->kode = $request->kode;
        $pelabuhan->save();

        return redirect()->route('pelabuhan.index')->with('success', 'pelabuhan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelabuhan  $pelabuhan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelabuhan = Pelabuhan::findOrFail($id);
        $pelabuhan->delete();

        return redirect()->route('pelabuhan.index')->with('success', 'Data pelabuhan berhasil dihapus.');
    }
}
