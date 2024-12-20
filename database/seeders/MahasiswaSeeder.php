<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = [];

        for ($i = 1; $i <= 10; $i++) {
            $mahasiswas[] = [
                'nim' => 'NIM' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama' => 'Mahasiswa ' . $i,
                'email' => 'mahasiswa' . $i .'@mahasiswa.com',
                'prodi_id' => rand(1, 3), 
                'jadwal_bimbingan_id' => rand(1, 10), 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('mahasiswas')->insert($mahasiswas);
    }
}
