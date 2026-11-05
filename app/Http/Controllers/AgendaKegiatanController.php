<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\Instansi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
        $agendaKegiatan = AgendaKegiatan::with(['pegawai', 'instansi', 'user'])->orderBy('tgl_mulai', 'desc')->get();

        return view('backend.agenda.index', compact('agendaKegiatan'));
    }

    public function pdf(Request $request)
    {
        $validated = $request->validate([
            'dari'   => ['required', 'date'],
            'sampai' => ['required', 'date', 'after_or_equal:dari'],
            'status' => ['nullable', 'in:' . implode(',', self::STATUS_LIST)],
        ], [
            'dari.required'   => 'Tanggal mulai wajib diisi.',
            'sampai.required' => 'Tanggal selesai wajib diisi.',
            'sampai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ]);

        $dari   = $validated['dari'];
        $sampai = $validated['sampai'];
        $status = $validated['status'] ?? null;

        $agendaKegiatan = AgendaKegiatan::with(['pegawai', 'user'])
            ->when($status !== null, fn ($q) => $q->where('status', $status))
            ->whereDate('tgl_mulai', '>=', $dari)
            ->whereDate('tgl_mulai', '<=', $sampai)
            ->orderBy('tgl_mulai')
            ->get();

        // Bulan & tahun untuk header PDF (dari tanggal mulai)
        $bulan = \Carbon\Carbon::parse($dari)->locale('id')->translatedFormat('F');
        $tahun = \Carbon\Carbon::parse($dari)->format('Y');

        // Nama file: laporan-agenda-in-progress-2026-11-01-sd-2026-11-30.pdf
        $labelStatus = $status !== null ? str_replace(' ', '-', strtolower($status)) : 'semua';
        $rentang = str_replace('-', '', $dari) . '-sd-' . str_replace('-', '', $sampai);

        return Pdf::loadView('backend.agenda.pdf', compact('agendaKegiatan', 'status', 'bulan', 'tahun', 'dari', 'sampai'))
            ->setPaper('a4', 'landscape')
            ->download('laporan-agenda-' . $labelStatus . '-' . $rentang . '.pdf');
    }

    /**
     * Kirim detail agenda via WhatsApp (buka WhatsApp dengan pesan yang sudah terisi).
     */
    public function whatsapp($id)
    {
        $agenda = AgendaKegiatan::with(['pegawai', 'instansi'])->findOrFail($id);

        $tanggal = \Carbon\Carbon::parse($agenda->tgl_mulai)->translatedFormat('l, d F Y');
        $tanggalSelesai = \Carbon\Carbon::parse($agenda->tgl_selesai)->translatedFormat('l, d F Y');
        $pegawaiNama = $agenda->pegawai->pluck('nama')->implode(', ') ?: '-';

        $lines = [
            '*AGENDA KEGIATAN*',
            '',
            'Uraian : ' . $agenda->uraian,
            'Hari, Tanggal : ' . $tanggal,
            's.d. : ' . $tanggalSelesai,
            'Pukul : ' . $agenda->pukul . ' WIB',
            'Tempat : ' . $agenda->tempat,
            'Pakaian : ' . $agenda->pakaian,
            'Jenis Agenda : ' . $agenda->jenis_agenda,
            'Undangan Dari : ' . ($agenda->instansi->nama ?? '-'),
            'Menghadiri : ' . $pegawaiNama,
            'Status : ' . $agenda->status,
        ];

        if ($agenda->keterangan) {
            $lines[] = 'Keterangan : ' . $agenda->keterangan;
        }

        $text = implode("\n", $lines);

        return redirect()->away('https://wa.me/?text=' . rawurlencode($text));
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
            'uraian'       => 'required',
            'tgl_mulai'    => 'required',
            'tgl_selesai'  => 'required',
            'pakaian'      => 'required',
            'pukul'        => 'required',
            'tempat'       => 'required',
            'pegawai_id'   => 'nullable|array',
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
            'uraian'       => $validatedData['uraian'],
            'user_id'      => Auth::id(),
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

        $pegawaiIds = collect($validatedData['pegawai_id'] ?? [])->map(function ($value) {
            if (is_numeric($value)) return (int) $value;
            return Pegawai::firstOrCreate(['nama' => trim($value)], ['nip' => '-', 'gol' => '-'])->id;
        })->filter()->values()->all();
        $agendaKegiatan->pegawai()->sync($pegawaiIds);

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
            'uraian'       => 'required',
            'tgl_mulai'    => 'required',
            'tgl_selesai'  => 'required',
            'pakaian'      => 'required',
            'pukul'        => 'required',
            'tempat'       => 'required',
            'pegawai_id'   => 'nullable|array',
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

        $pegawaiIds = collect($request->input('pegawai_id', []))->map(function ($value) {
            if (is_numeric($value)) return (int) $value;
            return Pegawai::firstOrCreate(['nama' => trim($value)], ['nip' => '-', 'gol' => '-'])->id;
        })->filter()->values()->all();
        $agenda->pegawai()->sync($pegawaiIds);

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
