<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use App\Models\WakaKurikulum;
use App\Models\WaliSiswa;
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
        User::create([
            'nama' => 'Admin',
            'role' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $guru = User::create([
            'nama' => 'Aqmal Tustri',
            'role' => 'Guru',
            'email' => 'aqmal@gmail.com',
            'password' => Hash::make('password')
        ]);

        Guru::create([
            'nip' => '123456789101112',
            'jenis_kelamin' => 'P',
            'user_id' => $guru->id
        ]);

        $waka = User::create([
            'nama' => 'Jokowi',
            'role' => 'Waka-Kurikulum',
            'email' => 'jokowi@gmail.com',
            'password' => Hash::make('password')
        ]);

        WakaKurikulum::create([
            'nip' => '123456789101113',
            'jenis_kelamin' => 'P',
            'user_id' => $waka->id
        ]);
    }
}
