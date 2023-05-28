<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Riyan Saputra',
                'nip' => '19850102 123456 001 1',
                'gol' => 'A'
            ],

            [
                'nama' => 'Putri Cempaka',
                'nip' => '19900505 123456 001 1',
                'gol' => 'B'
            ],

            [
                'nama' => 'Susi Susanti',
                'nip' => '19871201 123456 001 1',
                'gol' => 'C'
            ],
        ];

        foreach ($data as $pegawaiData) {
            Pegawai::create($pegawaiData);
        }
    }
}
