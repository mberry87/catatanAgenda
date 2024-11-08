<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class AgendaKegiatan extends Model
{
    use HasFactory;

    protected $table = 'agenda_kegiatan';

    protected $attributes = [
        'status' => 'Belum Selesai'
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
}
