<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::where('role', 'Admin')->get();

        return view('pages.admin.admin.index', [
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
        return view('pages.admin.admin.create');
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

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => 'Admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('data-admin.index')->with('success', 'Berhasil Menambah Data Admin');
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
        $item = User::findOrFail($id);

        return view('pages.admin.admin.edit', [
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

        $item = User::findOrFail($id);

        if ($request->email != $item->email) {
            $this->validate($request, $rules2, $customMessages);
        }
        if ($request->password) {
            $this->validate($request, $rules3, $customMessages);
        }

        $item->nama = $request->nama;
        $item->email = $request->email;
        if ($request->password) {
            $item->password = Hash::make($request->password);
        }
        $item->save();

        return redirect()->route('data-admin.index')->with('success', 'Berhasil Mengubah Data Admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);

        $check = User::where('role', 'Admin')->count();

        if ($check > 1) {
            $item->delete();

            return redirect()->route('data-admin.index')->with('success', 'Berhasil Menghapus Data Admin');
        }else {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Admin');
        }
    }
}
