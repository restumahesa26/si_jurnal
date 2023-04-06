<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaliSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class WaliSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = WaliSiswa::withCount('siswa')->join('users', 'users.id', 'wali_siswa.user_id')->orderBy('users.nama', 'ASC')->get(['wali_siswa.*']);

        return view('pages.admin.wali-siswa.index', [
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
        return view('pages.admin.wali-siswa.create');

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
            'nama' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'no_handphone' => 'required|string|max:50',
            'alamat' => 'string|max:50|nullable',
            'agama' => 'string|max:50|nullable',
            'pendidikan' => 'string|max:50|nullable',
            'pekerjaan' => 'string|max:50|nullable',
            'email' => 'required|string|max:50|email|unique:users',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults() ]
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'email' => 'Field :attribute harus berupa email',
            'confirmed' => 'Password harus dikonfirmasi dengan benar',
            'unique' => 'Inputan tersebut sudah digunakan'
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => 'Wali Siswa',
            'password' => Hash::make($request->password),
        ]);

        WaliSiswa::create([
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_handphone' => $request->no_handphone,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'user_id' => $user->id,
        ]);

        return redirect()->route('wali-murid.index')->with('success', 'Berhasil Menambah Data Wali Siswa');
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
        $item = WaliSiswa::findOrFail($id);

        return view('pages.admin.wali-siswa.edit', [
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
            'no_handphone' => 'required|string|max:50',
            'alamat' => 'string|max:50|nullable',
            'agama' => 'string|max:50|nullable',
            'pendidikan' => 'string|max:50|nullable',
            'pekerjaan' => 'string|max:50|nullable',
        ];

        $rules2 = [
            'email' => 'required|string|max:50|email|unique:users',
        ];

        $rules3 = [
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults() ]
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'email' => 'Field :attribute harus berupa email',
            'confirmed' => 'Password harus dikonfirmasi dengan benar',
            'unique' => 'Inputan tersebut sudah digunakan'
        ];

        $this->validate($request, $rules, $customMessages);

        $item = WaliSiswa::findOrFail($id);

        $user = User::where('id', $item->user_id)->first();

        if ($request->email != $user->email) {
            $this->validate($request, $rules2, $customMessages);
        }
        if ($request->password) {
            $this->validate($request, $rules3, $customMessages);
        }

        $item->update([
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_handphone' => $request->no_handphone,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('wali-murid.index')->with('success', 'Berhasil Mengubah Data Wali Siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = WaliSiswa::findOrFail($id);

        $user = User::where('id', $item->user_id)->first();

        $item->delete();

        $user->delete();

        return redirect()->route('wali-murid.index')->with('success', 'Berhasil Menghapus Data Wali Siswa');
    }
}
