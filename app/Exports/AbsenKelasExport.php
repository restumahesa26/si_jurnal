<?php

namespace App\Exports;

use App\Models\Kelas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenKelasExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($kelas_id)
    {
        $this->kelas_id = $kelas_id;
    }

    public function view(): View
    {
        $item = Kelas::where('id', $this->kelas_id)->first();

        return view('pages.admin.laporan.excel-kelas', compact('item'));
    }
}
