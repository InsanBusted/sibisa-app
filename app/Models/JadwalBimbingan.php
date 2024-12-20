<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class JadwalBimbingan extends Model
{
    use HasFactory, HasRoles;
    protected $table = "jadwal_bimbingans";

    protected $fillable = ["tanggal", "jam", "dosen_id", "mahasiswa_id", "status"];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id');
    }
    public function dosen() {
        return $this->belongsTo(Dosen::class,'dosen_id');
    }

    public function riwayatBimbingan()
    {
        return $this->hasMany(RiwayatBimbingan::class);
    }
}
