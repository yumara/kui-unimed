@extends('layout.app')

@php
    $isAdmin = Auth::user()->hasRole("ADMIN");
@endphp

@section('title', 'KUI UNIMED')
@section('page_name',"Setelan Akun")

@section('content')
    <div class="container-xxl">
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
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pas Foto Anda</h4>
                    </div><!--end card-header-->
                    <div class="card-body pt-0 align-self-center ">
                        <div class="position-relative me-3">
                            <img src="{{ $userData->getPhotoWithNullcheck() }}" alt="" height="150" class="rounded-circle">
                            <a href="#" class="thumb-md justify-content-center d-flex align-items-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                <i class="fas fa-camera"></i>
                            </a>
                        </div>
                    </div><!--end card-body-->
                    <div class="card-footer">
                        <small id="emailHelp" class="form-text text-muted">Harap pastikan pas foto anda sesuai dengan format yang diminta karena akan digunakan untuk pengajuan berkas.</small>
                    </div>
                </div><!--end card-->
                <div class="modal fade bd-example-modal-lg" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="@if ($isAdmin) {{ route('admin.profile.uploadimage',$userData) }} @else {{ route('user.profile.uploadimage',$userData) }} @endif" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="myLargeModalLabel">Upload Pas Foto</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div><!--end modal-header-->
                                <div class="modal-body">
                                    <input type="hidden" id="field" name="field" value="">
                                    <div class="input-group mb-3 mt-3">
                                        <label class="input-group-text" for="inputGroupFile01">File Foto</label>
                                        <input type="file" name="file" class="form-control file" id="inputGroupFile01">
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">File yang diizinkan: JPG, JPEG (Maksimal 2MB)</small>
                                </div><!--end modal-footer-->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                </div><!--end modal-footer-->
                            </form>
                        </div><!--end modal-content-->
                    </div><!--end modal-dialog-->
                </div><!--end modal-->
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Data Diri</h4>
                            </div><!--end col-->
                        </div>  <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
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
                                        <input class="form-control" type="text" name="name" value="{{  Auth::user()->name }}" readonly>
                                        <span class="form-text text-muted font-12">Data terkoneksi dengan SSO UNIMED</span>
                                    @else
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name',Auth::user()->name ) }}" required>
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
                                    <input class="form-control @error('place_birth') is-invalid @enderror" type="text" name="place_birth" value="{{ old('place_birth',$userData->place_birth )  }}">
                                    @error('place_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Tanggal Lahir</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('date_birth') is-invalid @enderror" type="date" name="date_birth" value="{{ $userData->date_birth == null ? old('date_birth',$userData->place_birth ) :  old('date_birth', $userData->date_birth->toDateString() ) }}" id="example-date-input" required>
                                </div>
                                @error('date_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Nomor Telepon / HP</label>
                                <div class="col-lg-9 col-xl-8">
                                    <div class="input-group">
                                        <span class="input-group-text @error('phone_number') is-invalid @enderror"><i class="las la-phone"></i></span>
                                        <input type="text" class="form-control" name="phone_number" placeholder="08xxxxxxxxx" aria-describedby="basic-addon1" value="{{ old('phone_number',$userData->phone_number ) }}">
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
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',Auth::user()->email )  }}" placeholder="Email" aria-describedby="basic-addon1">
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
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3" id="address">{{ old('address',$userData->address ) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Kota</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{ old('city',$userData->city ) }}">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Negara</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('country') is-invalid @enderror" type="text" name="country" value="{{ old('country',$userData->country ) }}">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Kode Pos</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('zipcode') is-invalid @enderror" type="text" name="zipcode" value="{{ old('zipcode',$userData->zipcode ) }}">
                                    @error('zipcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Kewarganegaraan</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('citizenship') is-invalid @enderror" type="text" name="citizenship" value="{{ old('citizenship',$userData->citizenship ) }}">
                                    @error('citizenship')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Pekerjaan</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('occupation') is-invalid @enderror" type="text" name="occupation" value="{{ old('occupation',$userData->occupation ) }}">
                                    @error('occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Nomor Paspor</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('passport_id') is-invalid @enderror" type="text" name="passport_id" value="{{ old('passport_id',$userData->passport_id ) }}">
                                    @error('passport_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center form-label">Program Studi</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control @error('study_program') is-invalid @enderror" type="text" name="study_program" value="{{ old('study_program',$userData->study_program ) }}">
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
        </div>

    </div>
@endsection
