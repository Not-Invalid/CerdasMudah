<?php

namespace App\Http\Controllers\admin;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Tujuan: Menampilkan daftar semua blog.
    // Fungsi: Mengambil semua data blog dan menampilkannya di halaman admin.
    public function index()
    {
        $data = [
            'blogs' => Blog::all(),
            'title' => 'Data Blog'
        ];

        return view('admin.blog.index', $data);
    }

    // Tujuan: Menampilkan detail blog berdasarkan ID.
    // Fungsi: Mengambil data blog berdasarkan ID yang didekripsi dan menampilkannya di halaman detail.
    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'blog' => Blog::find($dec_id),
            'title' => 'Detail Blog'
        ];

        return view('admin.blog.detail', $data);
    }

    // Tujuan: Menampilkan halaman untuk menambahkan blog baru.
    // Fungsi: Menampilkan form untuk menambahkan blog baru di halaman admin.
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Blog',
        ];
        return view('admin.blog.tambah', $data);
    }

    // Tujuan: Menyimpan blog baru ke dalam database.
    // Fungsi: Memvalidasi data blog yang dimasukkan dan menyimpannya ke dalam database.
    public function simpan(Request $request)
    {

        $validator = Validator($request->all(), [
            'name_blog' => 'required',
            'content_blog' => 'required',
            'thumbnail_blog' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blog.tambah')->withErrors($validator)->withInput();
        } else {
            $file = $request->file('thumbnail_blog')->store('thumbnail_blog', 'public');
            $obj = [
                'name_blog' => $request->name_blog,
                'content_blog' => $request->content_blog,
                'thumbnail_blog' => $file,
            ];
            Blog::create($obj);
            return redirect()->route('admin.blog')->with('status', 'Berhasil Menambah Blog Baru');
        }
    }

    // Tujuan: Menghapus blog berdasarkan ID.
    // Fungsi: Menghapus blog dari database dan menghapus file thumbnail terkait dari penyimpanan.
    public function hapus($id)
    {

        $dec_id = Crypt::decrypt($id);
        $blog = Blog::find($dec_id);
        Storage::delete('public/' . $blog->thumbnail_blog);
        Blog::where('id', '=', $dec_id)->delete();
        return redirect()->route('admin.blog')->with('status', 'Berhasil Menghapus Blog');
    }

    // Tujuan: Menampilkan halaman untuk mengedit blog berdasarkan ID.
    // Fungsi: Menampilkan form untuk mengedit data blog berdasarkan ID yang didekripsi.
    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'blog' => Blog::find($dec_id),
            'title' => 'Edit Blog'
        ];

        return view('admin.blog.edit', $data);
    }

    // Tujuan: Memperbarui data blog berdasarkan ID.
    // Fungsi: Memvalidasi dan memperbarui data blog di database berdasarkan ID yang didekripsi.
    public function update(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator($request->all(), [
            'name_blog' => 'required',
            'content_blog' => 'required',
            'thumbnail_blog' => 'mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blog.tambah')->withErrors($validator)->withInput();
        } else {

            if ($request->file('thumbnail_blog')) {
                $blog = Blog::find($dec_id);
                Storage::delete('public/' . $blog->thumbnail_blog);
                $file = $request->file('thumbnail_blog')->store('thumbnail_blog', 'public');

                $obj = [
                    'name_blog' => $request->name_blog,
                    'content_blog' => $request->content_blog,
                    'thumbnail_blog' => $file,
                ];
            } else {
                $obj = [
                    'name_blog' => $request->name_blog,
                    'content_blog' => $request->content_blog,
                ];
            }

            Blog::where('id', '=', $dec_id)->update($obj);
            return redirect()->route('admin.blog.detail', $id)->with('status', 'Berhasil Memperbarui');
        }
    }
}
