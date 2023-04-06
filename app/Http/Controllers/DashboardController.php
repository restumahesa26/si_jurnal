<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $tahun = TahunAjaran::where('status', 'Aktif')->first();

        $mapel = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahun->id)->count();

        $tahunAjaran = $tahun->tahun_ajaran;

        if (Auth::user()->role == 'Admin') {
            $siswaSepuluh = Siswa::join('kelas_siswa', 'kelas_siswa.nis', 'siswa.nis')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahun->id)->where('kelas.jenjang', 'X')->count();
            $siswaSebelas = Siswa::join('kelas_siswa', 'kelas_siswa.nis', 'siswa.nis')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahun->id)->where('kelas.jenjang', 'XI')->count();
            $siswaDuabelas = Siswa::join('kelas_siswa', 'kelas_siswa.nis', 'siswa.nis')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahun->id)->where('kelas.jenjang', 'XII')->count();
        }else {
            $siswaSepuluh = NULL;
            $siswaSebelas = NULL;
            $siswaDuabelas = NULL;
        }

        if (Auth::user()->role == 'Guru') {
            $semuaMapel = MataPelajaran::where('guru', Auth::user()->guru->nip)->join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahun->id)->get(['mata_pelajaran.*']);
        }else {
            $semuaMapel = Kelas::where('tahun_ajaran_id', $tahun->id)->orderByRaw("FIELD(jenjang , 'X', 'XI', 'XII') ASC")->get();
        }

        return view('pages.dashboard', compact('tahun', 'semuaMapel', 'siswaSepuluh', 'siswaSebelas', 'siswaDuabelas'));
    }

    public function show_absen($id)
    {
        $tahun = TahunAjaran::where('status', 'Aktif')->first();

        if (Auth::user()->role == 'Guru') {
            $item = MataPelajaran::findOrFail($id);
        }else {
            $item = Kelas::findOrFail($id);
        }

        return view('pages.absen-dashboard', compact('item'));
    }
}
