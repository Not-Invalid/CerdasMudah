@extends('layouts.front')
@section('content')
<!--================ Start Course Details Area =================-->
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="section_tittle text-center">
                    <h2>Akun</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Centering the card -->
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="get">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role" class="form-label">Status Akun</label>
                                <input type="text" name="role" id="role" class="form-control" value="{{ Auth::user()->role }}" readonly>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('akun.editprofil') }}" class="btn btn-warning text-white">Edit Profil</a>
                                <a href="{{ route('akun.editkatasandi') }}" class="btn btn-secondary">Edit Kata Sandi</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Course Details Area =================-->
@endsection
