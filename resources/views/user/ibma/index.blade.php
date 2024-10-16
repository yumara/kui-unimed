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
                        <h4 class="card-title">Pengajuan Anda</h4>
                    </div><!--end col-->
                    <div class="col-auto">
                        @if($userData->isComplete())
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="las la-plus"></i>
                            Tambah
                        </a>
                        @endif
                    </div>
                </div>  <!--end row-->
            </div><!--end card-header-->
            <div class="card-body pt-0">
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
                @else
                <div class="table-responsive">
                    <table class="table datatable" id="dt_ibma">
                        <thead class="table-light">
                          <tr>
                            <th data-type="date" data-format="DD/MM/YYYY HH:MM:SS">Tanggal Pengajuan</th>
                            <th>Detail</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                </div>
                @endif

            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->
</div><!--end row-->

@endsection

@if($userData->isComplete())
@section('js')
try{
    new simpleDatatables.DataTable(
        "#dt_ibma",
        {
            searchable:!0,
            fixedHeight:!1
        }
    );
}catch(e){

}
@endsection
@endif
