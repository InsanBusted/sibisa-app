<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatBimbingan extends Model
{
    use HasFactory;
    protected $fillable = ['jadwal_bimbingan_id', 'catatan_dosen', 'catatan_mahasiswa', 'status', 'file'];
    
    public function jadwalBimbingan()
    {
        return $this->belongsTo(JadwalBimbingan::class);
    }

}
