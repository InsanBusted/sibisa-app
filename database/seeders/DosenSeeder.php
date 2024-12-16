<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosens = [];

        for ($i = 1; $i <= 10; $i++) {
            $dosens[] = [
                'nip' => 'NIP' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama' => 'Dosen ' . $i,
                'email' => 'dosen' . $i . '@example.com',
                'prodi_id' => rand(1, 3), 
                'jadwalbimbingan_id' => rand(2, 21), 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('dosens')->insert($dosens);
    }
}
