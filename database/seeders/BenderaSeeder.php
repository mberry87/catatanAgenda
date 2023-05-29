<?php

namespace Database\Seeders;

use App\Models\Bendera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenderaSeeder extends Seeder
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
                'nama' => 'Indonesia',
                'kode' => 'IDN',
            ],
            [
                'nama' => 'Malaysia',
                'kode' => 'MLY',
            ],
            [
                'nama' => 'Singapura',
                'kode' => 'SNG',
            ],

        ];

        foreach ($data as $benderaData) {
            Bendera::create($benderaData);
        }
    }
}
