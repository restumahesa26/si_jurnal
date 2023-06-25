<?php

namespace App\Helpers;

use App\Models\Absen;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Carbon\Carbon;

class Helper
{
    public static function checkAbsen($nip)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();
        $items = Absen::join('mata_pelajaran', 'mata_pelajaran.id', 'absen.mapel_id')->where('mata_pelajaran.guru', $nip)->whereDate('absen.tanggal', Carbon::now())->join('kelas_siswa', 'kelas_siswa.id', 'absen.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('mata_pelajaran.hari', Carbon::parse(Carbon::now())->translatedFormat('l'))->count();
        $mapel = MataPelajaran::join('kelas', 'kelas.id', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('guru', $nip)->where('hari', Carbon::parse(Carbon::now())->translatedFormat('l'))->count();

        if ($items < $mapel) {
            return true;
        } else {
            return false;
        }

    }
}
