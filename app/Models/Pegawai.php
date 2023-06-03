<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // use HasFactory;
    protected $table = 'pegawai';

    protected $fillable = ['nama', 'nip', 'gol'];

    public function spb()
    {
        return $this->hasMany(Spb::class, 'pegawai_id');
    }
}
