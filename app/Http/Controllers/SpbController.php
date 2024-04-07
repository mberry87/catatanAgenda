<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Pegawai;
use App\Models\Pelabuhan;
use App\Models\Spb;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spb = Spb::latest()->get();

        $title = 'Hapus Data!';
        $text = "Anda yakin ingin hapus data?";
        confirmDelete($title, $text);

        return view('backend.spb.index', compact('spb'));
    }

    public function cetak($id)
    {
        // set_time_limit(300);
        $cetakspb = Spb::findOrFail($id);

        $data = [
            'cetakspb' => $cetakspb
        ];

        $pdf = Pdf::loadView('backend.spb.cetak', $data);
        return $pdf->download('invoice.pdf');

        // return view('backend.spb.cetak', compact('cetakspb'));
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
            'call_sign' => 'required',
            'perusahaan' => 'required',
            'pelabuhan_id' => 'required',
            'no_imo' => 'required|unique:spb',
            'thn_produksi' => 'required',
            'nakhoda' => 'required',
            'tgl_nakhoda' => 'required',
            'jam_nakhoda' => 'required',
            'bertolak' => 'required',
            'tgl_bertolak' => 'required',
            'jam_bertolak' => 'required',
            'jml_crew' => 'required',
            'muatan' => 'required',
            'tmp_terbit' => 'required',
            'tgl_terbit' => 'required',
            'jam_terbit' => 'required',
            'no_pup' => 'required|unique:spb',

        ]);

        $user_id = Auth::id();

        // generate nomor
        $spb = new Spb($validatedData);
        $spb->no_surat = $spb->generateNomorSurat();
        $spb->no_regis = $spb->generateNomorRegis();
        $spb->user_id = $user_id;
        $spb->save();

        return redirect()->route('spb.index')->with('success', 'Data SPB berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spb = Spb::findOrFail($id);

        return view('backend.spb.show', compact('spb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Spb $spb)
    {
        // $this->authorize('spb.update', $spb);

        if (!Gate::allows('spb.update', $spb)) {
            abort(403);
        }

        $kapal = Kapal::all();
        $pelabuhan = Pelabuhan::all();
        $pegawai = Pegawai::all();
        $spb = Spb::find($id);

        if (!$spb) {
            abort(404);
        }

        return view('backend.spb.edit', compact('spb', 'kapal', 'pelabuhan', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'call_sign' => 'required',
            'perusahaan' => 'required',
            'pelabuhan_id' => 'required',
            'no_imo' => 'required',
            'thn_produksi' => 'required',
            'nakhoda' => 'required',
            'tgl_nakhoda' => 'required',
            'jam_nakhoda' => 'required',
            'bertolak' => 'required',
            'tgl_bertolak' => 'required',
            'tgl_bertolak' => 'required',
            'jml_crew' => 'required',
            'muatan' => 'required',
            'tmp_terbit' => 'required',
            'tgl_terbit' => 'required',
            'jam_terbit' => 'required',
            'no_pup' => 'required'
        ]);

        $user_id = Auth::id();

        $spb = Spb::findOrFail($id);
        if ($spb->user_id != $user_id) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengubah data ini.');
        }
        $spb->fill($validatedData);
        $spb->save();

        return redirect()->route('spb.index')->with('success', 'Data SPB berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Spb $spb)
    {
        if (!Gate::allows('spb.delete', $spb)) {
            abort(403);
        }

        Spb::destroy($id);

        return redirect()->route('spb.index')->with('success', 'Data SPB berhasil dihapus.');
    }
}
