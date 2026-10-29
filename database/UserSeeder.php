<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'dosen@siakad.test'],
            [
                'name' => 'Dosen SIAKAD',
                'password' => Hash::make('password123'),
                'role' => 'dosen',
            ]
        );

        User::updateOrCreate(
            ['email' => 'mahasiswa@siakad.test'],
            [
                'name' => 'Mahasiswa SIAKAD',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
            ]
        );
    }
}
