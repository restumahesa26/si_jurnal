<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $mapel = MataPelajaran::join('kelas AS kelas', 'kelas.id', '=', 'mata_pelajaran.kelas_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get(['mata_pelajaran.*']);

        return view('pages.admin.jurnal.index', [
            'mapel' => $mapel
        ]);
    }

    public function show(Request $request)
    {
        $item = Jurnal::where('mapel_id', $request->mapel_id)->where('pertemuan', $request->pertemuan)->first();

        if ($item) {
            return view('pages.admin.jurnal.show', compact('item'));
        }else {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $item = Jurnal::findOrFail($id);

        $rules = [
            'pokok_bahasan' => 'required|string',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
        ];

        $this->validate($request, $rules, $customMessages);

        $item->update([
            'pokok_bahasan' => $request->pokok_bahasan,
        ]);

        return redirect()->route('admin-jurnal.index')->with('success', 'Berhasil Mengubah Jurnal');
    }

    public function delete($id)
    {
        $item = Jurnal::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-jurnal.index')->with('success', 'Berhasil Menghapus Jurnal');
    }
}
