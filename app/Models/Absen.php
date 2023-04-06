<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    public $table = 'absen';

    public $fillable = [
        'kelas_siswa_id', 'status', 'tanggal', 'mapel_id'
    ];

    public function kelasSiswa()
    {
        return $this->hasOne(KelasSiswa::class, 'id', 'kelas_siswa_id');
    }

    public function mataPelajaran()
    {
        return $this->hasOne(MataPelajaran::class, 'id', 'mapel_id');
    }

    public function hitungStatus($id, $nis, $mapel)
    {
        $count = $this
        ->join('kelas_siswa', 'kelas_siswa.id', '=', 'kelas_siswa_id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->where('siswa.nis', '=', $nis)
        ->where('mapel_id', $mapel)
        ->where('status', $id)
        ->count();

        return $count;
    }

    public function hitungPersentase($nis, $mapel)
    {
        $count2 = $this
        ->join('kelas_siswa', 'kelas_siswa.id', '=', 'kelas_siswa_id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->where('siswa.nis', '=', $nis)
        ->where('mapel_id', $mapel)
        ->count();

        $count = $this
        ->join('kelas_siswa', 'kelas_siswa.id', '=', 'kelas_siswa_id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->where('siswa.nis', '=', $nis)
        ->where('mapel_id', $mapel)
        ->where('status', 'Hadir')
        ->count();

        $hasil = $count * 100 / $count2;

        return number_format((float)$hasil, 2, '.', '');
    }
}
