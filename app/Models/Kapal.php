<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    protected $table = 'kapal';

    protected $fillable = [
        'nama',
        'call_sign',
        'bendera_id',
        'tipe_kapal_id',
        'gt',
        'dwt',
        'loa',
        'kapasitas',
        'perusahaan_id',
        'thn_produksi',
        'tgl_docking'
    ];

    public function bendera()
    {
        return $this->belongsTo(Bendera::class, 'bendera_id');
    }

    public function tipe_kapal()
    {
        return $this->belongsTo(Tipe_kapal::class, 'tipe_kapal_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
