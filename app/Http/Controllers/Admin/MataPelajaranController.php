<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MasterMataPelajaran;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = MataPelajaran::withCount('absen')->join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->orderByRaw("FIELD(jenjang , 'X', 'XI', 'XII') ASC")->orderBy('kelas', 'ASC')->get(['mata_pelajaran.*']);

        return view('pages.admin.mata-pelajaran.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        $items2 = Guru::all();

        return view('pages.admin.mata-pelajaran.create', [
            'items' => $items, 'items2' => $items2
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
            'guru' => 'required',
            'kelas_id' => 'required',
            'hari' => 'required',
            'nama_mata_pelajaran' => 'required|string|max:255',
            'jam_mulai' => 'required|numeric',
            'jam_akhir' => 'required|numeric',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        MataPelajaran::create([
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
            'hari' => $request->hari,
            'kelas_id' => $request->kelas_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_akhir' => $request->jam_akhir,
            'guru' => $request->guru,
        ]);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Berhasil Menambah Data Mata Pelajaran');
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
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $items = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        $items2 = Guru::all();

        $item = MataPelajaran::findOrFail($id);

        return view('pages.admin.mata-pelajaran.edit', [
            'item' => $item, 'items2' => $items, 'items3' => $items2
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
            'jam_mulai' => 'required|numeric',
            'jam_akhir' => 'required|numeric',
            'guru' => 'required',
            'nama_mata_pelajaran' => 'required|string|max:255',
            'kelas_id' => 'required',
            'hari' => 'required',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        $item = MataPelajaran::findOrFail($id);

        $item->update([
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
            'hari' => $request->hari,
            'kelas_id' => $request->kelas_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_akhir' => $request->jam_akhir,
            'guru' => $request->guru,
        ]);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Berhasil Mengubah Data Mata Pelajaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MataPelajaran::findOrFail($id);

        $item->delete();

        return redirect()->route('mata-pelajaran.index')->with('success', 'Berhasil Menghapus Data Mata Pelajaran');
    }
}
