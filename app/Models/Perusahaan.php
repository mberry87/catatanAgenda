<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';

    protected $fillable = [
        'nama',
        'status',
        'alamat',
        'telepon',
        'email',
    ];

    public function kapal()
    {
        return $this->hasMany(Kapal::class, 'perusahaan_id');
    }
}
