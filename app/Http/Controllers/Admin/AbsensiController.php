<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        if (Auth::user()->role == 'Admin') {
            $mapel = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get(['mata_pelajaran.*']);
        } else {
            $mapel = MataPelajaran::where('guru', Auth::user()->guru->nip)->get();
        }

        return view('pages.admin.absensi.index', [
            'mapel' => $mapel
        ]);
    }

    public function show(Request $request)
    {
        $items = Absen::where('mapel_id', $request->mapel_id)->whereDate('tanggal', $request->tanggal)->get();

        if ($items->count() > 0) {
            return view('pages.admin.absensi.show', compact('items'));
        }else {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan')->withInput();
        }
    }

    public function update(Request $request)
    {
        $status = array();

        foreach ($request->status as $value) {
            $status[] = $value;
        }

        foreach ($request->id as $key => $value) {
            $item = Absen::where('id', $value)->whereDate('tanggal', $request->tanggal)->first();
            $item->status = $status[$key];
            $item->save();
        }

        return redirect()->route('admin-absensi.index')->with('success', 'Berhasil Mengubah Daftar Hadir');
    }

    public function delete(Request $request)
    {
        foreach ($request->id as $value) {
            $item = Absen::where('id', $value)->where('pertemuan', $request->pertemuan)->first();
            $item->delete();
        }

        return redirect()->route('admin-absensi.index');
    }
}
