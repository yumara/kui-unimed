@extends('layout.app')

@section('title', 'Upload File IBMA - KUI UNIMED')
@section('page_name',"Izin Belajar Mahasiswa Asing")

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        @if(session('message'))
        <div class="alert alert-success shadow-sm border-theme-white-2 mt-2" role="alert">
            <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-success rounded-circle mx-auto me-1">
                <i class="fas fa-check align-self-center mb-0 text-white "></i>
            </div>
            <strong>{{ session('message') }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">
                            <a href="{{ route('user.ibma') }}" class="btn btn-warning me-2">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            Upload Berkas Pengajuan
                        </h4>
                    </div><!--end col-->
                </div>  <!--end row-->
            </div><!--end card-header-->
            <div class="card-body pt-0">
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
