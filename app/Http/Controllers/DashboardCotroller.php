<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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

    /**
     * Ambil daftar Hari Libur Nasional / Hari Besar dari API gratis (dengan cache 24 jam).
     */
    public function holidays(Request $request)
    {
        $startYear = $request->filled('start')
            ? Carbon::parse($request->input('start'))->year
            : Carbon::now()->year;
        $endYear = $request->filled('end')
            ? Carbon::parse($request->input('end'))->year
            : $startYear;

        $years = range(min($startYear, $endYear), max($startYear, $endYear));
        $events = [];

        foreach ($years as $year) {
            $yearEvents = Cache::remember("national_holidays_{$year}", now()->addHours(24), function () use ($year) {
                $items = [];

                // Primary: API Hari Libur Indonesia
                try {
                    $response = Http::timeout(5)->get("https://api-harilibur.vercel.app/api?year={$year}");
                    if ($response->successful() && is_array($response->json())) {
                        foreach ($response->json() as $row) {
                            if (!empty($row['holiday_date']) && !empty($row['holiday_name'])) {
                                $items[] = [
                                    'date' => Carbon::parse($row['holiday_date'])->format('Y-m-d'),
                                    'name' => $row['holiday_name'],
                                ];
                            }
                        }
                    }
                } catch (\Throwable $e) {
                    // Fallback ke Nager.Date di bawah
                }

                // Fallback: Nager.Date Public Holidays API (ID)
                if (empty($items)) {
                    try {
                        $response = Http::timeout(5)->get("https://date.nager.at/api/v3/PublicHolidays/{$year}/ID");
                        if ($response->successful() && is_array($response->json())) {
                            foreach ($response->json() as $row) {
                                if (!empty($row['date']) && (!empty($row['localName']) || !empty($row['name']))) {
                                    $items[] = [
                                        'date' => Carbon::parse($row['date'])->format('Y-m-d'),
                                        'name' => $row['localName'] ?? $row['name'],
                                    ];
                                }
                            }
                        }
                    } catch (\Throwable $e) {
                        // Abaikan jika offline
                    }
                }

                return $items;
            });

            foreach ($yearEvents as $item) {
                $events[] = [
                    'title'           => $item['name'],
                    'start'           => $item['date'],
                    'allDay'          => true,
                    'backgroundColor' => '#dc3545',
                    'borderColor'     => '#dc3545',
                    'textColor'       => '#ffffff',
                ];
            }
        }

        return response()->json($events);
    }

    /**
     * Tandai notifikasi lonceng agenda sudah dibaca.
     */
    public function markNotificationsRead(Request $request)
    {
        $userId = Auth::id();
        $cacheKey = 'user_' . $userId . '_read_reminders';
        $readKeys = Cache::get($cacheKey, []);

        $keys = $request->input('keys', []);
        if (is_array($keys) && count($keys) > 0) {
            $readKeys = array_values(array_unique(array_merge($readKeys, $keys)));
        } else {
            // Tandai semua agenda aktif Hari H dan H-1 saat ini sebagai sudah dibaca
            $activeAgendas = AgendaKegiatan::where('status', '!=', 'Selesai')->get();
            foreach ($activeAgendas as $agenda) {
                if ($agenda->isHariH()) {
                    $readKeys[] = $agenda->id . '_Hari H';
                } elseif ($agenda->isHMinus1()) {
                    $readKeys[] = $agenda->id . '_H-1';
                }
            }
            $readKeys = array_values(array_unique($readKeys));
        }

        Cache::forever($cacheKey, $readKeys);

        return response()->json(['ok' => true, 'unread_count' => 0]);
    }
}
