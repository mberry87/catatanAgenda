<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AgendaKegiatan extends Model
{
    use HasFactory;

    protected $table = 'agenda_kegiatan';

    protected $attributes = [
        'status' => 'In Progress'
    ];

    protected $fillable = [
        'nmr_surat',
        'uraian',
        'tgl_mulai',
        'tgl_selesai',
        'pakaian',
        'pukul',
        'tempat',
        'instansi_id',
        'jenis_agenda',
        'status',
        'keterangan'
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'agenda_pegawai');
    }

    /**
     * Parse tgl_mulai safely as Carbon
     */
    public function getParsedTglMulaiAttribute()
    {
        if (!$this->tgl_mulai) return null;
        try {
            return Carbon::parse($this->tgl_mulai)->startOfDay();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Parse tgl_selesai safely as Carbon
     */
    public function getParsedTglSelesaiAttribute()
    {
        if (!$this->tgl_selesai) return $this->parsed_tgl_mulai;
        try {
            return Carbon::parse($this->tgl_selesai)->endOfDay();
        } catch (\Exception $e) {
            return $this->parsed_tgl_mulai;
        }
    }

    /**
     * Cek apakah hari ini sudah Hari H (antara tgl_mulai s.d tgl_selesai)
     */
    public function isHariH()
    {
        $start = $this->parsed_tgl_mulai;
        $end = $this->parsed_tgl_selesai;
        if (!$start) return false;
        $today = Carbon::today();
        return $today->gte($start) && $today->lte($end);
    }

    /**
     * Cek apakah hari ini adalah H-1 sebelum tgl_mulai
     */
    public function isHMinus1()
    {
        $start = $this->parsed_tgl_mulai;
        if (!$start) return false;
        $today = Carbon::today();
        return $today->diffInDays($start, false) === 1;
    }

    /**
     * Cek apakah agenda sudah lewat dari tgl_selesai
     */
    public function isLewat()
    {
        $end = $this->parsed_tgl_selesai;
        if (!$end) return false;
        $today = Carbon::today();
        return $today->gt($end);
    }

    /**
     * Ambil status yang efektif untuk tampilan badge
     */
    public function getStatusBadgeInfoAttribute()
    {
        if ($this->status === 'Selesai') {
            return [
                'label' => 'Selesai',
                'class' => 'badge-success',
                'icon'  => 'fas fa-check-circle',
            ];
        }

        // Jika sudah Hari H, otomatis In Progress
        if ($this->isHariH()) {
            return [
                'label' => 'In Progress',
                'class' => 'badge-warning text-dark',
                'icon'  => 'fas fa-play-circle',
            ];
        }

        // Jika H-1, tampilkan badge H-1 (Besok)
        if ($this->isHMinus1()) {
            return [
                'label' => 'H-1 (Besok)',
                'class' => 'badge-info',
                'icon'  => 'fas fa-bell',
            ];
        }

        // Jika belum hari H (mendatang)
        $start = $this->parsed_tgl_mulai;
        if ($start && Carbon::today()->lt($start)) {
            $days = Carbon::today()->diffInDays($start, false);
            return [
                'label' => "Terjadwal (H-$days)",
                'class' => 'badge-primary',
                'icon'  => 'fas fa-calendar-alt',
            ];
        }

        // Default In Progress
        return [
            'label' => 'In Progress',
            'class' => 'badge-warning text-dark',
            'icon'  => 'fas fa-play-circle',
        ];
    }
}
