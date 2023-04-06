<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAjaran::create([
            'tahun_ajaran' => '2022 / 2023',
            'semester' => 'Genap',
            'status' => 'Aktif'
        ]);
    }
}
