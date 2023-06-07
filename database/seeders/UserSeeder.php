<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'superuser',
                'username' => 'superuser',
                'email' => 'berry311287@gmail.com',
                'password' => Hash::make('superuser123'),


            ],

        ];

        foreach ($data as $tipe_dataData) {
            User::create($tipe_dataData);
        }
    }
}
