<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AgendaKegiatan;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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

        if (Auth::check() && !$request->expectsJson() && !$request->ajax()) {
            $today = Carbon::today();

            // Ambil semua agenda yang belum selesai
            $activeAgendas = AgendaKegiatan::with(['instansi', 'pegawai'])
                ->where('status', '!=', 'Selesai')
                ->get();

            $readReminderKeys = Cache::get('user_' . Auth::id() . '_read_reminders', []);
            $agendaReminders = [];

            foreach ($activeAgendas as $agenda) {
                // Otomatis update status ke 'In Progress' jika sudah hari H
                if ($agenda->isHariH()) {
                    if ($agenda->status !== 'In Progress') {
                        $agenda->status = 'In Progress';
                        $agenda->save();
                    }
                    $key = $agenda->id . '_Hari H';
                    $agendaReminders[] = [
                        'key'     => $key,
                        'id'      => $agenda->id,
                        'uraian'  => $agenda->uraian,
                        'waktu'   => 'Hari Ini (' . $agenda->pukul . ')',
                        'tempat'  => $agenda->tempat,
                        'tipe'    => 'Hari H',
                        'is_read' => in_array($key, $readReminderKeys, true),
                    ];
                } elseif ($agenda->isHMinus1()) {
                    $key = $agenda->id . '_H-1';
                    $agendaReminders[] = [
                        'key'     => $key,
                        'id'      => $agenda->id,
                        'uraian'  => $agenda->uraian,
                        'waktu'   => 'Besok (' . $agenda->pukul . ')',
                        'tempat'  => $agenda->tempat,
                        'tipe'    => 'H-1',
                        'is_read' => in_array($key, $readReminderKeys, true),
                    ];
                }
            }

            $unreadReminderCount = collect($agendaReminders)->where('is_read', false)->count();

            view()->share('agendaReminders', $agendaReminders);
            view()->share('unreadReminderCount', $unreadReminderCount);

            if ($userData) {
                if (!$userData->last_seen_at || $userData->last_seen_at->lt(now()->subSeconds(30))) {
                    $userData->timestamps = false;
                    $userData->last_seen_at = now();
                    $userData->save();
                    $userData->timestamps = true;
                }

                $hasChatAccess = $userData->hasPermission('chat.access');
                $unreadChatCount = $hasChatAccess
                    ? ChatMessage::where('receiver_id', $userData->id)
                        ->whereNull('read_at')
                        ->where('deleted_by_receiver', false)
                        ->count()
                    : 0;

                $recentUnreadChats = $hasChatAccess
                    ? ChatMessage::with('sender')
                        ->where('receiver_id', $userData->id)
                        ->whereNull('read_at')
                        ->where('deleted_by_receiver', false)
                        ->latest('id')
                        ->take(5)
                        ->get()
                    : collect();

                view()->share('unreadChatCount', $unreadChatCount);
                view()->share('recentUnreadChats', $recentUnreadChats);
            }
        }

        return $next($request);
    }
}
