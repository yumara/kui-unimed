@extends('layout.locker')

@section('title', 'Login - KUI UNIMED')

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
                        <p class="text-muted fw-medium mb-0">Masuk ke Akun Anda</p>
                    </div>
                </div>
                <div class="card-body pt-0">
                    {{-- Menampilkan error validasi --}}
                    @if($errors->any())
                        <div class="alert alert-danger shadow-sm border-theme-white-2 mt-2" role="alert">
                            <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1">
                                <i class="fas fa-xmark align-self-center mb-0 text-white "></i>
                            </div>
                            <strong>Gagal Login!</strong>
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <form class="my-4" action="{{ route('auth.login.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                        </div><!--end form-group-->

                        <div class="form-group">
                            <label class="form-label" for="userpassword">Password</label>
                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Masukkan password">
                        </div><!--end form-group-->

                        <div class="form-group row mt-3">
                            <div class="col-sm-6">
                                <div class="form-check form-switch form-switch-success">
                                    <input class="form-check-input" type="checkbox" name="remember" id="customSwitchSuccess">
                                    <label class="form-check-label" for="customSwitchSuccess">Ingat Saya</label>
                                </div>
                            </div><!--end col-->
                            <div class="col-sm-6 text-end">
                                <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Lupa password?</a>
                            </div><!--end col-->
                        </div><!--end form-group-->

                        <div class="form-group mb-0 row">
                            <div class="col-12">
                                <div class="d-grid mt-3">
                                    <button class="btn btn-primary" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                </div>
                            </div><!--end col-->
                            <div class="col-12">
                                <div class="d-flex mt-3 justify-content-center">
                                    <a href="{{ route('auth.keycloak.login')}}">
                                        <button class="btn btn-info" type="button">Log In dengan SSO Unimed <i class="fas fa-sign-in-alt ms-1"></i></button>
                                    </a>
                                </div>
                            </div><!--end col-->
                        </div> <!--end form-group-->
                    </form><!--end form-->
                    <div class="text-center  mb-2">
                        <p class="text-muted">Belum punya akun ?  <a href="{{ route('auth.register')}}" class="text-primary ms-2">Daftar Sekarang</a></p>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end card-body-->
@endsection
