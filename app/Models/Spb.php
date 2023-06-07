<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    protected $table = 'spb';

    protected $fillable = [

        'no_regis',
        'no_surat',
        'tgl_surat',
        'pemohon',
        'kapal_id',
        'bendera',
        'tipe_kapal',
        'gt',
        'call_sign',
        'perusahaan',
        'pelabuhan_id',
        'pegawai_id',
        'no_imo',
        'thn_produksi',
        'nakhoda',
        'tgl_nakhoda',
        'jam_nakhoda',
        'bertolak',
        'tgl_bertolak',
        'jam_bertolak',
        'jml_crew',
        'muatan',
        'tmp_terbit',
        'tgl_terbit',
        'jam_terbit',
        'no_pup',

    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class, 'kapal_id');
    }

    public function pelabuhan()
    {
        return $this->belongsTo(Pelabuhan::class, 'pelabuhan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    // membuat no surat otomatis
    public function generateNomorSurat()
    {
        // Logika untuk menghasilkan nomor surat
        // Contoh: "SURAT/2023/001"
        $tahun = date('Y');
        $nomor = $this->max('id') + 1; // Mengambil id terbesar dan ditambah 1
        $nomor_surat = 'SURAT/' . $tahun . '/' . str_pad($nomor, 3, '0', STR_PAD_LEFT);

        return $nomor_surat;
    }

    // membuat no regis SPB otomatis
    public function generateNomorRegis()
    {
        // Logika untuk menghasilkan nomor surat
        // Contoh: "REGIS/2023/001"
        $tahun = date('Y');
        $nomor = $this->max('id') + 1; // Mengambil id terbesar dan ditambah 1
        $nomor_regis = 'REGIS/' . 'SPB/' . $tahun . '/' . str_pad($nomor, 3, '0', STR_PAD_LEFT);

        return $nomor_regis;
    }
}
