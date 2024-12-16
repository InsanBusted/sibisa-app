<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Prodi extends Model
{
    use HasRoles;

    protected $table = "prodi";
    protected $fillable = ["nama"];

    public function mahasiswa() {
        return $this->hasMany(Mahasiswa::class,'prodi_id');
    }
    public function dosen() {
        return $this->hasMany(Dosen::class,'prodi_id');
    }
}
