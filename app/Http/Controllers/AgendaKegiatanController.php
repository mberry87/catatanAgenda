<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AgendaKegiatan;
use App\Models\Instansi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AgendaKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $agendaKegiatan = AgendaKegiatan::with('pegawai')->get();
        $laporan = AgendaKegiatan::where('status', 'Belum Selesai')->get();

        return view('backend.agenda.index', compact('agendaKegiatan', 'laporan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        $instansi = Instansi::all();

        return view('backend.agenda.create', compact('pegawai', 'instansi'));
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
            'nmr_surat' => 'required',
            'uraian' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'pakaian' => 'required',
            'pukul' => 'required',
            'tempat' => 'required',
            'pegawai_id' => 'required|array',
            'instansi_id' => 'required',
            'jenis_agenda' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $agendaKegiatan = AgendaKegiatan::create([
            'nmr_surat' => $validatedData['nmr_surat'],
            'uraian' => $validatedData['uraian'],
            'tgl_mulai' => $validatedData['tgl_mulai'],
            'tgl_selesai' => $validatedData['tgl_selesai'],
            'pakaian' => $validatedData['pakaian'],
            'pukul' => $validatedData['pukul'],
            'tempat' => $validatedData['tempat'],
            'instansi_id' => $validatedData['instansi_id'],
            'jenis_agenda' => $validatedData['jenis_agenda'],
            'status' => $validatedData['status'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        $agendaKegiatan->pegawai()->sync($validatedData['pegawai_id']);

        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil ditambah.');
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
        $agenda = AgendaKegiatan::with(['pegawai', 'instansi'])->findOrFail($id);
        $pegawai = Pegawai::all();
        $instansi = Instansi::all();

        if (!$agenda) {
            // Jika instansi dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.agenda.edit', compact('agenda', 'pegawai', 'instansi'));
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
        $agenda = AgendaKegiatan::find($id);

        if (!$agenda) {
            // Jika instansi dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nmr_surat' => 'required',
            'uraian' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'pakaian' => 'required',
            'pukul' => 'required',
            'tempat' => 'required',
            'pegawai_id' => 'required|array',
            'instansi_id' => 'required',
            'jenis_agenda' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $agenda->nmr_surat = $request->nmr_surat;
        $agenda->uraian = $request->uraian;
        $agenda->tgl_mulai = $request->tgl_mulai;
        $agenda->tgl_selesai = $request->tgl_selesai;
        $agenda->pakaian = $request->pakaian;
        $agenda->tempat = $request->tempat;
        $agenda->instansi_id = $request->instansi_id;
        $agenda->jenis_agenda = $request->jenis_agenda;
        $agenda->status = $request->status;
        $agenda->keterangan = $request->keterangan;
        $agenda->save();

        // Sinkronisasi pegawai_id jika ada relasi many-to-many
        $agenda->pegawai()->sync($request->pegawai_id);

        return redirect()->route('agenda.index')->with('success',  'Data agenda berhasil diperbarui.');
    }

    public function updateStatus($id)
    {
        $agendaKegiatan = AgendaKegiatan::findOrFail($id);
        $agendaKegiatan->status = 'Selesai';
        $agendaKegiatan->save();

        return redirect()->route('agenda.index')->with('success', 'Status agenda berhasil diubah menjadi Selesai');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agendaKegiatan = AgendaKegiatan::with('pegawai')->findOrFail($id);
        $agendaKegiatan->delete();

        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil dihapus.');
    }

    public function countSelesai()
    {
        $jumlahSelesai = AgendaKegiatan::where('status', 'Selesai')->get();
        return view('backend.status.countSelesai', compact('jumlahSelesai'));
    }

    public function countBelumSelesai()
    {
        $jumlahBelumSelesai = AgendaKegiatan::where('status', 'Belum Selesai')->get();
        return view('backend.status.countBelumSelesai', compact('jumlahBelumSelesai'));
    }
}
