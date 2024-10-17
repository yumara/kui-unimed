@extends('layout.app')

@section('title', 'Izin Belajar Mahasiswa Asing - KUI UNIMED')
@section('page_name',"Izin Belajar Mahasiswa Asing")

@section('content')


<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Tambah Pengajuan Baru</h4>
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
                    </div>
                @endif
                <form action="{{ route('user.ibma.store')}}" method="POST">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-2">
                            <label>Program Studi</label>
                            <input class="form-control  @error('study_program') is-invalid @enderror" type="text" name="study_program" value="{{ old('study_porgram') }}" required>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-2">
                            <label>Periode Belajar</label>
                            <div class="input-group" id="DateRange">
                                <input type="text" name="date_start" value="{{ old('date_start') }}" class="form-control  @error('date_start') is-invalid @enderror" placeholder="Tanggal Mulai" aria-label="StartDate">
                                <span class="input-group-text">Sampai</span>
                                <input type="text" name="date_end" value="{{ old('date_end') }}"  class="form-control rounded-end  @error('date_end') is-invalid @enderror" placeholder="Tanggal Selesai" aria-label="EndDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch mb-2 mt-2">
                            <input class="form-check-input" type="checkbox" name="sponsor" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Dibiayai oleh Sponsor / Beasiswa (Siapkan Surat Pernyataan Penerima Beasiswa / Sponsor)</label>
                        </div>
                    </div>
                    <div class="col-sm-12 text-end">
                        <button type="submit" class="btn btn-primary px-4">Simpan dan Lanjutkan</button>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->
</div><!--end row-->

@endsection

@section('js')
    let elem=document.getElementById("DateRange");
    new DateRangePicker(elem,{});
@endsection
