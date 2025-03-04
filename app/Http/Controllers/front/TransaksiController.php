<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    // Tujuan: Menampilkan halaman transaksi dengan informasi rekening.
    // Fungsi: Mengambil semua data rekening dan menampilkannya pada halaman transaksi.
    public function index()
    {
        $data = [
            'rekening' => Rekening::all()
        ];
        return view('front.transaksi.index', $data);
    }

    // Tujuan: Mengunggah bukti transfer untuk transaksi baru.
    // Fungsi: Memvalidasi file bukti transfer yang diunggah dan menyimpannya di database.
    public function uploadbukti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bukti' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect('upgradepremium')->withErrors($validator)->withInput();
        } else {

            $file = $request->file('bukti')->store('buktitf', 'public');
            $obj = [
                'users_id' => Auth::user()->id,
                'status' => '0',
                'bukti_transfer' => $file
            ];

            Transaksi::create($obj);
            return redirect('upgradepremium')->with('status', 'Berhasil Mengirim Bukti Transfer');
        }
    }

    // Tujuan: Mengunggah ulang bukti transfer untuk transaksi yang sudah ada.
    // Fungsi: Memvalidasi file bukti transfer yang diunggah dan memperbarui data transaksi.
    public function uploadulang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bukti' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect('upgradepremium')->withErrors($validator)->withInput();
        } else {

            $file = $request->file('bukti')->store('buktitf', 'public');
            $obj = [
                'users_id' => Auth::user()->id,
                'status' => '0',
                'bukti_transfer' => $file
            ];

            Transaksi::where('id', '=', Auth::user()->id)->update($obj);
            return redirect('upgradepremium')->with('status', 'Berhasil Mengirim Ulang Transfer');
        }
    }
}
