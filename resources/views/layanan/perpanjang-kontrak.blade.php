@extends('layouts.master')
@section('content')
    @section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/abea6a9d41.js" crossorigin="anonymous"></script>
    <!-- checkbox style -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
    @endsection
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Perpanjangan Kontrak</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Perpanjangan Kontrak</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_layanan_cuti"><i class="fa fa-plus"></i> Tambah Perpanjangan Kontrak</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

                <!-- Search Filter -->
                <form action="" method="GET" id="search-form">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="name">
                                <label class="focus-label">Nama Pegawai</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="jenis_cuti">
                                <label class="focus-label">NIP</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                        </div>
                    </div>
                </form>
                <!-- Search Filter -->
                
                {{-- message --}}
                {!! Toastr::message() !!}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Tanggal Mulai Kontrak</th>
                                            <th>Tanggal Berakhir Kontrak</th>
                                            <th>Tanggal Perpanjangan Kontrak</th>
                                            <th class="text-right no-sort">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
        <!-- /Page Content -->

                    <!-- Tambah Layanan Cuti Modal -->
                    {{-- <div id="daftar_layanan_cuti" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pegawai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('layanan/cuti/tambah-data') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Nama Pegawai</label>
                                                    <select class="select" id="name" name="name">
                                                        <option value="">-- Pilih Nama Pegawai --</option>
                                                        @foreach ($userList as $key => $user)
                                                            <option value="{{ $user->name }}" data-user_id={{ $user->user_id }} data-nip={{ $user->nip }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">ID Pengguna <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="ID pengguna otomatis terisi" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">NIP <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" id="nip" name="nip" placeholder="NIP otomatis terisi" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Cuti</label>
                                                    <select class="select" name="jenis_cuti" id="jenis_cuti">
                                                        <option selected disabled> --Pilih Jenis Cuti --</option>
                                                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                                                        <option value="Cuti Sakit">Cuti Sakit</option>
                                                        <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                                        <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Lama Cuti</label>
                                                    <input type="number" class="form-control" name="lama_cuti" placeholder="Jumlah Hari Cuti">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai Cuti</label>
                                                    <input type="date" class="form-control" name="tanggal_mulai_cuti">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Selesai Cuti</label>
                                                    <input type="date" class="form-control" name="tanggal_selesai_cuti">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen Kelengkapan</label>
                                                    <input type="file" class="form-control" name="dokumen_kelengkapan">
                                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="status_pengajuan"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /Tambah Layanan Cuti Modal -->

                    <!-- Edit Layanan Cuti Modal -->
                    {{-- <div id="edit_layanan_cuti" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pengajuan Cuti</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('layanan/cuti/edit-data') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <input type="hidden" name="id" id="e_id" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Cuti</label>
                                                        <select name="jenis_cuti" class="select" id="e_jenis_cuti">
                                                            <option selected disabled> --Pilih Jenis Cuti --</option>
                                                            <option>Cuti Tahunan</option>
                                                            <option>Cuti Sakit</option>
                                                            <option>Cuti Melahirkan</option>
                                                            <option>Cuti Karena Alasan Penting</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Lama Cuti</label>
                                                        <input type="number" class="form-control" name="lama_cuti" id="e_lama_cuti" placeholder="Jumlah Hari Cuti" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Mulai Cuti</label>
                                                        <input type="date" class="form-control" name="tanggal_mulai_cuti" id="e_tanggal_mulai_cuti" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai Cuti</label>
                                                        <input type="date" class="form-control" name="tanggal_selesai_cuti" id="e_tanggal_selesai_cuti" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Kelengkapan</label>
                                                        <input type="file" class="form-control" id="dokumen_kelengkapan" name="dokumen_kelengkapan">
                                                        <input type="hidden" name="hidden_dokumen_kelengkapan" id="e_dokumen_kelengkapan" value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section">
                                                <button class="btn btn-primary submit-btn">Simpan</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /Edit Layanan Cuti Modal -->
     </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/layanancuti.js') }}"></script>
    @endsection
@endsection
