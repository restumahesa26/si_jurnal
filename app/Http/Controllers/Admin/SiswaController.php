<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\WaliSiswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Siswa::withCount('kelas_siswa')->orderBy('nama', 'ASC')->get();

        return view('pages.admin.siswa.index', [
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

        return view('pages.admin.siswa.create');
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
            'nis' => 'required|string|max:10|unique:siswa',
            'nama' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'unique' => 'Inputan tersebut sudah digunakan'
        ];

        $this->validate($request, $rules, $customMessages);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Berhasil Menambah Data Siswa');
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
        $item = Siswa::findOrFail($id);

        return view('pages.admin.siswa.edit', [
            'item' => $item
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
            'nama' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',

        ];

        $rules2 = [
            'nis' => 'required|string|max:10|unique:siswa',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'unique' => 'Inputan tersebut sudah digunakan'
        ];

        $this->validate($request, $rules, $customMessages);


        $item = Siswa::findOrFail($id);

        if ($request->nis != $item->nis) {
            $this->validate($request, $rules2, $customMessages);
        }

        $item->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);
        return redirect()->route('siswa.index')->with('success', 'Berhasil Mengubah Data Siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Siswa::findOrFail($id);

        $item->delete();

        return redirect()->route('siswa.index')->with('success', 'Berhasil Menghapus Data Siswa');
    }
}
