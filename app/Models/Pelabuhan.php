<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelabuhan extends Model
{
    protected $table = 'pelabuhan';

    protected $fillable = [
        'nama',
        'kode'
    ];

    public function spb()
    {
        return $this->hasMany(Spb::class, 'pelabuhan_id');
    }
}
