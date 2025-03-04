<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    // Tujuan: Menampilkan halaman pengaturan dengan data setting dan rekening.
    // Fungsi: Mengambil data pertama dari tabel Setting dan Rekening, lalu menampilkannya di halaman pengaturan.
    public function index()
    {
        $data = [
            'title' => 'Pengaturan',
            'setting' => Setting::first(),
            'rekening' => Rekening::first()
        ];

        return view('admin.pengaturan.index', $data);
    }

    // Tujuan: Menyimpan atau memperbarui pengaturan dan rekening.
    // Fungsi: Memvalidasi input dari user, kemudian memperbarui data Setting dan Rekening di database.
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about' => 'required',
            'harga' => 'required|numeric',
            'no_rekening' => 'required|string',
            'atas_nama' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.setting')->withErrors($validator)->withInput();
        } else {
            Setting::first()->update([
                'about' => $request->about,
                'harga' => $request->harga
            ]);

            Rekening::first()->update([
                'no_rekening' => $request->no_rekening,
                'atas_nama' => $request->atas_nama
            ]);

            return redirect()->route('admin.setting')->with('status', 'Berhasil Memperbarui Pengaturan');
        }
    }
}
