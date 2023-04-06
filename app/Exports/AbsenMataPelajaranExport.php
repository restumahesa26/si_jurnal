<?php

namespace App\Exports;

use App\Models\MataPelajaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenMataPelajaranExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($mapel_id)
    {
        $this->mapel_id = $mapel_id;
    }

    public function view(): View
    {
        $item = MataPelajaran::where('id', $this->mapel_id)->first();

        return view('pages.admin.laporan.excel-mata-pelajaran', compact('item'));
    }
}
