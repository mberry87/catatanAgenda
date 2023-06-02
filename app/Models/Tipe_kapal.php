<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe_kapal extends Model
{
    protected $table = 'tipe_kapal';

    protected $fillable = ['nama', 'kode'];

    public function kapal()
    {
        return $this->hasMany(Kapal::class, 'tipe_kapal_id');
    }
}
