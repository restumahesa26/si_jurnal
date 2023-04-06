<?php

namespace App\Exports;

use App\Models\Absen;
use App\Models\TahunAjaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenSiswaExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($nis, $mapel_id)
    {
        $this->nis = $nis;
        $this->mapel_id = $mapel_id;
    }

    public function view(): View
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Absen::join('kelas_siswa', 'kelas_siswa.id', '=', 'absen.kelas_siswa_id')
            ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
            ->where('nis', $this->nis)
            ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
            ->where('absen.mapel_id', $this->mapel_id)
            ->orderBy('absen.pertemuan', 'ASC')
            ->get(['absen.*']);

        return view('pages.admin.laporan.excel-siswa-wali-siswa', compact('items'));
    }
}
