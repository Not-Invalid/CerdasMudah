<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransaksiController extends Controller
{
    // Tujuan: Menampilkan semua transaksi yang ada di sistem.
    // Fungsi: Mengambil semua data transaksi dan menampilkannya di halaman admin.
    public function index()
    {
        $data = [
            'title' => 'Semua Transaksi',
            'transaksis' => Transaksi::all(),
        ];
        return view('admin.transaksi.index', $data);
    }

    // Tujuan: Menampilkan transaksi yang belum dicek oleh admin (status 0).
    // Fungsi: Mengambil transaksi dengan status "belum dicek" (status 0) dan menampilkannya di halaman admin.
    public function belumdicek()
    {
        $data = [
            'title' => 'Transaksi Belum Dicek ',
            'transaksis' => Transaksi::where(['status' => 0])->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    // Tujuan: Menampilkan transaksi yang telah disetujui (status 1).
    // Fungsi: Mengambil transaksi dengan status "disetujui" (status 1) dan menampilkannya di halaman admin.
    public function disetujui()
    {
        $data = [
            'title' => 'Transaksi Disetujui',
            'transaksis' => Transaksi::where(['status' => 1])->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    // Tujuan: Menampilkan transaksi yang ditolak (status 2).
    // Fungsi: Mengambil transaksi dengan status "ditolak" (status 2) dan menampilkannya di halaman admin.
    public function ditolak()
    {
        $data = [
            'title' => 'Transaksi Ditolak',
            'transaksis' => Transaksi::where(['status' => 2])->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    // Tujuan: Menampilkan detail transaksi berdasarkan ID yang didekripsi.
    // Fungsi: Mendekripsi ID yang diterima, mencari transaksi berdasarkan ID tersebut, dan menampilkannya di halaman detail.
    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Transaksi',
            'transaksi' => Transaksi::find($dec_id)
        ];
        return view('admin.transaksi.detail', $data);
    }

    // Tujuan: Mengubah status transaksi (menyetujui atau menolak transaksi) dan memperbarui role pengguna.
    // Fungsi: Mengupdate status transaksi dan role pengguna (premium jika disetujui, regular jika ditolak), kemudian menyimpan perubahan.
    public function ubah(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $transaksi = Transaksi::find($dec_id);

        if($request->status == 1){
            $transaksi->status = 1;
            User::where('id','=',$transaksi->users_id)->update(['role' => 'premium']);
        }else{
            $transaksi->status = 2;
            User::where('id','=',$transaksi->users_id)->update(['role' => 'regular']);
        }

        $transaksi->save();
        return redirect()->route('admin.transaksi.detail',$id)->with('status','Berhasil Memperbaharui Status');
    }
}
