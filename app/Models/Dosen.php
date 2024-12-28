<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Dosen extends Model
{
    use HasRoles;
    protected $table = "dosens";
    protected $fillable = ['nama','email','nip', 'prodi_id','jadwal_bimbingan_id', 'user_id']; 

    public function prodi() {
        return $this->belongsTo(Prodi::class,'prodi_id');
    }
    public function jadwalbimbingan() {
        return $this->hasMany(JadwalBimbingan::class,'dosen_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Sesuaikan nama foreign key jika berbeda
    }
}
