<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Pegawai;
use App\Models\Pelabuhan;
use App\Models\Spb;
use Illuminate\Http\Request;

class SpbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spb = Spb::all();

        return view('backend.spb.index', compact('spb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kapal = Kapal::all();
        $pelabuhan = Pelabuhan::all();
        $pegawai = Pegawai::all();

        // generate nomor
        $spb = new Spb();
        $no_surat = $spb->generateNomorSurat();
        $no_regis = $spb->generateNomorRegis();


        return view('backend.spb.create', compact('kapal', 'pelabuhan', 'pegawai', 'no_surat', 'no_regis'));
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
            'no_regis' => 'required',
            'no_surat' => 'required',
            'tgl_surat' => 'required',
            'pemohon' => 'required',
            'kapal_id' => 'required',
            'bendera' => 'required',
            'tipe_kapal' => 'required',
            'gt' => 'required',
            'call_sign' => 'required|unique:spb',
            'perusahaan' => 'required',

            'pelabuhan_id' => 'required',
            'pegawai_id' => 'required',


        ]);

        // generate nomor
        $spb = new Spb($validatedData);
        $spb->no_surat = $spb->generateNomorSurat();
        $spb->no_regis = $spb->generateNomorRegis();
        $spb->save();

        return redirect()->route('spb.index')->with('success', 'Data SPB berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function show(Spb $spb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function edit(Spb $spb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spb $spb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spb $spb)
    {
        //
    }
}
