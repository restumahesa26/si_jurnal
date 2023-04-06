<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public $table = 'kelas';

    public $fillable = [
        'jenjang', 'kelas', 'tahun_ajaran_id', 'wali_kelas'
    ];

    public function waliKelas()
    {
        return $this->hasOne(Guru::class, 'nip', 'wali_kelas');
    }

    public function totalSiswa($id)
    {
        $count = KelasSiswa::where('kelas_id', $id)->count();

        return $count;
    }

    public function kelas_siswa()
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id', 'id')->join('siswa', 'siswa.nis', 'kelas_siswa.nis')->orderBy('siswa.nama', 'ASC');
    }

    public function mapel()
    {
        return $this->hasMany(MataPelajaran::class, 'kelas_id', 'id');
    }
}
