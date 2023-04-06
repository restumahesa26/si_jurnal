<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterMataPelajaran;
use Illuminate\Http\Request;

class MasterMataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = MasterMataPelajaran::withCount('mapel')->orderBy('nama_mata_pelajaran', 'ASC')->get();

        return view('pages.admin.data-master.mata-pelajaran.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.data-master.mata-pelajaran.create');
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
            'nama_mata_pelajaran' => 'required|string|max:50',
            'jenis_mata_pelajaran' => 'required|in:Wajib,Peminatan',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'unique' => 'Inputan tersebut sudah digunakan'
        ];

        $this->validate($request, $rules, $customMessages);

        $check = MasterMataPelajaran::where('nama_mata_pelajaran', $request->nama_mata_pelajaran)->where('jenis_mata_pelajaran', $request->jenis_mata_pelajaran)->first();

        if (!$check) {
            MasterMataPelajaran::create([
                'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
                'jenis_mata_pelajaran' => $request->jenis_mata_pelajaran,
            ]);

            return redirect()->route('master-mapel.index')->with('success', 'Berhasil Menambah Data Master Mata Pelajaran');
        }else {
            return redirect()->back()->withInput()->with('error', 'Mata Pelajaran Sudah Tersedia');
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
        $item = MasterMataPelajaran::findOrFail($id);

        return view('pages.admin.data-master.mata-pelajaran.edit', [
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
            'nama_mata_pelajaran' => 'required|string|max:50',
            'jenis_mata_pelajaran' => 'required|in:Wajib,Peminatan',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'unique' => 'Inputan tersebut sudah digunakan'
        ];

        $this->validate($request, $rules, $customMessages);

        $item = MasterMataPelajaran::findOrFail($id);

        $check = MasterMataPelajaran::where('nama_mata_pelajaran', $request->nama_mata_pelajaran)->where('jenis_mata_pelajaran', $request->jenis_mata_pelajaran)->first();

        if ($item->nama_mata_pelajaran == $request->nama_mata_pelajaran && $item->jenis_mata_pelajaran == $request->jenis_mata_pelajaran) {
            $item->update([
                'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
                'jenis_mata_pelajaran' => $request->jenis_mata_pelajaran,
            ]);

            return redirect()->route('master-mapel.index')->with('success', 'Berhasil Mengubah Data Master Mata Pelajaran');
        }else {
            if (!$check) {
                $item->update([
                    'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
                    'jenis_mata_pelajaran' => $request->jenis_mata_pelajaran,
                ]);

                return redirect()->route('master-mapel.index')->with('success', 'Berhasil Mengubah Data Master Mata Pelajaran');
            } else {
                return redirect()->back()->withInput()->with('error', 'Mata Pelajaran Sudah Tersedia');
            }
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
        $item = MasterMataPelajaran::findOrFail($id);

        $item->delete();

        return redirect()->route('master-mapel.index')->with('success', 'Berhasil Mengubah Data Master Mata Pelajaran');
    }
}
