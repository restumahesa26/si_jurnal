<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AbsenExport;
use App\Exports\AbsenKelasExport;
use App\Exports\AbsenMataPelajaranExport;
use App\Exports\AbsenSiswaExport;
use App\Exports\JurnalGuruExport;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)->orderBy('kelas', 'ASC')->get();
        $items2 = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->get(['mata_pelajaran.*']);

        if (Auth::user()->role != 'Guru') {
            $items3 = Guru::join('users', 'users.id', 'guru.user_id')->orderBy('users.nama', 'ASC')->get();
        } else {
            $items3 = NULL;
        }

        return view('pages.admin.laporan.index', compact('items', 'items2', 'items3'));
    }

    public function index2()
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)->where('wali_kelas', Auth::user()->guru->nip)->orderBy('kelas', 'ASC')->get();
        $items2 = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('guru', Auth::user()->guru->nip)->get(['mata_pelajaran.*']);

        return view('pages.admin.laporan.index', compact('items', 'items2'));
    }

    public function index3()
    {
        $items = Siswa::where('wali_siswa_id', Auth::user()->wali_siswa->id)->get();

        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items2 = MataPelajaran::join('kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')
            ->join('kelas_siswa', 'kelas_siswa.kelas_id', '=', 'mata_pelajaran.kelas_id')
            ->join('siswa', 'siswa.nis', '=', 'kelas_siswa.nis')
            ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
            ->where('siswa.wali_siswa_id', Auth::user()->wali_siswa->id)
            ->get(['mata_pelajaran.*']);

        return view('pages.admin.laporan.index2', compact('items', 'items2'));
    }

    public function cetak_kelas(Request $request)
    {
        $id = $request->kelas;

        $item = Kelas::findOrFail($id);

        return view('pages.admin.laporan.pdf-kelas', compact('item'));
    }

    public function cetak_kelas_excel(Request $request)
    {
        return Excel::download(new AbsenKelasExport($request->kelas), 'absen-kelas.xlsx');
    }

    public function cetak_mapel(Request $request)
    {
        $id = $request->mapel;

        $item = MataPelajaran::findOrFail($id);

        return view('pages.admin.laporan.pdf-mata-pelajaran', compact('item'));
    }

    public function cetak_mapel_excel(Request $request)
    {
        return Excel::download(new AbsenMataPelajaranExport($request->mapel), 'absen-mata-pelajaran.xlsx');
    }

    public function cetak_semua()
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Siswa::join('kelas_siswa', 'kelas_siswa.nis', '=', 'siswa.nis')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->orderBy('siswa.nama', 'ASC')->get(['siswa.*']);

        return view('pages.admin.laporan.pdf-siswa', compact('items'));
    }

    public function cetak_semua_excel()
    {
        return Excel::download(new AbsenExport, 'absen.xlsx');
    }

    public function cetak_siswa(Request $request)
    {
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Absen::join('kelas_siswa', 'kelas_siswa.id', '=', 'absen.kelas_siswa_id')
            ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
            ->where('nis', $request->nis)
            ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
            ->where('absen.mapel_id', $request->mapel_id)
            ->orderBy('absen.pertemuan', 'ASC')
            ->get(['absen.*']);

        return view('pages.admin.laporan.pdf-siswa-wali-siswa', compact('items'));
    }

    public function cetak_siswa_excel(Request $request)
    {
        return Excel::download(new AbsenSiswaExport($request->nis, $request->mapel_id), 'absen-siswa.xlsx');
    }

    public function cetak_guru(Request $request)
    {
        $items = Jurnal::join('mata_pelajaran', 'mata_pelajaran.id', '=', 'mapel_id')
            ->where('mata_pelajaran.guru', $request->nip)
            ->get(['jurnal.*']);

        return view('pages.admin.laporan.pdf-jurnal-guru', compact('items'));
    }

    public function cetak_guru_excel(Request $request)
    {
        return Excel::download(new JurnalGuruExport($request->nip), 'jurnal-guru.xlsx');
    }
}
