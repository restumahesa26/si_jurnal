<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    public $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'nis', 'nisn', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'wali_siswa_id', 'angkatan'
    ];

    public function wali()
    {
        return $this->hasOne(WaliSiswa::class, 'id', 'wali_siswa_id');
    }

    public function checkSiswa($nis)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $item = Siswa::where('siswa.nis', $nis)
            ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
            ->join('kelas AS kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
            ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
            ->first();

        if ($item != NULL) {
            return false;
        }else {
            return true;
        }
    }

    public function hitungStatus($id, $nis, $mapel)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = $this
        ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
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

        $count = Siswa::join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
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
        ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.mapel_id', $mapel)
        ->where('absen.status', '=', 'Hadir')
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $count2 = $this
        ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.mapel_id', $mapel)
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
        ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->where('siswa.nis', '=', $nis)
        ->where('absen.status', '=', 'Hadir')
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $count2 = $this
        ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
        ->join('absen', 'absen.kelas_siswa_id', '=', 'kelas_siswa.id')
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

    // public function cekKelas($nis)
    // {
    //     $item = Siswa::where('siswa.nis', $nis)
    //         ->join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')
    //         ->join('kelas AS kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
    //         ->orderBy('')
    // }

    public function mata_pelajaran()
    {
        $date = Carbon::now()->translatedFormat('l');

        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $item = MataPelajaran::join('kelas_siswa', 'kelas_siswa.nis', '=', 'nis')
            ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
            ->join('mata_pelajaran as mapel', 'mapel.kelas_id', '=', 'kelas.id')
            ->where('mapel.hari', '=', $date)
            ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
            ->orderBy('mapel.jam_mulai', 'ASC')
            ->distinct('mapel.id')
            ->get(['mapel.*']);

        return $item;
    }

    public function kelas_siswa()
    {
        return $this->hasMany(KelasSiswa::class, 'nis', 'nis');
    }
}
