<?php

namespace App\Http\Controllers\WakaKurikulum;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $tahun = TahunAjaran::where('status', 'Aktif')->first();

        $items = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
        ->where('kelas.tahun_ajaran_id', $tahun->id)
        ->get(['mata_pelajaran.*']);

        return view('pages.waka-kurikulum.jurnal.index', compact('items'));
    }

    public function show(Request $request)
    {
        $items = Jurnal::where('mapel_id', $request->mapel_id)->orderBy('tanggal', 'ASC')->get();

        if ($items->count() < 1) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan')->withInput();
        }else {
            return view('pages.waka-kurikulum.jurnal.show', compact('items'));
        }
    }
}
