<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class KelasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->nis as $value) {
            $check = KelasSiswa::where('nis', $value)->where('kelas_id', $request->kelas_id)->first();

            $tahunAjaran = TahunAjaran::where('status', 'Aktif')->first();

            $check2 = KelasSiswa::join('kelas AS kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
                ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
                ->where('nis', $value)
                ->first();

            if ($check != NULL || $check2 != NULL) {
                return redirect()->back()->withInput()->with('error', 'Siswa Sudah Dimasukkan ke Kelas');
            } else {
                KelasSiswa::create([
                    'nis' => $value,
                    'kelas_id' => $request->kelas_id
                ]);
            }
        }

        return redirect()->route('kelas-siswa.show', $request->kelas_id)->with('success', 'Berhasil Menambah Siswa ke Kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Kelas::findOrFail($id);
        $items = KelasSiswa::where('kelas_id', $id)->get();

        $siswa = Siswa::all();

        return view('pages.admin.kelas.show', [
            'item' => $item, 'items' => $items, 'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = KelasSiswa::findOrFail($id);

        $kelas_id = $item->kelas_id;

        $item->delete();

        return redirect()->route('kelas-siswa.show', $kelas_id)->with('success', 'Berhasil Menghapus Siswa dari Kelas');
    }
}
