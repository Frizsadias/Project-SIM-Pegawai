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
                        <h3 class="page-title">Pengajuan Cuti</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pengajuan Cuti</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#layanan_cuti"><i
                                class="fa fa-plus"></i> Tambah Pengajuan Cuti</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('layanan/cuti/cari') }}" method="GET" id="search-form">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="name">
                            <label class="focus-label">Nama Pegawai</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="jenis_cuti" name="jenis_cuti">
                            <label class="focus-label">Jenis Cuti</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="status_pengajuan" name="status_pengajuan">
                            <label class="focus-label">Status Pengajuan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form>
            <!-- Search Filter -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>NIP</th>
                                        <th>Jenis Cuti</th>
                                        <th>Lama Cuti (Hari)</th>
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
                                        <td hidden class="id">{{ $result_cuti->id }}</td>
                                        <td class="name">{{ $result_cuti->name }}</td>
                                        <td class="nip">{{ $result_cuti->nip }}</td>
                                        <td class="jenis_cuti">{{ $result_cuti->jenis_cuti }}</td>
                                        <td class="lama_cuti">{{ $result_cuti->lama_cuti }}</td>
                                        <td class="tanggal_mulai_cuti">{{ $result_cuti->tanggal_mulai_cuti }}</td>
                                        <td class="tanggal_selesai_cuti">{{ $result_cuti->tanggal_selesai_cuti }}</td>
                                        <td class="dokumen_kelengkapan">
                                            <a href="{{ asset('assets/DokumenLayananCuti/' . $result_cuti->dokumen_kelengkapan) }}" target="_blank">
                                                @if (pathinfo($result_cuti->dokumen_kelengkapan, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_kelengkapan">{{ $result_cuti->dokumen_kelengkapan }}</td>
                                            </a></td>
                                        <td class="status_pengajuan">{{ $result_cuti->status_pengajuan }}</td>

                                        {{-- Edit Layanan Cuti--}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_layanan_cuti" href="#" data-toggle="modal" data-target="#edit_layanan_cuti"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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

                {{-- message --}}
            {!! Toastr::message() !!}
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
                                                    @foreach($data_profilcuti as $sqlcuti => $result_cuti)
                                                        <input type="hidden" class="form-control" name="name"  value="{{ $result_cuti->name }}">
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @foreach($data_profilcuti as $sqlcuti => $result_cuti)
                                                        <input type="hidden" class="form-control" name="nip" value="{{ $result_cuti->nip }}">
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
                </div>
                <!-- /Edit Layanan Cuti Modal -->
    </div>
    <!-- /Page Wrapper -->
    
    @section('script')
        <script src="{{ asset('assets/js/layanancuti.js') }}"></script>
    @endsection
@endsection
