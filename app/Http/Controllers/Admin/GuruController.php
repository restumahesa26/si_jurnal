<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Guru::withCount('kelas', 'mapel')->join('users', 'users.id', 'guru.user_id')->orderBy('users.nama', 'ASC')->get(['guru.*']);

        return view('pages.admin.guru.index', [
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
        return view('pages.admin.guru.create');
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
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'pangkat' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:50',
            'nip' => 'required|string|max:18|unique:guru',
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
            'nip' => $request->nip,
            'email' => $request->email,
            'role' => 'Guru',
            'password' => Hash::make($request->password),
        ]);

        Guru::create([
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
            'user_id' => $user->id
        ]);

        return redirect()->route('guru.index')->with('success', 'Berhasil Menambah Data Guru');
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
        $item = Guru::findOrFail($id);

        return view('pages.admin.guru.edit', [
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
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'pangkat' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:50',
        ];

        $rules2 = [
            'email' => 'required|string|max:50|email|unique:users',
        ];

        $rules3 = [
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults() ]
        ];

        $rules4 = [
            'nip' => 'required|string|max:18|unique:guru',
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

        $item = Guru::findOrFail($id);

        $user = User::where('id', $item->user_id)->first();

        if ($request->email != $user->email) {
            $this->validate($request, $rules2, $customMessages);
        }
        if ($request->password) {
            $this->validate($request, $rules3, $customMessages);
        }
        if ($request->nip != $item->nip) {
            $this->validate($request, $rules4, $customMessages);
        }

        $item->update([
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('guru.index')->with('success', 'Berhasil Mengubah Data Guru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Guru::findOrFail($id);

        $user = User::where('id', $item->user_id)->first();

        $item->delete();

        $user->delete();

        return redirect()->route('guru.index')->with('success', 'Berhasil Menghapus Data Guru');
    }
}
