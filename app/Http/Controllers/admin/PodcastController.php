<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PodcastController extends Controller
{
    // Tujuan: Menampilkan daftar semua podcast.
    // Fungsi: Mengambil semua data podcast dan menampilkannya di halaman admin.
    public function index()
    {
        $data = [
            'podcasts' => Podcast::all(),
            'title' => 'Data Podcast'
        ];

        return view('admin.podcast.index', $data);
    }

    // Tujuan: Menampilkan halaman untuk menambahkan podcast baru.
    // Fungsi: Menampilkan form untuk menambahkan podcast baru di halaman admin.
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Podcast'
        ];

        return view('admin.podcast.tambah', $data);
    }

    // Tujuan: Menyimpan podcast baru ke dalam database.
    // Fungsi: Memvalidasi data podcast yang dimasukkan dan menyimpannya ke dalam database.
    public function simpan(Request $request)
    {
        $validator = Validator($request->all(), [
            'name_podcast' => 'required',
            'url_podcast' => 'required',
            'description_podcast' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.podcast.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'name_podcast' => $request->name_podcast,
                'url_podcast' => $request->url_podcast,
                'description_podcast' => $request->description_podcast,
            ];
            Podcast::insert($obj);
            return redirect()->route('admin.podcast')->with('status', 'Berhasil Menambah Podcast');
        }
    }

    // Tujuan: Menampilkan detail dari podcast tertentu.
    // Fungsi: Mengambil data podcast berdasarkan ID yang didekripsi dan menampilkannya di halaman detail.
    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'podcast' => Podcast::find($dec_id),
            'title' => 'Detail Podcast'
        ];

        return view('admin.podcast.detail', $data);
    }

    // Tujuan: Menghapus podcast tertentu.
    // Fungsi: Menghapus podcast dari database berdasarkan ID yang didekripsi.
    public function hapus($id)
    {
        $dec_id = Crypt::decrypt($id);
        Podcast::where('id','=',$dec_id)->delete();
        return redirect()->route('admin.podcast')->with('status', 'Berhasil Menghapus Podcast');
    }

    // Tujuan: Menampilkan halaman untuk mengedit podcast.
    // Fungsi: Menampilkan halaman edit podcast berdasarkan ID podcast yang didekripsi.
    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'podcast' => Podcast::find($dec_id),
            'title' => 'Edit Podcast',
            'id' => $id
        ];

        return view('admin.podcast.edit', $data);
    }

    // Tujuan: Memperbarui data podcast yang sudah ada.
    // Fungsi: Memvalidasi dan memperbarui data podcast di database berdasarkan ID podcast yang didekripsi.
    public function update(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator($request->all(), [
            'name_podcast' => 'required',
            'url_podcast' => 'required',
            'description_podcast' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.podcast.edit', $id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'name_podcast' => $request->name_podcast,
                'url_podcast' => $request->url_podcast,
                'description_podcast' => $request->description_podcast,
            ];
            Podcast::where('id', '=', $dec_id)->update($obj);
            return redirect()->route('admin.podcast')->with('status', 'Berhasil Memperbarui Podcast');
        }
    }
}
