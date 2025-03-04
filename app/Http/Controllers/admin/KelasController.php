<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    // Tujuan: Menampilkan daftar semua kelas.
    // Fungsi: Mengambil semua data kelas dan menampilkannya di halaman admin.
    public function index()
    {
        $data = [
            'title' => 'Data Master Kelas',
            'kelas' => Kelas::all()
        ];

        return view('admin.kelas.index', $data);
    }

    // Tujuan: Menampilkan halaman untuk menambahkan kelas baru.
    // Fungsi: Menampilkan form untuk menambahkan kelas baru di halaman admin.
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Kelas',
        ];
        return view('admin.kelas.tambah', $data);
    }

    // Tujuan: Menyimpan kelas baru ke dalam database.
    // Fungsi: Memvalidasi data kelas yang dimasukkan, menyimpan thumbnail kelas, dan memasukkan data kelas ke dalam database.
    public function simpan(Request $request)
    {
        $validator = Validator($request->all(), [
            'name_kelas' => 'required',
            'type_kelas' => 'required',
            'description_kelas' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kelas.tambah')->withErrors($validator)->withInput();
        } else {
            $file = $request->file('thumbnail')->store('thumbnail_kelas', 'public');
            $obj = [
                'name_kelas' => $request->name_kelas,
                'type_kelas' => Crypt::decrypt($request->type_kelas),
                'description_kelas' => $request->description_kelas,
                'thumbnail' => $file,
            ];
            Kelas::insert($obj);
            return redirect()->route('admin.kelas')->with('status', 'Berhasil Menambah Kelas Baru');
        }
    }

    // Tujuan: Menampilkan detail dari kelas tertentu.
    // Fungsi: Mengambil data kelas berdasarkan ID yang didekripsi dan menampilkannya di halaman detail.
    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Kelas',
            'kelas' => Kelas::find($dec_id)
        ];
        return view('admin.kelas.detail', $data);
    }

    // Tujuan: Menghapus kelas tertentu dan video terkait.
    // Fungsi: Menghapus kelas dari database, menghapus thumbnail kelas, serta menghapus video yang terkait dengan kelas tersebut.
    public function hapus($id)
    {
        $dec_id = Crypt::decrypt($id);
        $kelas = Kelas::find($dec_id);
        Storage::delete('public/'.$kelas->thumbnail);
        Video::where('kelas_id', '=', $dec_id)->delete();
        $kelas->delete();
        return redirect()->route('admin.kelas')->with('status', 'Berhasil Menghapus Kelas');
    }

    // Tujuan: Menampilkan halaman untuk mengedit kelas.
    // Fungsi: Menampilkan halaman edit kelas berdasarkan ID kelas yang didekripsi.
    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => Kelas::find($dec_id)
        ];
        return view('admin.kelas.edit', $data);
    }

    // Tujuan: Memperbarui data kelas yang sudah ada.
    // Fungsi: Memvalidasi dan memperbarui data kelas di database, termasuk thumbnail jika ada perubahan.
    public function update(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator($request->all(), [
            'name_kelas' => 'required',
            'type_kelas' => 'required',
            'description_kelas' => 'required',
            'thumbnail' => 'mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kelas.edit', $id)->withErrors($validator)->withInput();
        } else {
            $kelas = Kelas::find($dec_id);
            if ($request->file('thumbnail')) {
                Storage::delete('public/'.'public/'.$kelas->thumbnail);
                $file = $request->file('thumbnail')->store('thumbnail_kelas', 'public');
                $kelas->name_kelas = $request->name_kelas;
                $kelas->type_kelas = Crypt::decrypt($request->type_kelas);
                $kelas->description_kelas = $request->description_kelas;
                $kelas->thumbnail = $file;
            } else {
                $kelas->name_kelas = $request->name_kelas;
                $kelas->type_kelas = Crypt::decrypt($request->type_kelas);
                $kelas->description_kelas = $request->description_kelas;
            }
            $kelas->save();
            return redirect()->route('admin.kelas.detail',$id)->with('status', 'Berhasil Memperbarui Kelas');
        }
    }

    // Tujuan: Menampilkan halaman untuk menambahkan video materi ke dalam kelas.
    // Fungsi: Menampilkan halaman untuk menambah video materi ke kelas yang sudah ada.
    public function tambahvideo($id)
    {
        $data = [
            'title' => 'Tambah Video Materi',
            'id' => $id
        ];

        return view('admin.kelas.tambahvideo',$data);
    }

    // Tujuan: Menyimpan video materi baru ke dalam kelas.
    // Fungsi: Memvalidasi dan menyimpan video materi yang ditambahkan ke dalam kelas yang sesuai.
    public function simpanvideo(Request $request,$id)
    {
        $validator = Validator($request->all(), [
            'name_video' => 'required',
            'url_video' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kelas.tambahvideo',$id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'name_video' => $request->name_video,
                'kelas_id' => Crypt::decrypt($id),
                'url_video' => $request->url_video,
            ];
            Video::insert($obj);
            return redirect()->route('admin.kelas.detail',$id)->with('status', 'Berhasil Menambah Materi Video');
        }
    }

    // Tujuan: Menghapus video materi dari kelas.
    // Fungsi: Menghapus video materi berdasarkan ID dan mengarahkannya kembali ke detail kelas.
    public function hapusvideo($id,$idkelas)
    {
        $dec_id = Crypt::decrypt($id);
        Video::where('id','=',$dec_id)->delete();
        return redirect()->route('admin.kelas.detail',$idkelas)->with('status', 'Berhasil Menghapus Video Materi');
    }
}
