@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"> Pengajuan Cuti</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pengajuan Cuti</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#tambah_cuti"><i
                            class="fa fa-plus"></i> Tambah Pengajuan Cuti</a>
                </div>
            </div>

            {{-- Fungsi Seacrh --}}
            <form action="" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nampeg" name="nampeg">
                            <label class="focus-label">Nama Pegawai</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form>
            {{-- /Fungsi Seacrh --}}
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
                                        <th>Jenis Cuti</th>
                                        <th>Lama Cuti</th>
                                        <th>Tanggal Mulai Cuti</th>
                                        <th>Tanggal Selesai Cuti</th>
                                        <th>Dokumen Kelengkapan</th>
                                        <th>Status Permohonan Cuti</th>
                                        <th class="text-right no-sort">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_cuti as $sqlcuti => $result_cuti)
                                    <tr>
                                        <td>{{ ++$sqlcuti }}</td>
                                        <td>{{ $result_cuti->name }}</td>
                                        <td>{{ $result_cuti->nip }}</td>
                                        <td>{{ $result_cuti->jenis_cuti }}</td>
                                        <td>{{ $result_cuti->lama_cuti }}</td>
                                        <td>{{ $result_cuti->tanggal_mulai_cuti }}</td>
                                        <td>{{ $result_cuti->tanggal_selesai_cuti }}</td>
                                        <td>{{ $result_cuti->dokumen_kelengkapan }}</td>
                                        <td>{{ $result_cuti->status_pengajuan }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ url('layanan/cuti/edit/' . $result_cuti->user_id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tambah Pengujian Cuti -->
                <div id="tambah_cuti" class="modal custom-modal fade" role="dialog">
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
                                    @foreach($data_profilcuti as $result_user)
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="nama_pegawai">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="name" name="name"  value="{{ $result_user->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input type="text" class="form-control" id="nip" name="nip" value="{{ $result_user->nip }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jenis_cuti">Jenis Cuti</label>
                                            <select class="select" id="jenis_cuti" name="jenis_cuti">
                                                <option selected disabled> --Pilih Jenis Cuti --</option>
                                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                                <option value="Cuti Sakit">Cuti Sakit</option>
                                                <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                                <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lama_cuti">Lama Cuti</label>
                                            <input type="number" class="form-control" id="lama_cuti" name="lama_cuti" placeholder="Jumlah Hari Cuti">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tanggal_mulai_cuti">Tanggal Mulai Cuti</label>
                                            <input type="date" class="form-control" id="tanggal_mulai_cuti" name="tanggal_mulai_cuti">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_cuti">Tanggal Selesai Cuti</label>
                                            <input type="date" class="form-control" id="tanggal_selesai_cuti" name="tanggal_selesai_cuti">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dokumen_kelengkapan">Dokumen Kelengkapan</label>
                                            <input type="file" class="form-control" id="dokumen_kelengkapan" name="dokumen_kelengkapan">
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
            </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection
