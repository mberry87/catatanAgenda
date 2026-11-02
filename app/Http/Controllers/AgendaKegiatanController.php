<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\Instansi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AgendaKegiatanController extends Controller
{
    // Daftar status yang tersedia
    const STATUS_LIST = [
        'In Progress',
        'Selesai',
    ];

    // Daftar jenis agenda yang tersedia
    const JENIS_AGENDA_LIST = [
        'Hadir Fisik',
        'Zoom Meet (Daring)',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendaKegiatan = AgendaKegiatan::with('pegawai', 'instansi')->orderBy('tgl_mulai', 'desc')->get();
        $laporan = AgendaKegiatan::with('pegawai')
            ->orderBy('tgl_mulai')
            ->whereIn('status', ['In Progress', 'In Proses'])
            ->get();

        return view('backend.agenda.index', compact('agendaKegiatan', 'laporan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai         = Pegawai::all();
        $instansi        = Instansi::all();
        $statusList      = self::STATUS_LIST;
        $jenisAgendaList = self::JENIS_AGENDA_LIST;

        return view('backend.agenda.create', compact('pegawai', 'instansi', 'statusList', 'jenisAgendaList'));
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
            'nmr_surat'    => 'required',
            'uraian'       => 'required',
            'tgl_mulai'    => 'required',
            'tgl_selesai'  => 'required',
            'pakaian'      => 'required',
            'pukul'        => 'required',
            'tempat'       => 'required',
            'pegawai_id'   => 'required|array',
            'instansi_id'  => 'required',
            'jenis_agenda' => 'required',
            'status'       => 'required',
            'keterangan'   => 'nullable',
        ]);

        // Jika instansi_id bukan angka (input teks baru), buat instansi baru
        if (!is_numeric($validatedData['instansi_id'])) {
            $newInstansi = Instansi::firstOrCreate(
                ['nama' => $validatedData['instansi_id']],
                [
                    'alamat'  => '-',
                    'telepon' => '-',
                    'email'   => '-',
                ]
            );
            $validatedData['instansi_id'] = $newInstansi->id;
        }

        $agendaKegiatan = AgendaKegiatan::create([
            'nmr_surat'    => $validatedData['nmr_surat'],
            'uraian'       => $validatedData['uraian'],
            'tgl_mulai'    => $validatedData['tgl_mulai'],
            'tgl_selesai'  => $validatedData['tgl_selesai'],
            'pakaian'      => $validatedData['pakaian'],
            'pukul'        => $validatedData['pukul'],
            'tempat'       => $validatedData['tempat'],
            'instansi_id'  => $validatedData['instansi_id'],
            'jenis_agenda' => $validatedData['jenis_agenda'],
            'status'       => $validatedData['status'],
            'keterangan'   => $validatedData['keterangan'] ?? null,
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
        return view('backend.agenda.show', [
            'agendaShow' => AgendaKegiatan::with('pegawai', 'instansi')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda          = AgendaKegiatan::with(['pegawai', 'instansi'])->findOrFail($id);
        $pegawai         = Pegawai::all();
        $instansi        = Instansi::all();
        $statusList      = self::STATUS_LIST;
        $jenisAgendaList = self::JENIS_AGENDA_LIST;

        return view('backend.agenda.edit', compact('agenda', 'pegawai', 'instansi', 'statusList', 'jenisAgendaList'));
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
        $agenda = AgendaKegiatan::findOrFail($id);

        $request->validate([
            'nmr_surat'    => 'required',
            'uraian'       => 'required',
            'tgl_mulai'    => 'required',
            'tgl_selesai'  => 'required',
            'pakaian'      => 'required',
            'pukul'        => 'required',
            'tempat'       => 'required',
            'pegawai_id'   => 'required|array',
            'instansi_id'  => 'required',
            'jenis_agenda' => 'required',
            'status'       => 'required',
            'keterangan'   => 'nullable',
        ]);

        // Jika instansi_id bukan angka (input teks baru), buat instansi baru
        $instansiId = $request->instansi_id;
        if (!is_numeric($instansiId)) {
            $newInstansi = Instansi::firstOrCreate(
                ['nama' => $instansiId],
                [
                    'alamat'  => '-',
                    'telepon' => '-',
                    'email'   => '-',
                ]
            );
            $instansiId  = $newInstansi->id;
        }

        $agenda->nmr_surat    = $request->nmr_surat;
        $agenda->uraian       = $request->uraian;
        $agenda->tgl_mulai    = $request->tgl_mulai;
        $agenda->tgl_selesai  = $request->tgl_selesai;
        $agenda->pakaian      = $request->pakaian;
        $agenda->pukul        = $request->pukul;
        $agenda->tempat       = $request->tempat;
        $agenda->instansi_id  = $instansiId;
        $agenda->jenis_agenda = $request->jenis_agenda;
        $agenda->status       = $request->status;
        $agenda->keterangan   = $request->keterangan;
        $agenda->save();

        $agenda->pegawai()->sync($request->pegawai_id);

        return redirect()->route('agenda.index')->with('success', 'Data agenda berhasil diperbarui.');
    }

    public function updateStatus($id)
    {
        $agendaKegiatan         = AgendaKegiatan::findOrFail($id);
        $agendaKegiatan->status = 'Selesai';
        $agendaKegiatan->save();

        return redirect()->route('agenda.index')->with('success', 'Status agenda berhasil diubah menjadi Selesai.');
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
        $jumlahBelumSelesai = AgendaKegiatan::whereIn('status', ['In Progress', 'In Proses', 'Belum Selesai'])->get();
        return view('backend.status.countBelumSelesai', compact('jumlahBelumSelesai'));
    }
}
