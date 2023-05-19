<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    public $table = 'jurnal';

    public $fillable = [
        'mapel_id', 'tanggal', 'pokok_bahasan', 'topik_pembelajaran', 'kegiatan_belajar', 'kendala_belajar'
    ];

    public function mataPelajaran()
    {
        return $this->hasOne(MataPelajaran::class, 'id', 'mapel_id');
    }

    public function hitungStatus($status, $mapel_id, $tanggal)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = $this
        ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'jurnal.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
        ->join('absen', 'absen.mapel_id', '=', 'jurnal.mapel_id')
        ->where('absen.mapel_id', $mapel_id)
        ->where('absen.status', $status)
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->whereDate('absen.tanggal', $tanggal)
        ->count();

        return $count;
    }

    public function persentaseKehadiran($mapel_id)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $count = $this
        ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'jurnal.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
        ->join('absen', 'absen.mapel_id', '=', 'jurnal.mapel_id')
        ->where('absen.mapel_id', $mapel_id)
        ->where('absen.status', '=', 'Hadir')
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $count2 = $this
        ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'jurnal.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
        ->join('absen', 'absen.mapel_id', '=', 'jurnal.mapel_id')
        ->where('absen.mapel_id', $mapel_id)
        ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
        ->count();

        $hasil = 0;

        if($count > 0 && $count2 > 0){
            $hasil = $count * 100 / $count2;
        }

        return number_format((float)$hasil, 2, '.', '');
    }
}
