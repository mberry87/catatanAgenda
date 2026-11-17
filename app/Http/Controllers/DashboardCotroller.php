<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\Pegawai;
use Carbon\Carbon;

class DashboardCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_pegawai = Pegawai::count();
        $tanggal_agenda = AgendaKegiatan::whereIn('status', ['In Progress', 'In Proses', 'Belum Selesai'])
            ->orderBy('tgl_mulai')
            ->get(['id', 'jenis_agenda', 'tgl_mulai', 'tgl_selesai', 'uraian', 'status']);

        $count_in_progress = AgendaKegiatan::whereIn('status', ['In Progress', 'In Proses', 'Belum Selesai'])->count();
        $count_selesai = AgendaKegiatan::where('status', 'Selesai')->count();

        // Data grafik 6 bulan terakhir
        $chartMonths = [];
        $chartInProgress = [];
        $chartSelesai = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartMonths[] = $month->translatedFormat('M Y');

            $chartInProgress[] = AgendaKegiatan::whereYear('tgl_mulai', $month->year)
                ->whereMonth('tgl_mulai', $month->month)
                ->whereIn('status', ['In Progress', 'In Proses', 'Belum Selesai'])
                ->count();

            $chartSelesai[] = AgendaKegiatan::whereYear('tgl_mulai', $month->year)
                ->whereMonth('tgl_mulai', $month->month)
                ->where('status', 'Selesai')
                ->count();
        }

        // Distribusi jenis agenda
        $hadirFisik = AgendaKegiatan::where('jenis_agenda', 'Hadir Fisik')->count();
        $daring = AgendaKegiatan::where('jenis_agenda', 'Zoom Meet (Daring)')->count();
        $lainnya = AgendaKegiatan::whereNotIn('jenis_agenda', ['Hadir Fisik', 'Zoom Meet (Daring)'])->count();

        $jenisCounts = [
            'Hadir Fisik' => $hadirFisik,
            'Zoom Meet (Daring)' => $daring,
            'Lainnya' => $lainnya,
        ];

        return view('backend.dashboard.index', compact(
            'jumlah_pegawai',
            'tanggal_agenda',
            'count_in_progress',
            'count_selesai',
            'chartMonths',
            'chartInProgress',
            'chartSelesai',
            'jenisCounts'
        ));
    }
}
