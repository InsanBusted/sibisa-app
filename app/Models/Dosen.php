<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Dosen extends Model
{
    use HasRoles;
    protected $table = "dosens";
    protected $fillable = ['nip','nama','email', 'prodi_id','jadwalbimbingan_id']; 

    public function prodi() {
        return $this->belongsTo(Prodi::class,'prodi_id');
    }
    public function jadwalbimbingan() {
        return $this->hasMany(JadwalBimbingan::class,'dosen_id');
    }
}
