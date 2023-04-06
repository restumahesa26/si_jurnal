<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;

    public $table = 'kelas_siswa';

    public $fillable = [
        'id', 'kelas_id', 'nis'
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nis', 'nis');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id', 'kelas_id');
    }

    public function hitungStatus($id, $nis, $mapel)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = $this
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.mapel_id', $mapel)
        ->where('absen.status', $id)
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        return $count;
    }

    public function hitungStatus2($id, $nis)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = KelasSiswa::join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.status', $id)
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        return $count;
    }

    public function hitungPersentase($nis, $mapel)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = $this
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.mapel_id', '=', $mapel)
        ->where('absen.status', '=', 'Hadir')
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $count2 = $this
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.mapel_id', '=', $mapel)
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $hasil = 0;

        if($count > 0 && $count2 > 0){
            $hasil = $count * 100 / $count2;
        }

        return number_format((float)$hasil, 2, '.', '');
    }

    public function hitungPersentase2($nis)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = $this
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.status', '=', 'Hadir')
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $count2 = $this
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $hasil = 0;

        if($count > 0 && $count2 > 0){
            $hasil = $count * 100 / $count2;
        }

        return number_format((float)$hasil, 2, '.', '');
    }
}
