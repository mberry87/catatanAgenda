<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipe_kapal;

class Tipe_kapalSeeder extends Seeder
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
                'nama' => 'Tongkang layar',
                'kode' => 'SB',
            ],
            [
                'nama' => 'Barge',
                'kode' => 'BG',
            ],
            [
                'nama' => 'Motor Tangker',
                'kode' => 'MT',
            ]
        ];
        foreach ($data as $tipe_dataData) {
            Tipe_kapal::create($tipe_dataData);
        }
    }
}
