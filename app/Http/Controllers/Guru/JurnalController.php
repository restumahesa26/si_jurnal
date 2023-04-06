<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    public function index()
    {
        $tahun = TahunAjaran::where('status', 'Aktif')->first();

        $date = Carbon::now()->translatedFormat('l');

        $items = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
            ->where('kelas.tahun_ajaran_id', $tahun->id)
            ->where('guru', Auth::user()->guru->nip)
            ->where('hari', '=', $date)
            ->orderBy('jam_mulai', 'ASC')
            ->get(['mata_pelajaran.*']);

        return view('pages.guru.jurnal.index', compact('items'));
    }

    public function store(Request $request, $id)
    {
        $rules = [
            'topik_pembelajaran' => 'required|string',
            'kegiatan_belajar' => 'required|string',
            'kendala_belajar' => 'required|string',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        Jurnal::create([
            'mapel_id' => $id,
            'tanggal' => Carbon::now(),
            'topik_pembelajaran' => $request->topik_pembelajaran,
            'kegiatan_belajar' => $request->kegiatan_belajar,
            'kendala_belajar' => $request->kendala_belajar,
        ]);

        return redirect()->route('absensi.index', $id)->with('success', 'Berhasil Mengisi Jurnal');
    }
}
