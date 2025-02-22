@extends('layouts.front')
@section('content')
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>About CerdasMudah</h2>
              <p>Aplikasi ini dibuat oleh para siswa dan siswi SMKN 4 Kota Tangerang dikala sedang mempersiapkan ulangan-ulangan akhir semester.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
          <div class="single_feature shadow">
            <div class="single_feature_part">
              <span class="single_feature_icon"><i class="ti-layers"></i></span>
              <h4>Gratis</h4>
              <p>Kelas Gratis ini bisa diakses oleh semua orang yang mengunjungi web ini</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature shadow">
            <div class="single_feature_part">
              <span class="single_feature_icon"><i class="ti-new-window"></i></span>
              <h4>Regular</h4>
              <p>Kelas Regular hanya bisa diakses dengan cara membuat akun </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature shadow">
            <div class="single_feature_part single_feature_part_2">
              <span class="single_service_icon style_icon"><i class="ti-light-bulb"></i></span>
              <h4>Premium</h4>
              <p>Kelas Premium hanya bisa diakses dengan cara membuat akun dan mengupgrade akun ke akun premium</p>
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
          <p>Project Manager / Frontend Developer</p>
        </div>
      </div>
    </div>
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/raplifoto.png') }}">
          <h5>Raffli Firmansyah</h5>
          <p>Asst. Manager / Full Stack Developer</p>
        </div>
      </div>
    </div>
    <div class="isiTeam">
      <div class="card">
        <div class="card-body">
          <img src="{{ URL::asset('frontemplate/img/team/cipofoto.png') }}">
          <h5>Chivo Hifdz Addien Kurniawan</h5>
          <p>Marketing / Frontend Developer</p>
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


  <script></script>
  <!-- learning part end-->
@endsection
