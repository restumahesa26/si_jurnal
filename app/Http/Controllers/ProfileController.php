<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        // mengambil data user yang sedang login
        $item = Auth::user();

        // kembalikan data user ke halaman profile
        return view('pages.profile', [
            'item' => $item
        ]);
    }

    public function update(Request $request)
    {
        // membuat validasi untuk nama, username, dan nip
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
        ]);

        // membuat validasi untuk email
        if ($request->email !== Auth::user()->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            ]);
        }

        $item2 = Guru::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->role == 'Guru') {
            if ($request->nip !== $item2->nip) {
                $request->validate([
                    'nip' => ['required', 'string', 'max:50', 'unique:guru'],
                ]);
            }
        }

        // membuat validasi untuk password
        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        if ($request->avatar) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg']
            ]);

            $imageName = time().'.'.$request->avatar->extension();

            $request->avatar->move(public_path('images/avatar'), $imageName);
        }

        // memanggil data user berdasarkan id user yang sedang login
        $item = User::where('id', Auth::user()->id)->first();

        // lakukan update data satu persatu
        $item->nama = $request->nama;
        $item->email = $request->email;
        if ($request->password) {
            $item->password = Hash::make($request->password);
        }
        if (Auth::user()->role == 'Guru') {
            $item2->nip = $request->nip;
            $item2->save();
        }
        if ($request->avatar) {
            $item->avatar = $imageName;
        }

        // simpan update-an
        $item->save();

        // kembalikan ke halaman profile
        return redirect()->route('profile.edit')->with('success', 'Berhasil Mengupdate Profile');
    }
}
