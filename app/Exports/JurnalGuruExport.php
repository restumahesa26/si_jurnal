<?php

namespace App\Exports;

use App\Models\Jurnal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JurnalGuruExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($nip)
    {
        $this->nip = $nip;
    }

    public function view(): View
    {
        $items = Jurnal::join('mata_pelajaran', 'mata_pelajaran.id', '=', 'mapel_id')
            ->where('mata_pelajaran.guru', $this->nip)
            ->get(['jurnal.*']);

        return view('pages.admin.laporan.excel-jurnal-guru', compact('items'));
    }
}
