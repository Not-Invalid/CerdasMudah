<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    // Tujuan: Menampilkan daftar kelas dengan paginasi.
    // Fungsi: Mengambil data kelas dan menampilkannya di halaman kelas.
    public function index()
    {
        $data = [
            'kelas' => Kelas::paginate(9)
        ];

        return view('front.kelas.index', $data);
    }

    // Tujuan: Menampilkan detail kelas berdasarkan ID.
    // Fungsi: Mengambil data kelas berdasarkan ID yang didekripsi dan menampilkannya.
    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'kelas' => Kelas::find($dec_id)
        ];

        return view('front.kelas.detail', $data);
    }

    // Tujuan: Menampilkan video materi belajar berdasarkan kelas dan video yang dipilih.
    // Fungsi: Mengambil data kelas dan video berdasarkan ID yang didekripsi dan menampilkannya.
    public function belajar($id, $idvideo)
    {
        $dec_id = Crypt::decrypt($id);
        $dec_idvideo = Crypt::decrypt($idvideo);
        $data = [
            'kelas' => Kelas::find($dec_id),
            'video' => Video::find($dec_idvideo)
        ];

        return view('front.kelas.belajar', $data);
    }
}
