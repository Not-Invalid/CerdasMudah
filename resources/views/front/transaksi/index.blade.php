@extends('layouts.front')
@section('content')

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    li {
      font-size: 15px;
    }

    /* Membatasi ukuran gambar agar tidak terpotong, tetapi diperkecil */
    #preview-container {
      width: 100%;
      max-height: 300px;
      /* Maksimal tinggi */
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ddd;
      padding: 10px;
      overflow: hidden;
    }

    #preview-container img {
      max-width: 100%;
      /* Gambar tidak melebihi container */
      max-height: 100%;
      /* Maksimal tinggi tetap dalam batas */
      height: auto;
      /* Memastikan proporsi tetap terjaga */
      width: auto;
      display: block;
    }
  </style>

  <section class="course_details_area section_padding">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5">
          <div class="section_tittle text-center">
            <h2>Upgrade Premium</h2>
          </div>
        </div>
      </div>

      <div class="row">
        @php
          $id = Auth::user()->id;
          $cek = \App\Models\Transaksi::where(['users_id' => $id]);
        @endphp

        @if ($cek->count() > 0 && $cek->first()->status == 1 && Auth::user()->role == 'premium')
          <div class="col-md-12 text-center">
            <h4>Selamat! Akun Anda sudah Premium.</h4>
          </div>
        @elseif ($cek->count() > 0 && $cek->first()->status == 0)
          <div class="col-md-12 text-center">
            <h4>Pembayaran sedang diproses, silakan tunggu konfirmasi dari admin.</h4>
          </div>
        @elseif ($cek->count() > 0 && $cek->first()->status == 2)
          <div class="col-md-7">
            <h4>Pembayaran Ditolak. Silakan unggah ulang bukti pembayaran.</h4>
            <form action="{{ route('uploadulang') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="custom-file mt-3">
                <label for="inibukti" class="custom-file-label">Upload Bukti Transfer</label>
                <input type="file" class="custom-file-input" name="bukti" id="inibukti"
                  onchange="previewFile(this)">
                @error('bukti')
                  <small class="mt-2 text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="text-left mt-3">
                <button type="submit" class="btn_1">Kirim</button>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-4">
            <h5>Preview Bukti Transfer:</h5>
            <div id="preview-container" class="border p-3 text-center">
              <p>Gambar akan muncul di sini.</p>
            </div>
          </div>
        @elseif ($cek->count() < 1)
          <div class="col-md-7">
            @php
              $setting = \App\Models\Setting::first();
            @endphp
            <h4>Silakan transfer sebesar Rp.{{ number_format($setting->harga, 2, ',', '.') }} ke rekening:</h4>
            <ul>
              @foreach ($rekening as $item)
                <li>- {{ $item->no_rekening }} a.n <b>{{ $item->atas_nama }}</b></li>
              @endforeach
            </ul>
            <form action="{{ route('uploadbukti') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="custom-file mt-3">
                <label for="inibukti" class="custom-file-label">Upload Bukti Transfer</label>
                <input type="file" class="custom-file-input" name="bukti" id="inibukti"
                  onchange="previewFile(this)">
                @error('bukti')
                  <small class="mt-2 text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="text-left mt-3">
                <button type="submit" class="btn_1">Kirim Bukti</button>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-4">
            <h4>Preview Bukti Transfer:</h4>
            <div id="preview-container" class="border p-3 text-center">
              <p>Preview Box</p>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

  <script>
    function previewFile(input) {
      var file = input.files[0];
      var reader = new FileReader();
      var previewContainer = document.getElementById("preview-container");

      reader.onloadend = function() {
        var img = document.createElement("img");
        img.src = reader.result;
        img.classList.add("mt-3");
        img.style.maxWidth = "100%";
        img.style.height = "auto"; // Menjaga rasio gambar
        img.style.display = "block";

        previewContainer.innerHTML = "";
        previewContainer.appendChild(img);
      };

      if (file) {
        reader.readAsDataURL(file);
      } else {
        previewContainer.innerHTML = "<p>Preview Box</p>";
      }
    }

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html("File Dipilih: " + fileName);
    });
  </script>

@endsection
