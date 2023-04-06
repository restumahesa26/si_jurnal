<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function select()
    {
        $tahun = TahunAjaran::where('status', 'Aktif')->first();

        $date = Carbon::now()->translatedFormat('l');

        $items = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
            ->where('kelas.tahun_ajaran_id', $tahun->id)
            ->where('guru', Auth::user()->guru->nip)
            ->where('hari', '=', $date)
            ->get(['mata_pelajaran.*']);

        return view('pages.guru.absensi.select', compact('items'));
    }

    public function index($id)
    {
        $item = MataPelajaran::findOrFail($id);

        return view('pages.guru.absensi.index', compact('item'));
    }

    public function store(Request $request, $mapel_id)
    {
        foreach ($request->status as $key => $value) {
            Absen::create([
                'kelas_siswa_id' => $request->kelas_siswa_id[$key],
                'status' => $value,
                'tanggal' => Carbon::now(),
                'mapel_id' => $mapel_id
            ]);
        }

        return redirect()->route('absensi.select')->with('success', 'Berhasil Mengisi Absensi');
    }
}
