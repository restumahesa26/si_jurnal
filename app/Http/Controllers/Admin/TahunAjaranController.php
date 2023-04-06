<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = TahunAjaran::withCount('kelas')->orderBy('tahun_ajaran', 'DESC')->orderByRaw("FIELD(semester , 'Ganjil', 'Genap') ASC")->get();

        return view('pages.admin.tahun-ajaran.index', [
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
        return view('pages.admin.tahun-ajaran.create');
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
            'tahun_ajaran' => 'required|string|max:50',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        $check = TahunAjaran::where('tahun_ajaran', $request->tahun_ajaran)->where('semester', $request->semester)->first();

        if ($request->semester == '') {
            return redirect()->back()->with('error', 'Pilih Semester Terlebih Dahulu')->withInput();
        }elseif ($request->status == '') {
            return redirect()->back()->with('error', 'Pilih Status Terlebih Dahulu')->withInput();
        }elseif ($check != NULL) {
            return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Sudah Tersedia');
        }else {
            if ($request->status == 'Aktif') {

                $check = TahunAjaran::where('status', 'Aktif')->first();

                if ($check == NULL) {

                    TahunAjaran::create([
                        'tahun_ajaran' => $request->tahun_ajaran,
                        'semester' => $request->semester,
                        'status' => $request->status,
                    ]);

                    return redirect()->route('tahun-ajaran.index')->with('success', 'Berhasil Menambah Data Tahun Ajaran');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Aktif Sudah Ada');
                }
            } else {
                TahunAjaran::create([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'semester' => $request->semester,
                    'status' => $request->status,
                ]);

                return redirect()->route('tahun-ajaran.index')->with('success', 'Berhasil Menambah Data Tahun Ajaran');
            }
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
        $item = TahunAjaran::findOrFail($id);

        return view('pages.admin.tahun-ajaran.edit', [
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
            'tahun_ajaran' => 'required|string|max:50',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        $item = TahunAjaran::findOrFail($id);

        $check = TahunAjaran::where('tahun_ajaran', $request->tahun_ajaran)->where('semester', $request->semester)->first();

        if ($request->semester == '') {
            return redirect()->back()->withInput()->with('error', 'Pilih Semester Terlebih Dahulu');
        }elseif ($request->status == '') {
            return redirect()->back()->withInput()->with('error', 'Pilih Status Terlebih Dahulu');
        }elseif ($request->tahun_ajaran == $item->tahun_ajaran && $request->semester == $item->semester) {
            if ($request->status == 'Aktif') {

                $check = TahunAjaran::where('status', 'Aktif')->first();

                if ($check == NULL || $item->status == 'Aktif') {
                    $item->update([
                        'tahun_ajaran' => $request->tahun_ajaran,
                        'semester' => $request->semester,
                        'status' => $request->status,
                    ]);

                    return redirect()->route('tahun-ajaran.index');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Aktif Sudah Ada');
                }

            } else {
                $item->update([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'jenis' => $request->jenis,
                    'status' => $request->status,
                ]);

                return redirect()->route('tahun-ajaran.index')->with('success', 'Berhasil Mengubah Data Tahun Ajaran');
            }
        }elseif ($check != NULL) {
            return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Sudah Tersedia');
        }else {
            if ($request->status == 'Aktif') {

                $check = TahunAjaran::where('status', 'Aktif')->first();

                if ($check == NULL || $item->status == 'Aktif') {
                    $item->update([
                        'tahun_ajaran' => $request->tahun_ajaran,
                        'semester' => $request->semester,
                        'status' => $request->status,
                    ]);

                    return redirect()->route('tahun-ajaran.index');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Aktif Sudah Ada');
                }

            } else {
                $item->update([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'jenis' => $request->jenis,
                    'status' => $request->status,
                ]);

                return redirect()->route('tahun-ajaran.index')->with('success', 'Berhasil Mengubah Data Tahun Ajaran');
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
        $item = TahunAjaran::findOrFail($id);

        $item->delete();

        return redirect()->route('tahun-ajaran.index')->with('success', 'Berhasil Menghapus Data Tahun Ajaran');
    }

    public function updateStatus(Request $request)
    {
        $tahunAktif = TahunAjaran::where('status', 'Aktif')->first();

        $item = TahunAjaran::findOrFail($request->id);

        $tahunAktif->status = 'Tidak Aktif';

        $item->status = 'Aktif';

        $tahunAktif->save();

        $item->save();

        return redirect()->route('tahun-ajaran.index')->with('success', 'Berhasil Mengubah Status Data Tahun Ajaran');
    }
}
