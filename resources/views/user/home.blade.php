@extends('layout.app')

@section('title', 'KUI UNIMED')
@section('page_name',"Selamat Datang!")

@section('content')
@if(!$userData->isComplete())
<div class="mt-3 p-3 border border-danger bg-danger-subtle rounded">
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1 fs-30 align-self-center text-danger">
            <i class="iconoir-warning-triangle"></i>
        </div>
        <div class="col">
            <h5 class="text-danger fs-18 mb-1 fw-semibold">Lengkapi Data Diri Anda!</h5>
            <p class="text-muted mb-0 fs-14">Anda belum dapat melakukan pengajuan sebelum melengkapi data diri anda di menu Setelan Akun.</p>
        </div> <!--end col-->
        <div class="col-auto align-self-center">
            <a href="{{ route('user.profile') }}" target="_self"  type="button" class="btn btn-danger">Ke Setelan Akun</a>
        </div> <!--end col-->
    </div><!--end row-->
</div><!--end div-->
@endif

@endsection
