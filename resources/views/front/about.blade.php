@extends('layouts.front')
@section('content')
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>About CerdasMudah</h2>
              <p>Aplikasi ini dibuat oleh para siswa dan siswi SMKN 4 Kota Tangerang dikala sedang mempersiapkan
                ulangan-ulangan akhir semester.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <style>
    li {
      margin-top: 30px;
    }

    .judultim {
      text-align: center;
      margin-top: 10px;
    }

    .garisbejir {
      border-bottom: 2.5px solid #0c2e60;
      padding-top: 10px;
      width: 300px;
      text-align: center;
      margin: auto;
    }

    .teammuter {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      margin-top: 30px;
    }

    .isiTeam {
      flex: 1 1 300px;
      max-width: 250px;
    }

    .card {
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .isiTeam .card:hover {
      transition: transform 0.5s ease-in-out;
      transform: scale(1.08);
      border: 1px solid #415094;
    }

    .card-body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
    }

    .card-body img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto;
      margin-bottom: 10px;
    }
  </style>
  <!-- feature_part start-->
  <section class="feature_part">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-xl-3 align-self-center">
          <div class="single_feature_text ">
            <h2>Jenis <br> Kelas</h2>
            <p>Berikut adalah jenis kelas yang bisa anda akses </p>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature">
            <div class="single_feature_part">
              <span class="single_feature_icon"><i class="ti-layers"></i></span>
              <h4>Gratis</h4>
              <p>Kelas Gratis ini bisa diakses oleh semua orang yang mengunjungi web ini</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature">
            <div class="single_feature_part">
              <span class="single_feature_icon"><i class="ti-new-window"></i></span>
              <h4>Regular</h4>
              <p>Kelas Regular hanya bisa diakses dengan cara membuat akun </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature">
            <div class="single_feature_part single_feature_part_2">
              <span class="single_service_icon style_icon"><i class="ti-light-bulb"></i></span>
              <h4>Premium</h4>
              <p>Kelas Premium hanya bisa diakses dengan cara membuat akun dan mengupgrade akun ke akun
                premium</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- upcoming_event part start-->
  <div class="garisbejir"></div>
  <div class="judultim">
    <h3>Our Team</h3>
  </div>
  <!-- learning part start-->
  <div class="teammuter">
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/mekafoto.png') }}">
          <h5>Epriya Mecca Siti Alikhah</h5>
          <p>Project Manager</p>
        </div>
      </div>
    </div>
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/raplifoto.png') }}">
          <h5>Raffli Firmansyah</h5>
          <p>Asst. Manager / Main Developer</p>
        </div>
      </div>
    </div>
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/cipofoto.png') }}">
          <h5>Chivo Hifdz Addien Kurniawan</h5>
          <p>Marketing / Developer Helper</p>
        </div>
      </div>
    </div>
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/arfanfoto.png') }}">
          <h5>Akhmad Arifani Bahru</h5>
          <p>UI/UX Designer</p>
        </div>
      </div>
    </div>
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/bentangfoto.png') }}">
          <h5>Bentang Antar Rusenno</h5>
          <p>Marketing</p>
        </div>
      </div>
    </div>
  </div>



  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/micro-slider@1.0.9/dist/micro-slider.min.js"></script> --}}
  <script></script>
  <!-- learning part end-->
@endsection

{{-- <div class="col-md-5 col-lg-5">
<div class="learning_member_text">
<h5>Tentang Kami</h5>
<h2>Thanks To</h2>
@php
  $setting = \App\Models\Setting::first();
@endphp
{!! $setting->about !!}
<ul>
  <div>
    <h3><b>Firmansyah</b></h3>
  </div>
</div>
</div> --}}
