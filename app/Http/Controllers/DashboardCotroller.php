<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_pegawai     = Pegawai::count();
        $tanggal_agenda     = AgendaKegiatan::whereIn('status', ['In Progress', 'In Proses', 'Belum Selesai'])
            ->orderBy('tgl_mulai')
            ->get(['id', 'jenis_agenda', 'tgl_mulai', 'tgl_selesai', 'uraian', 'status']);

        $count_in_progress  = AgendaKegiatan::whereIn('status', ['In Progress', 'In Proses', 'Belum Selesai'])->count();
        $count_selesai      = AgendaKegiatan::where('status', 'Selesai')->count();

        return view('backend.dashboard.index', compact(
            'jumlah_pegawai',
            'tanggal_agenda',
            'count_in_progress',
            'count_selesai'
        ));
    }
}
