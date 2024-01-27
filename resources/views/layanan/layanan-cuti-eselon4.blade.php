@extends('layouts.master')
@extends('layouts.judulcutieselon4')
@section('content')
 
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Pengajuan Cuti Eselon 4</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pengajuan Cuti Eselon 4</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                    <!-- Cetak Dokumen Kelengkapan PDF -->
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <select id="pilihDokumenKelengkapan" class="form-control">
                                    <option selected disabled> --Pilih Dokumen Kelengkapan --</option>
                                @foreach($data_cuti_pdf_kelengkapan as $pdf_kelengkapan)
                                    <option value="{{ $pdf_kelengkapan->id }}">Dokumen Kelengkapan - {{ $pdf_kelengkapan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <button id="cetakDokumenKelengkapan" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i> Dokumen Kelengkapan</button>&nbsp;&nbsp;
                        </div>
                    </div><br>
                    <!-- /Cetak Dokumen Kelengkapan PDF -->
                
                    <!-- Search Filter -->
                    <form action="{{ route('layanan/cuti/cari/eselon-4') }}" method="GET" id="search-form">
                        @csrf
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
                                    <label class="focus-label">Jenis Cuti</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="persetujuan_eselon4">
                                    <label class="focus-label">Status Pengajuan</label>
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

                    <!-- Untuk User -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                {{-- <table class="table table-striped custom-table" id="tablePengajuanCutiEselon4User" style="width: 100%"> --}}
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Jenis Cuti</th>
                                            <th>Lama Cuti (Hari)</th>
                                            <th>Sisa Cuti (N2, N1, N)</th>
                                            <th>Tanggal Mulai Cuti</th>
                                            <th>Tanggal Selesai Cuti</th>
                                            <th>Tanggal Pengajuan Cuti</th>
                                            <th>Dokumen Kelengkapan</th>
                                            <th>Pengajuan Eselon 4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_cuti as $sqlcuti => $result_cuti)
                                        <tr>
                                            <td>{{ ++$sqlcuti }}</td>
                                            <td hidden class="id">{{ $result_cuti->id }}</td>
                                            <td class="name">{{ $result_cuti->name }}</td>
                                            <td class="nip">{{ $result_cuti->nip }}</td>
                                            <td class="jenis_cuti">{{ $result_cuti->jenis_cuti }}</td>
                                            <td class="lama_cuti">{{ $result_cuti->lama_cuti }}</td>
                                            <td>
                                                {{ date('Y', strtotime('-2 year')) }} = {{ $sisaCutiTwoYearsAgo }} hari,&nbsp;&nbsp;&nbsp;
                                                {{ date('Y', strtotime('-1 year')) }} = {{ $sisaCutiLastYear }} hari,&nbsp;&nbsp;&nbsp;
                                                {{ date('Y') }} = {{ $sisaCutiThisYear }} hari
                                            </td>
                                            <td class="tanggal_mulai_cuti">{{ $result_cuti->tanggal_mulai_cuti }}</td>
                                            <td class="tanggal_selesai_cuti">{{ $result_cuti->tanggal_selesai_cuti }}</td>
                                            <td>{{ \Carbon\Carbon::parse($result_cuti->created_at)->formatLocalized('%d %B %Y') }}</td>
                                            <td class="dokumen_kelengkapan">
                                                <a href="{{ asset('assets/DokumenKelengkapan/' . $result_cuti->dokumen_kelengkapan) }}" target="_blank">
                                                    @if (pathinfo($result_cuti->dokumen_kelengkapan, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                    @endif
                                                        <td hidden class="dokumen_kelengkapan">{{ $result_cuti->dokumen_kelengkapan }}</td>
                                                </a>
                                            </td>
                                            <td class="persetujuan_eselon4">
                                                <div class="dropdown">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" id="statusDropdown" data-toggle="dropdown" aria-expanded="false">
                                                        @if ($result_cuti->persetujuan_eselon4 == 'Disetujui')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                        @elseif ($result_cuti->persetujuan_eselon4 == 'Dalam Proses Persetujuan')
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                        @elseif ($result_cuti->persetujuan_eselon4 == 'Ditolak')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                        @endif
                                                        <span class="dropdown_pengajuan">{{ $result_cuti->persetujuan_eselon4 }}</span>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                        <form action="{{ route('updateStatus', $result_cuti->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon4" value="Disetujui">
                                                                <i class="fa fa-dot-circle-o text-success"></i> Disetujui
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon4" value="Dalam Proses Persetujuan">
                                                                <i class="fa fa-dot-circle-o text-warning"></i> Dalam Proses Persetujuan
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon4" value="Ditolak">
                                                                <i class="fa fa-dot-circle-o text-danger"></i> Ditolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br><br><br>
                    <!-- /Untuk User -->

                    <!-- Untuk Pribadi -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#layanan_cuti"><i class="fa fa-plus"></i> Tambah Pengajuan Cuti</a>
                            </div>
                            
                            <!-- Cetak Dokumen Kelengkapan PDF -->
                            @php
                                $lastCuti = $data_cuti_pribadi->last();
                            @endphp
                            @if ($lastCuti)
                                <a href="{{ route('layanan-cuti-kelengkapan2', ['id' => $lastCuti->id]) }}" target="_blank" class="btn btn-success">
                                    <i class="fa-solid fa-file-pdf"></i> Dokumen Kelengkapan
                                </a>&nbsp;&nbsp;
                                <button type="button" class="btn btn-info" id="lihatSemua">
                                    <i id="icon2" class="fa fa-eye-slash"></i> Lihat Semua Progress
                                </button>
                            @else
                            @endif
                            <br><br>
                            <!-- /Cetak Dokumen Kelengkapan PDF -->

                            <h3 class="page-title2">Pengajuan Cuti Pribadi</h3>
                            <div class="table-responsive">
                                {{-- <table class="table table-striped custom-table" id="tablePengajuanCutiEselon4Pribadi" style="width: 100%"> --}}
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Jenis Cuti</th>
                                            <th>Lama Cuti (Hari)</th>
                                            <th>Sisa Cuti (N2, N1, N)</th>
                                            <th>Tanggal Mulai Cuti</th>
                                            <th>Tanggal Selesai Cuti</th>
                                            <th>Tanggal Pengajuan Cuti</th>
                                            <th>Dokumen Kelengkapan</th>
                                            <th>Status Permohonan Cuti</th>
                                            <th>Progress Persetujuan</th>
                                            <th>Pengajuan Eselon 4</th>
                                            <th class="text-right no-sort">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_cuti_pribadi as $sqlcutipribadi => $result_cuti_pribadi)
                                        <tr>
                                            <td>{{ ++$sqlcutipribadi }}</td>
                                            <td hidden class="id">{{ $result_cuti_pribadi->id }}</td>
                                            <td class="name">{{ $result_cuti_pribadi->name }}</td>
                                            <td class="nip">{{ $result_cuti_pribadi->nip }}</td>
                                            <td class="jenis_cuti">{{ $result_cuti_pribadi->jenis_cuti }}</td>
                                            <td class="lama_cuti">{{ $result_cuti_pribadi->lama_cuti }}</td>
                                            <td>
                                                {{ date('Y', strtotime('-2 year')) }} = {{ $sisaCutiTwoYearsAgo }} hari,&nbsp;&nbsp;&nbsp;
                                                {{ date('Y', strtotime('-1 year')) }} = {{ $sisaCutiLastYear }} hari,&nbsp;&nbsp;&nbsp;
                                                {{ date('Y') }} = {{ $sisaCutiThisYear }} hari
                                            </td>
                                            <td class="tanggal_mulai_cuti">{{ $result_cuti_pribadi->tanggal_mulai_cuti }}</td>
                                            <td class="tanggal_selesai_cuti">{{ $result_cuti_pribadi->tanggal_selesai_cuti }}</td>
                                            <td>{{ \Carbon\Carbon::parse($result_cuti_pribadi->created_at)->formatLocalized('%d %B %Y') }}</td>
                                            <td class="dokumen_kelengkapan">
                                                <a href="{{ asset('assets/DokumenKelengkapan/' . $result_cuti_pribadi->dokumen_kelengkapan) }}" target="_blank">
                                                    @if (pathinfo($result_cuti_pribadi->dokumen_kelengkapan, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                    @endif
                                                        <td hidden class="dokumen_kelengkapan">{{ $result_cuti_pribadi->dokumen_kelengkapan }}</td>
                                                </a>
                                            </td>
                                            <td class="status_pengajuan">
                                                <div class="dropdown">
                                                    <a class="status-persetujuan-superadmin">
                                                        @if ($result_cuti_pribadi->status_pengajuan == 'Disetujui')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                        @elseif ($result_cuti_pribadi->status_pengajuan == 'Dalam Proses Persetujuan')
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                        @elseif ($result_cuti_pribadi->status_pengajuan == 'Ditolak')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                        @endif
                                                        <span class="status_pengajuan">{{ $result_cuti_pribadi->status_pengajuan }}</span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="progress_persetujuan">
                                                <div class="dropdown status-persetujuan-user">
                                                    @if ($result_cuti_pribadi->persetujuan_kepalaruangan == 'Disetujui')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_kepalaruangan == 'Dalam Proses Persetujuan')
                                                        <i class="fa fa-dot-circle-o text-warning"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_kepalaruangan == 'Ditolak')
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                    @endif
                                                    <span class="persetujuan_kepalaruangan">{{ $result_cuti_pribadi->persetujuan_kepalaruangan }}</span> (Kelapa Ruangan)
                                                </div>
                                                <div class="dropdown status-persetujuan-user">
                                                    @if ($result_cuti_pribadi->persetujuan_eselon4 == 'Disetujui')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_eselon4 == 'Dalam Proses Persetujuan')
                                                        <i class="fa fa-dot-circle-o text-warning"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_eselon4 == 'Ditolak')
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                    @endif
                                                    <span class="persetujuan_eselon4">{{ $result_cuti_pribadi->persetujuan_eselon4 }}</span> (Eselon 4)
                                                </div>
                                                <div class="dropdown status-persetujuan-user">
                                                    @if ($result_cuti_pribadi->persetujuan_administrasi == 'Disetujui')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_administrasi == 'Dalam Proses Persetujuan')
                                                        <i class="fa fa-dot-circle-o text-warning"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_administrasi == 'Ditolak')
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                    @endif
                                                        <span class="persetujuan_administrasi">{{ $result_cuti_pribadi->persetujuan_administrasi }}</span> (Administrasi)
                                                </div>
                                                <div class="dropdown status-persetujuan-user">
                                                    @if ($result_cuti_pribadi->persetujuan_eselon3 == 'Disetujui')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_eselon3 == 'Dalam Proses Persetujuan')
                                                        <i class="fa fa-dot-circle-o text-warning"></i>
                                                    @elseif ($result_cuti_pribadi->persetujuan_eselon3 == 'Ditolak')
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                    @endif
                                                        <span class="persetujuan_eselon3">{{ $result_cuti_pribadi->persetujuan_eselon3 }}</span> (Eselon 3)
                                                </div>
                                            </td>
                                            <td class="persetujuan_eselon4">
                                                <div class="dropdown">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" id="statusDropdown" data-toggle="dropdown" aria-expanded="false">
                                                        @if ($result_cuti_pribadi->persetujuan_eselon4 == 'Disetujui')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                        @elseif ($result_cuti_pribadi->persetujuan_eselon4 == 'Dalam Proses Persetujuan')
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                        @elseif ($result_cuti_pribadi->persetujuan_eselon4 == 'Ditolak')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                        @endif
                                                        <span class="dropdown_pengajuan">{{ $result_cuti_pribadi->persetujuan_eselon4 }}</span>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                        <form action="{{ route('updateStatus', $result_cuti_pribadi->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon4" value="Disetujui">
                                                                <i class="fa fa-dot-circle-o text-success"></i> Disetujui
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon4" value="Dalam Proses Persetujuan">
                                                                <i class="fa fa-dot-circle-o text-warning"></i> Dalam Proses Persetujuan
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon4" value="Ditolak">
                                                                <i class="fa fa-dot-circle-o text-danger"></i> Ditolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
    
                                            {{-- Edit Layanan Cuti--}}
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit_layanan_cuti" href="#" data-toggle="modal" data-target="#edit_layanan_cuti"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a href="{{ route('layanan-cuti-kelengkapan2', ['id' => $result_cuti_pribadi->id]) }}" target="_blank" class="dropdown-item cetak-cuti"><i class="fa fa-print m-r-5"></i> Cetak Kelengkapan</a>
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
                    <!-- /Untuk Pribadi -->
                </div>
                <!-- /Page Content -->

                <!-- Tambah Layanan Cuti Modal -->
                <div id="layanan_cuti" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pengajuan Cuti</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('layanan/cuti/tambah-data') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->user_id }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @foreach($data_profilcuti_pribadi as $sqlcuti_tambah => $result_cuti_tambah)
                                                        <input type="hidden" class="form-control" name="name"  value="{{ $result_cuti_tambah->name }}">
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @foreach($data_profilcuti_pribadi as $sqlcuti_tambah => $result_cuti_tambah)
                                                        <input type="hidden" class="form-control" name="nip" value="{{ $result_cuti_tambah->nip }}">
                                                    @endforeach
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="status_pengajuan"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_administrasi"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_eselon3"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_eselon4"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_kepalaruangan"  value="Disetujui">
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
                <!-- /Tambah Layanan Cuti Modal -->

                <!-- Edit Layanan Cuti Modal -->
                <div id="edit_layanan_cuti" class="modal custom-modal fade" role="dialog">
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
                                            <div class="dropzone-box">
                                                <label>Dokumen Kelengkapan</label>
                                                <div class="dropzone-area">
                                                    <div class="file-upload-icon"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg></div>
                                                    <p class="message-form">Klik untuk mengunggah atau seret dan lepas</p>
                                                    <input type="file" class="form-control" id="dokumen_kelengkapan" name="dokumen_kelengkapan">
                                                    <input type="hidden" name="hidden_dokumen_kelengkapan" id="e_dokumen_kelengkapan" value="">
                                                    <p class="message-preview1">Tidak ada file yang di pilih</p>
                                                </div>
                                                <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
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
                <!-- /Edit Layanan Cuti Modal -->
            </div>
            <!-- /Page Wrapper -->

    @section('script')
        <script>
            $(document).ready(function () {
                $('#pilihDokumenKelengkapan').select2();
                $('#cetakDokumenKelengkapan').on('click', function ()
                {
                    const selectedCutiId = $('#pilihDokumenKelengkapan').val();
                    if (selectedCutiId)
                    {
                        const url = "{{ route('layanan-cuti-admin-kelengkapan', ['id' => ':id']) }}".replace(':id', selectedCutiId);
                        window.open(url, '_blank');
                    }
                });
            });
        </script>

        <script src="{{ asset('assets/js/layanancuti.js') }}"></script>
        <script src="{{ asset('assets/js/pengajuancuti.js') }}"></script>
        <script src="{{ asset('assets/js/draganddropCuti.js') }}"></script>

        <script>
            history.pushState({}, "", '/layanan/cuti/eselon-4');
        </script>

    @endsection
@endsection
