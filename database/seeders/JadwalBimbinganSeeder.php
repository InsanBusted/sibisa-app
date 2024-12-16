<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalBimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) { // Sesuaikan jumlah data yang ingin diinsert
            DB::table('jadwal_bimbingans')->insert([
                'tanggal' => date('Y-m-d', strtotime('2024-12-01 +' . rand(0, 30) . ' days')), // Tanggal acak dalam Desember 2024
                'jam' => date('H:i:s', strtotime(rand(8, 16) . ':' . rand(0, 59) . ':' . rand(0, 59))), // Jam antara 08:00:00 - 16:59:59
                'dosen_id' => null,
                'mahasiswa_id' => null,
                'status' => $this->getRandomStatus(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['Pending', 'Disetujui', 'Ditolak'];
        return $statuses[array_rand($statuses)];
    }
}
