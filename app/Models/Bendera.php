<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendera extends Model
{
    protected $table = 'bendera';

    protected $fillable = ['nama', 'kode'];
}
