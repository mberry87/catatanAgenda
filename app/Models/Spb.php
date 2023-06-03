<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    protected $table = 'spb';

    protected $fillable = [
        'kapal_id',
        'no_surat',
        'tgl_surat',
        'no_regis',
        'bendera',
        'tipe_kapal',
        'gt',
        'call_sign',
        'perusahaan',
        'no_imo',
        'thn_produksi',
        'nakhoda',
        'waktu_nakhoda',
        'bertolak',
        'waktu_bertolak',
        'pelabuhan_id',
        'jml_crew',
        'muatan',
        'tmp_terbit',
        'waktu_terbit',
        'petugas',
        'no_pup',
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class, 'kapal_id');
    }

    public function pelabuhan()
    {
        return $this->belongsTo(Kapal::class, 'pelabuhan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
