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
        @if($errors->any())
            <div class="alert alert-danger shadow-sm border-theme-white-2 mt-2" role="alert">
                <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1">
                    <i class="fas fa-xmark align-self-center mb-0 text-white "></i>
                </div>
                <strong>Gagal upload foto!</strong> Periksa kembali file Anda<br>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis Berkas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Paspor</td>
                            <td>
                                @empty($ibma->file_passport)
                                    <span class="badge bg-dark">Belum Diupload</span>
                                @else
                                    <span class="badge bg-primary">Sudah Diupload</span>
                                @endempty
                            </td>
                            <td>
                                @isset($ibma->file_passport)
                                    <a href="" target="_blank" class="btn btn-info btn-sm">Lihat Dokumen</a>
                                @endisset
                                <button type="button" class="btn btn-primary btn-sm triggerUpload"  data-bs-toggle="modal" data-bs-target="#uploadModal" data-field="file_passport" data-fieldlabel="Paspor">Upload</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Surat Keterangan Sehat</td>
                            <td>
                                @empty($ibma->file_sk_sehat)
                                    <span class="badge bg-dark">Belum Diupload</span>
                                @else
                                    <span class="badge bg-primary">Sudah Diupload</span>
                                @endempty
                            </td>
                            <td>
                                @isset($ibma->file_sk_sehat)
                                    <a href="" target="_blank" class="btn btn-info btn-sm">Lihat Dokumen</a>
                                @endisset
                                <button type="button" class="btn btn-primary btn-sm triggerUpload"  data-bs-toggle="modal" data-bs-target="#uploadModal" data-field="file_sk_sehat" data-fieldlabel="Surat Keterangan Sehat">Upload</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Surat Pernyataan</td>
                            <td>
                                @empty($ibma->file_soc)
                                    <span class="badge bg-dark">Belum Diupload</span>
                                @else
                                    <span class="badge bg-primary">Sudah Diupload</span>
                                @endempty
                            </td>
                            <td>
                                @isset($ibma->file_soc)
                                    <a href="" target="_blank" class="btn btn-info btn-sm">Lihat Dokumen</a>
                                @endisset
                                <button type="button" class="btn btn-primary btn-sm triggerUpload"  data-bs-toggle="modal" data-bs-target="#uploadModal" data-field="file_soc" data-fieldlabel="Surat Pernyataan">Upload</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Surat Pernyataan Kesanggupan Pembayaran</td>
                            <td>
                                @empty($ibma->file_sofs)
                                    <span class="badge bg-dark">Belum Diupload</span>
                                @else
                                    <span class="badge bg-primary">Sudah Diupload</span>
                                @endempty
                            </td>
                            <td>
                                @isset($ibma->file_sofs)
                                    <a href="" target="_blank" class="btn btn-info btn-sm">Lihat Dokumen</a>
                                @endisset
                                <button type="button" class="btn btn-primary btn-sm triggerUpload"  data-bs-toggle="modal" data-bs-target="#uploadModal" data-field="file_sofs" data-fieldlabel="Surat Pernyataan Kesanggupan Pembayaran">Upload</button>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Ijazah Terakhir dan Transkrip Nilai</td>
                            <td>
                                @empty($ibma->file_ijazah_transkrip)
                                    <span class="badge bg-dark">Belum Diupload</span>
                                @else
                                    <span class="badge bg-primary">Sudah Diupload</span>
                                @endempty
                            </td>
                            <td>
                                @isset($ibma->file_ijazah_transkrip)
                                    <a href="" target="_blank" class="btn btn-info btn-sm">Lihat Dokumen</a>
                                @endisset
                                <button type="button" class="btn btn-primary btn-sm triggerUpload"  data-bs-toggle="modal" data-bs-target="#uploadModal" data-field="file_ijazah_transkrip" data-fieldlabel="Ijazah & Transkrip Nilai">Upload</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="col-sm-12 text-end mt-4">
                    <button type="submit" disabled class="btn btn-secondary px-4">Ajukan Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('user.ibma.uplprocess',$ibma->id)}}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Upload File</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            File yang Akan Diupload
                        </div>
                        <div class="col-6">
                            <strong id="fieldLabel">Jenis File</strong>
                        </div>
                    </div>
                    <input type="hidden" id="field" name="field" value="">
                    <div class="input-group mb-3 mt-3">
                        <label class="input-group-text" for="inputGroupFile01">File</label>
                        <input type="file" name="file" class="form-control file" id="inputGroupFile01">
                    </div>
                    <small id="emailHelp" class="form-text text-muted">File yang diizinkan: JPG, JPEG, DOCX, PDF (Maksimal 2MB)</small>
                </div><!--end modal-footer-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
@endsection
@section('js')
function triggerUpload(e){
    var fs = e.target.dataset.field;
    var fl = e.target.dataset.fieldlabel;
    document.getElementById('field').setAttribute('value',fs);
    document.getElementById('fieldLabel').textContent=fl;
    document.querySelector('.file').value = "";
}

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
var btnUploads = document.querySelectorAll('.triggerUpload');
btnUploads.forEach(function(btn) {
    btn.addEventListener('click',triggerUpload);
});
@endsection
