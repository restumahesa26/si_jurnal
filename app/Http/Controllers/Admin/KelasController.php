<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $tahun = TahunAjaran::where('status', 'Tidak Aktif')->orderBy('tahun_ajaran', 'DESC')->get();

        $items = Kelas::withCount('kelas_siswa', 'mapel')->where('tahun_ajaran_id', $tahun_ajaran->id)->orderByRaw("FIELD(jenjang , 'X', 'XI', 'XII') ASC")->orderBy('kelas', 'ASC')->get();

        return view('pages.admin.kelas.index', [
            'items' => $items, 'tahuns' => $tahun
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Guru::all();

        return view('pages.admin.kelas.create', [
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'jenjang' => 'required|string|in:X,XI,XII',
            'kelas' => 'required|string|max:10',
            'wali_kelas' => 'required',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $check = Kelas::where('jenjang', $request->jenjang)->where('kelas', $request->kelas)->where('tahun_ajaran_id', $tahun_ajaran->id)->first();

        if ($check != NULL) {
            return redirect()->back()->withInput()->with('error', 'Kelas Sudah Tersedia');
        } else {
            Kelas::create([
                'jenjang' => $request->jenjang,
                'kelas' => $request->kelas,
                'wali_kelas' => $request->wali_kelas,
                'tahun_ajaran_id' => $tahun_ajaran->id,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Berhasil Menambah Data Kelas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Kelas::findOrFail($id);
        $items = Guru::all();

        return view('pages.admin.kelas.edit', [
            'item' => $item, 'items' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'jenjang' => 'required|string|in:X,XI,XII',
            'kelas' => 'required|string|max:10',
            'wali_kelas' => 'required',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $item = Kelas::findOrFail($id);

        $check = Kelas::where('jenjang', $request->jenjang)->where('kelas', $request->kelas)->where('tahun_ajaran_id', $tahun_ajaran->id)->first();

        if ($request->jenjang == $item->jenjang && $request->kelas == $item->kelas) {
            $item->update([
                'jenjang' => $request->jenjang,
                'kelas' => $request->kelas,
                'wali_kelas' => $request->wali_kelas,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Berhasil Menambah Data Kelas');
        } elseif($check != NULL) {
            return redirect()->back()->withInput()->with('error', 'Kelas Sudah Tersedia');
        } else {
            $item->update([
                'jenjang' => $request->jenjang,
                'kelas' => $request->kelas,
                'wali_kelas' => $request->wali_kelas,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Berhasil Menambah Data Kelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kelas::findOrFail($id);

        $item->delete();

        return redirect()->route('kelas.index')->with('success', 'Berhasil Menghapus Data Kelas');
    }

    public function export_kelas(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $tahun = TahunAjaran::where('id', $request->id)->first();

        if ($tahun->semester == 'Genap') {
            $kelas = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        } else {
            $kelas = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->where('jenjang', '!=', 'XII')->get();
        }

        $check = Kelas::where('tahun_ajaran_id', $request->id)->first();

        if ($check == NULL) {
            if ($tahun->semester == 'Ganjil') {
                foreach ($kelas as $key => $value) {
                    $item = new Kelas();
                    $item->tahun_ajaran_id = $request->id;
                    $item->kelas = $value->kelas;
                    if ($value->jenjang == 'X') {
                        $item->jenjang = 'XI';
                    }elseif ($value->jenjang == 'XI') {
                        $item->jenjang = 'XII';
                    }
                    $item->wali_kelas = $value->wali_kelas;
                    $item->save();

                    $siswa = KelasSiswa::where('kelas_id', $value->id)->get();

                    foreach ($siswa as $key2 => $value2) {
                        $item2 = new KelasSiswa();
                        $item2->kelas_id = $item->id;
                        $item2->nis = $value2->nis;
                        $item2->save();
                    }
                }
            } else {
                foreach ($kelas as $key => $value) {
                    $item = new Kelas();
                    $item->tahun_ajaran_id = $request->id;
                    $item->kelas = $value->kelas;
                    $item->jenjang = $value->jenjang;
                    $item->wali_kelas = $value->wali_kelas;
                    $item->save();

                    $siswa = KelasSiswa::where('kelas_id', $value->id)->get();

                    foreach ($siswa as $key2 => $value2) {
                        $item2 = new KelasSiswa();
                        $item2->kelas_id = $item->id;
                        $item2->nis = $value2->nis;
                        $item2->save();
                    }
                }
            }
        }else {
            return redirect()->back()->with('error', 'Kelas Sudah Tersedia');
        }

        return redirect()->route('kelas.index')->with('success', 'Berhasil Export Data Kelas');
    }
}
