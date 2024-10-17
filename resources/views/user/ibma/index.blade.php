@extends('layout.app')

@section('title', 'Izin Belajar Mahasiswa Asing - KUI UNIMED')
@section('page_name',"Izin Belajar Mahasiswa Asing")

@section('content')


<div class="row justify-content-center">
    @if(session('message'))
    <div class="alert alert-success shadow-sm border-theme-white-2 mt-2" role="alert">
        <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-success rounded-circle mx-auto me-1">
            <i class="fas fa-check align-self-center mb-0 text-white "></i>
        </div>
        <strong>{{ session('message') }}</strong>
    </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Pengajuan Anda</h4>
                    </div><!--end col-->
                    <div class="col-auto">
                        @if($userData->isComplete())
                        <a href="{{ route('user.ibma.create')}}" class="btn btn-primary">
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
                            @foreach ($ibmas as $ibma)
                                <tr>
                                    <td>{{ $ibma->created_at }}</td>
                                    <td>
                                        <strong>Program Studi: {{ $ibma->study_program }}</strong><br>
                                        @if ($ibma->sponsor)
                                            Dibiayai Beasiswa / Sponsor
                                        @else
                                            Dibiayai Sendiri
                                        @endif
                                    </td>
                                    <td>{{ $ibma->status }}</td>
                                    <td>
                                        <a href="{{ route('user.ibma.detail',$ibma->id)}}" class="btn btn-secondary btn-sm">
                                            <i class="las la-eye"></i>
                                            Detail
                                        </a>
                                        @if($ibma->status == "Mengupload File")
                                        <a href="{{ route('user.ibma.update',$ibma->id)}}" class="btn btn-info btn-sm">
                                            <i class="las la-pen"></i>
                                            Edit Informasi
                                        </a>
                                        <a href="{{ route('user.ibma.update',$ibma->id)}}" class="btn btn-info btn-sm">
                                            <i class="las la-pen"></i>
                                            Upload File
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $ibma->id }})">
                                            <i class="las la-times"></i>
                                            Batalkan
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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
function confirmDelete(id){
    Swal.fire({
        title: "Anda Yakin?",
        text: "Seluruh riwayat pengajuan anda termasuk dokumen yang sudah Anda upload akan ikut terhapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Saya Yakin",
        cancelButtonText: "Batal",
    }).then((e)=>{
        if (e.isConfirmed) {
            console.log(id);
        }
    });
}
@endsection
@endif
