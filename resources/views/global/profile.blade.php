@extends('layout.app')

@php
    $isAdmin = Auth::user()->hasRole("ADMIN");
@endphp

@section('title', 'KUI UNIMED')
@section('page_name',"Setelan Akun")

@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Data Diri</h4>
                    </div><!--end col-->
                </div>  <!--end row-->
            </div><!--end card-header-->
            <div class="card-body pt-0">
                @if(session('message'))
                    <div class="alert alert-success shadow-sm border-theme-white-2 mt-2" role="alert">
                        <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-success rounded-circle mx-auto me-1">
                            <i class="fas fa-check align-self-center mb-0 text-white "></i>
                        </div>
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger shadow-sm border-theme-white-2 mt-2" role="alert">
                        <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1">
                            <i class="fas fa-xmark align-self-center mb-0 text-white "></i>
                        </div>
                        <strong>Gagal perbarui data!</strong> Periksa kembali data Anda<br>
                        @foreach($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                @endif
                <form action="
                @if ($isAdmin)
                    {{ route('admin.profile.update',$userData) }}
                @else
                    {{ route('user.profile.update',$userData) }}
                @endif
                " method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Nama Lengkap</label>
                        <div class="col-lg-9 col-xl-8">
                            @if ($isAdmin)
                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" readonly>
                                <span class="form-text text-muted font-12">Data terkoneksi dengan SSO UNIMED</span>
                            @else
                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Jenis Kelamin</label>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" @checked(old('gender', $userData->gender == "L"))>
                                <label class="form-check-label" for="genderL">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderP" value="P" @checked(old('gender', $userData->gender == "P"))>
                                <label class="form-check-label" for="genderP">Perempuan</label>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> <!--end row-->
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Tempat Lahir</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="place_birth" value="{{ $userData->place_birth }}" required>
                        </div>
                        @error('place_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Tanggal Lahir</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="date" name="date_birth" value="{{ $userData->date_birth->toDateString() }}" id="example-date-input" required>
                        </div>
                        @error('date_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Nomor Telepon / HP</label>
                        <div class="col-lg-9 col-xl-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="las la-phone"></i></span>
                                <input type="text" class="form-control" name="phone_number" placeholder="08xxxxxxxxx" aria-describedby="basic-addon1" value="{{ $userData->phone_number }}">
                            </div>
                        </div>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Email</label>
                        <div class="col-lg-9 col-xl-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="las la-at"></i></span>
                                @if ($isAdmin)
                                    <input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}" readonly>
                                @else
                                    <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email" aria-describedby="basic-addon1">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            @if ($isAdmin)
                                <span class="form-text text-muted font-12">Data terkoneksi dengan SSO UNIMED</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Alamat</label>
                        <div class="col-lg-9 col-xl-8">
                            <div class="input-group">
                                <textarea class="form-control" name="address" rows="3" id="address">{{ $userData->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Kota</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="city" value="{{ $userData->city }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Negara</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="country" value="{{ $userData->country }}">
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Kewarganegaraan</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="citizenship" value="{{ $userData->citizenship }}">
                            @error('citizenship')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Pekerjaan</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="occupation" value="{{ $userData->occupation }}">
                            @error('occupation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Nomor Paspor</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="passport_id" value="{{ $userData->passport_id }}">
                            @error('passport_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Program Studi</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="text" name="study_program" value="{{ $userData->study_program }}">
                            @error('study_program')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Password</h4>
            </div><!--end card-header-->
            <div class="card-body pt-0">
                <div class="form-group mb-3 row">
                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Password Saat Ini</label>
                    <div class="col-lg-9 col-xl-8">
                        <input class="form-control" type="password" placeholder="Password">
                        <a href="#" class="text-primary font-12">Lupa ?</a>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Password Baru</label>
                    <div class="col-lg-9 col-xl-8">
                        <input class="form-control" type="password" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Ulangi Password Baru</label>
                    <div class="col-lg-9 col-xl-8">
                        <input class="form-control" type="password" placeholder="Re-Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-9 col-xl-8 offset-lg-3">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>
@endsection
