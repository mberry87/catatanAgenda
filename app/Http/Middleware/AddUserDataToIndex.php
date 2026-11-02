<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AgendaKegiatan;
use Carbon\Carbon;

class AddUserDataToIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userData = Auth::user();
        view()->share('userData', $userData);

        if (Auth::check()) {
            $today = Carbon::today();

            // Ambil semua agenda yang belum selesai
            $activeAgendas = AgendaKegiatan::with(['instansi', 'pegawai'])
                ->where('status', '!=', 'Selesai')
                ->get();

            $agendaReminders = [];

            foreach ($activeAgendas as $agenda) {
                // Otomatis update status ke 'In Progress' jika sudah hari H
                if ($agenda->isHariH()) {
                    if ($agenda->status !== 'In Progress') {
                        $agenda->status = 'In Progress';
                        $agenda->save();
                    }
                    $agendaReminders[] = [
                        'id'      => $agenda->id,
                        'uraian'  => $agenda->uraian,
                        'waktu'   => 'Hari Ini (' . $agenda->pukul . ')',
                        'tempat'  => $agenda->tempat,
                        'tipe'    => 'Hari H',
                    ];
                } elseif ($agenda->isHMinus1()) {
                    $agendaReminders[] = [
                        'id'      => $agenda->id,
                        'uraian'  => $agenda->uraian,
                        'waktu'   => 'Besok (' . $agenda->pukul . ')',
                        'tempat'  => $agenda->tempat,
                        'tipe'    => 'H-1',
                    ];
                }
            }

            view()->share('agendaReminders', $agendaReminders);
        }

        return $next($request);
    }
}
