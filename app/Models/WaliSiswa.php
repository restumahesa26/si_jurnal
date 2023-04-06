<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliSiswa extends Model
{
    use HasFactory;

    public $table = 'wali_siswa';

    public $fillable = [
        'id', 'user_id', 'jenis_kelamin', 'no_handphone', 'agama', 'pendidikan', 'pekerjaan', 'alamat'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'wali_siswa_id', 'id');
    }
}
