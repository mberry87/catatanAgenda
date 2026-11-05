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
                'name' => 'Admin KSOP',
                'username' => 'admin',
                'email' => 'superadmin@gmail.com',
                'nip' => '198503122010011001',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@ksop.go.id',
                'nip' => '197902142006041002',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Siti Aminah',
                'username' => 'siti',
                'email' => 'siti@ksop.go.id',
                'nip' => '199105232015022003',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        ];

        foreach ($data as $row) {
            User::updateOrCreate(['email' => $row['email']], $row);
        }
    }
}
