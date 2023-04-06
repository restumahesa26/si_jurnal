<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Siswa::join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->orderBy('siswa.nama', 'ASC')->get(['siswa.*']);

        return view('pages.admin.laporan.excel-siswa', compact('items'));
    }
}
