@extends('layout.locker')

@section('title', 'Daftar - KUI UNIMED')

@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <div class="card">
                <div class="card-body p-0 bg-black auth-header-box rounded-top">
                    <div class="text-center p-3">
                        <a href="index.html" class="logo logo-admin">
                            <img src="{{ asset('images/unimed.png') }}" height="50" alt="logo" class="auth-logo">
                        </a>
                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Kantor Urusan Internasional UNIMED</h4>
                        <p class="text-muted fw-medium mb-0">Buat Akun Baru</p>
                    </div>
                </div>
                <div class="card-body pt-0">
                    {{-- Menampilkan error validasi --}}
                    @if($errors->any())
                        <div class="alert alert-danger shadow-sm border-theme-white-2 mt-2" role="alert">
                            <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1">
                                <i class="fas fa-xmark align-self-center mb-0 text-white "></i>
                            </div>
                            <strong>Gagal Daftarkan Akun!</strong>
                            @foreach($errors->all() as $error)
                                {{ $error }}.
                            @endforeach
                        </div>
                    @endif

                    <form class="my-4" action="{{ route('auth.register.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap">
                        </div><!--end form-group-->

                        <div class="form-group mb-2">
                            <label class="form-label" for="useremail">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="useremail" name="email" placeholder="Masukkan email">
                        </div><!--end form-group-->

                        <div class="form-group mb-2">
                            <label class="form-label" for="userpassword">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Masukkan password">
                        </div><!--end form-group-->

                        <div class="form-group mb-2">
                            <label class="form-label" for="Confirmpassword">Ulangi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password_confirmation" id="Confirmpassword" placeholder="Masukkan kembali password">
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-12">
                                <div class="d-grid mt-3">
                                    <button class="btn btn-primary" type="submit">Daftar <i class="fas fa-sign-in-alt ms-1"></i></button>
                                </div>
                            </div><!--end col-->
                        </div> <!--end form-group-->
                    </form><!--end form-->
                    <div class="text-center">
                        <p class="text-muted">Sudah punya Akun?  <a href="{{ route('auth.login')}}" class="text-primary ms-2">Log in</a></p>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end card-body-->
@endsection
