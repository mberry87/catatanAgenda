<?php

namespace App\Http\Controllers;

use App\Models\Bendera;
use App\Models\Kapal;
use App\Models\Perusahaan;
use App\Models\Tipe_kapal;
use Illuminate\Http\Request;

class KapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        // hubungkan data migration
        $kapal = Kapal::with('bendera', 'tipe_kapal', 'perusahaan')->get();
        return view('backend.kapal.index', compact('kapal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //panggil model
        $bendera = Bendera::all();
        $tipe_kapal = Tipe_kapal::all();
        $perusahaan = Perusahaan::all();
        return view('backend.kapal.create', compact('bendera', 'tipe_kapal', 'perusahaan'));
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
            'nama' => 'required|unique:kapal',
            'call_sign' => 'required|unique:kapal',
            'bendera_id' => 'required',
            'tipe_kapal_id' => 'required',
            // 'gt' => 'required',
            // 'dwt' => 'required',
            // 'loa' => 'required',
            'kapasitas' => 'required',
            'perusahaan_id' => 'required',
            'thn_produksi' => 'required',
            'tgl_docking' => 'required',
        ]);

        Kapal::create($validatedData);

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function show(Kapal $kapal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function edit(Kapal $kapal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kapal $kapal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kapal $kapal)
    {
        //
    }
}
