<?php

namespace Database\Seeders;

use App\Models\RiwayatBimbingan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatBimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 15 data Riwayat Bimbingan
        foreach (range(1, 13) as $index) {
            RiwayatBimbingan::create([
                'jadwal_bimbingan_id' => rand(24, 35),
                'catatan' => 'Catatan ke-' . $index . ' untuk Bimbingan',
                'status' => $this->getRandomStatus(), // Ambil status acak
            ]);
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['Proses', 'Revisi', 'ACC'];
        return $statuses[array_rand($statuses)]; // Mengambil status acak dari array
    }
}
