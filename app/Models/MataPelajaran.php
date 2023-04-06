<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    public $table = 'mata_pelajaran';

    public $fillable = [
        'nama_mata_pelajaran', 'hari', 'jam_mulai', 'jam_akhir', 'kelas_id', 'guru'
    ];

    public function getDataSiswa($nis)
    {
        $item = MataPelajaran::join('kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
            ->join('kelas_siswa', 'kelas_siswa.kelas_id', '=', 'kelas.id')
            ->where('kelas_siswa.nis', $nis)
            ->first(['siswa.*']);

        return $item;
    }

    public function mata_pelajaran()
    {
        return $this->hasOne(MasterMataPelajaran::class, 'id', 'mata_pelajaran_id');
    }

    public function guruPengampu()
    {
        return $this->hasOne(Guru::class, 'nip', 'guru');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id', 'kelas_id');
    }

    public function getSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id', 'kelas_id')->whereDate('tanggal', Carbon::now());
    }

    public function getAllSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id', 'kelas_id')->join('siswa', 'siswa.nis', 'kelas_siswa.nis')->orderBy('siswa.nama', 'ASC');
    }

    public function getAbsen()
    {
        return $this->hasMany(Absen::class, 'mapel_id', 'id')->whereDate('tanggal', Carbon::now());
    }

    public function getJurnal()
    {
        return $this->hasOne(Jurnal::class, 'mapel_id', 'id')->whereDate('tanggal', Carbon::now());
    }

    public function getAllAbsen()
    {
        return $this->hasMany(Absen::class, 'mapel_id', 'id');
    }

    public function checkAbsen($id)
    {
        $check = Absen::whereDate('tanggal', Carbon::now())->where('mapel_id', $id)->first();

        if ($check != NULL) {
            return 'Error';
        } else {
            return 'Success';
        }
    }

    public function checkJurnal($id)
    {
        $check = Jurnal::whereDate('tanggal', Carbon::now())->where('mapel_id', $id)->first();

        if ($check != NULL) {
            return 'Error';
        } else {
            return 'Success';
        }
    }

    public function absen()
    {
        return $this->hasMany(Absen::class, 'mapel_id', 'id');
    }

    public function checkStatusAbsen($mapel_id, $nis)
    {
        $item = Absen::join('kelas_siswa', 'kelas_siswa.id', '=', 'absen.kelas_siswa_id')
            ->where('kelas_siswa.nis', $nis)
            ->where('absen.mapel_id', $mapel_id)
            ->whereDate('absen.tanggal', Carbon::now())
            ->first();

        if ($item != NULL) {
            return $item->status;
        } else {
            return '-';
        }
    }
}
