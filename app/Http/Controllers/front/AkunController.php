<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    // Tujuan: Menampilkan halaman akun pengguna.
    // Fungsi: Menampilkan halaman profil akun pengguna.
    public function index()
    {
        return view('front.akun.index');
    }

    // Tujuan: Menampilkan halaman untuk mengedit profil pengguna.
    // Fungsi: Menampilkan form untuk mengedit nama dan email pengguna.
    public function editprofil()
    {
        return view('front.akun.editprofil');
    }

    // Tujuan: Menyimpan perubahan pada profil pengguna.
    // Fungsi: Memvalidasi dan memperbarui nama dan email pengguna yang sedang login.
    public function simpaneditprofil(Request $request)
    {
        if ($request->email == Auth::user()->email) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|unique:users|email'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('akun.editprofil')->withErrors($validator)->withInput();
        } else {
            User::where('id', '=', Auth::user()->id)->update([
                'email' => $request->email,
                'name' => $request->name
            ]);
            return redirect()->route('akun')->with('status', 'Berhasil memperbarui profil');
        }
    }

    // Tujuan: Menampilkan halaman untuk mengedit kata sandi pengguna.
    // Fungsi: Menampilkan form untuk mengubah kata sandi pengguna.
    public function editkatasandi()
    {
        return view('front.akun.editkatasandi');
    }

    // Tujuan: Menyimpan perubahan kata sandi pengguna.
    // Fungsi: Memvalidasi dan memperbarui kata sandi pengguna yang sedang login.
    public function simpaneditkatasandi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('akun.editkatasandi')->withErrors($validator)->withInput();
        } else {
            User::where('id', '=', Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('akun')->with('status', 'Berhasil memperbarui katasandi');
        }
    }
}
