<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    protected $table = 'spb';

    protected $fillable = [
        'kapal_id',
        'call_sign',
        'bendera',
        'tipe_kapal',
        'perusahaan',
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class, 'kapal_id');
    }
}
