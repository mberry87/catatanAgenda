<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email',
    ];

    // public function kapal()
    // {
    //     return $this->hasMany(Kapal::class, 'perusahaan_id');
    // }
}
