<?php

namespace App\Http\Controllers;

use App\Models\Bendera;
use App\Models\Kapal;
use App\Models\Perusahaan;
use App\Models\Spb;
use App\Models\Tipe_kapal;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

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
            'gt' => 'required',
            'dwt' => 'required',
            'loa' => 'required',
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
    public function edit($id)
    {
        $kapal = Kapal::findOrFail($id);
        $perusahaan = Perusahaan::all();
        $tipe_kapal = Tipe_kapal::all();
        $bendera = Bendera::all();


        return view('backend.kapal.edit', compact('kapal', 'perusahaan', 'tipe_kapal', 'bendera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required',
            'call_sign' => 'required',
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

        $kapal = Kapal::findOrFail($id);

        $kapal->nama = $request->nama;
        $kapal->call_sign = $request->call_sign;
        $kapal->bendera_id = $request->bendera_id;
        $kapal->tipe_kapal_id = $request->tipe_kapal_id;
        $kapal->gt = $request->gt;
        $kapal->dwt = $request->dwt;
        $kapal->loa = $request->loa;
        $kapal->kapasitas = $request->kapasitas;
        $kapal->perusahaan_id = $request->perusahaan_id;
        $kapal->thn_produksi = $request->thn_produksi;
        $kapal->tgl_docking = $request->tgl_docking;

        $kapal->save();

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $kapal = Kapal::find($id);

        $kapal->delete();

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil dihapus.');
    }

    // fungsi ambil data javascript
    public function getData($kapal_id)
    {
        $kapal = Kapal::findOrFail($kapal_id);
        $bendera = $kapal->bendera->nama;
        $perusahaan = $kapal->perusahaan->nama;
        $tipe_kapal = $kapal->tipe_kapal->nama;
        $gt = $kapal->gt;
        $call_sign = $kapal->call_sign;
        $thn_produksi = $kapal->thn_produksi;



        return response()->json(['bendera' => $bendera, 'perusahaan' => $perusahaan, 'tipe_kapal' => $tipe_kapal, 'gt' => $gt, 'call_sign' => $call_sign, 'thn_produksi' => $thn_produksi]);
    }
}
