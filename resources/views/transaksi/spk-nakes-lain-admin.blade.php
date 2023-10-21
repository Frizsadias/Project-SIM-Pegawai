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
                    <h3 class="page-title">SPK Nakes Lain</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">SPK Nakes Lain</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_spk_nakeslain"><i
                            class="fa fa-plus"></i> Tambah SPK Nakes Lain</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        {{-- Export Excel --}}
        <form action="{{ route('export-spk-nakes-lain') }}" method="GET">
            <button type="submit" name="export" value="true" class="btn btn-success">
                <i class="fa fa-file-excel"></i> Export Excel
            </button>
        </form>

        <!-- Search Filter -->
        {{-- <form action="{{ route('layanan/cuti/cari/admin') }}" method="GET" id="search-form">
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
                                <input type="text" class="form-control floating" name="status_pengajuan">
                                <label class="focus-label">Status Pengajuan</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                        </div>
                    </div>
                </form> --}}
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
                                <th>Unit Kerja</th>
                                <th>Nomor SPK</th>
                                <th>Tanggal Terbit</th>
                                <th>Tanggal Berlaku</th>
                                <th>Ruangan</th>
                                <th>Dokumen SPK</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_spk_nakeslain as $sql_spk_nakeslain => $result_spk_nakeslain)
                                <tr>
                                    <td>{{ ++$sql_spk_nakeslain }}</td>
                                    <td hidden class="id">{{ $result_spk_nakeslain->id }}</td>
                                    <td class="name">{{ $result_spk_nakeslain->name }}</td>
                                    <td class="nip">{{ $result_spk_nakeslain->nip }}</td>
                                    <td class="unit_kerja">{{ $result_spk_nakeslain->unit_kerja }}</td>
                                    <td class="nomor_sip">{{ $result_spk_nakeslain->nomor_sip }}</td>
                                    <td class="tanggal_terbit">{{ $result_spk_nakeslain->tanggal_terbit }}</td>
                                    <td class="tanggal_berlaku">{{ $result_spk_nakeslain->tanggal_berlaku }}</td>
                                    <td class="ruangan">{{ $result_spk_nakeslain->ruangan }}</td>
                                    <td class="dokumen_sip">
                                        <a href="{{ asset('assets/DokumenSPKNakesLain/' . $result_spk_nakeslain->dokumen_sip) }}"
                                            target="_blank">
                                            @if (pathinfo($result_spk_nakeslain->dokumen_sip, PATHINFO_EXTENSION) == 'pdf')
                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;"
                                                    aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;"
                                                    aria-hidden="true"></i>
                                            @endif
                                    <td hidden class="dokumen_sip">{{ $result_spk_nakeslain->dokumen_sip }}</td>
                                    </a></td>
                                    </td>

                                    {{-- Edit Layanan SPK Nakes Lain --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_spk_nekes_lain" href="#"
                                                    data-toggle="modal" data-target="#edit_spk_nekes_lain"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item delete_spk_nakes_lain" href="#" data-toggle="modal"
                                                        data-target="#delete_spk_nakes_lain"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>
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
    </div>
    <!-- /Page Content -->

    <!-- Tambah Layanan SIP Dokter Modal -->
    <div id="daftar_spk_nakeslain" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah SPK Nakes Lain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi/spk-nakes-lain/tambah-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Pegawai</label>
                                    <select class="select" id="name" name="name">
                                        <option value="">-- Pilih Nama Pegawai --</option>
                                        @foreach ($userList as $key => $user)
                                            <option value="{{ $user->name }}" data-user_id={{ $user->user_id }}
                                                data-nip={{ $user->nip }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">ID Pengguna <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_id" name="user_id"
                                        placeholder="ID pengguna otomatis terisi" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">NIP <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="nip" name="nip"
                                        placeholder="NIP otomatis terisi" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" name="sip_spk_jabatan" value="Nakes Lain" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit Kerja</label>
                                    <input type="text" class="form-control" name="unit_kerja"
                                        placeholder="Unit Kerja">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor SPK</label>
                                    <input type="text" class="form-control" name="nomor_sip"
                                        placeholder="Nomor SIP">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Terbit</label>
                                    <input type="date" class="form-control" name="tanggal_terbit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku</label>
                                    <input type="date" class="form-control" name="tanggal_berlaku">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Dokumen</label>
                                    <input type="text" class="form-control" name="jenis_dokumen" value="SPK Nakes Lain" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokumen SPK</label>
                                    <input type="file" class="form-control" name="dokumen_sip">
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select class="form-control" name="ruangan">
                                        <option value="">-- Pilih Ruangan --</option>
                                        @foreach($ruanganOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
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
    </div>
    <!-- /Tambah SIP Dokter Modal -->

    <!-- Edit SIP Dokter Modal -->
    <div id="edit_spk_nekes_lain" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit SPK Nakes Lain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi/spk-nakes-lain/edit-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="e_id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit Kerja</label>
                                    <input type="text" class="form-control" name="unit_kerja" id="e_unit_kerja"
                                        placeholder="Unit Kerja" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor SPK</label>
                                    <input type="text" class="form-control" name="nomor_sip" id="e_nomor_sip"
                                        placeholder="Nomor SIP" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Terbit</label>
                                    <input type="date" class="form-control" name="tanggal_terbit"
                                        id="e_tanggal_terbit" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku</label>
                                    <input type="date" class="form-control" name="tanggal_berlaku"
                                        id="e_tanggal_berlaku" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokumen SPK</label>
                                    <input type="file" class="form-control" id="dokumen_sip" name="dokumen_sip">
                                    <input type="hidden" name="hidden_dokumen_sip" id="e_dokumen_sip"
                                        value="">
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

    <!-- Delete SPK Nakes Lain Modal -->
        <div class="modal custom-modal fade" id="delete_spk_nakes_lain" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus SPK Nakes Lain</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('transaksi/spk-nakes-lain/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-primary continue-btn submit-btn">Hapus</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete SPK Nakes Lain Modal -->
</div>
<!-- /Page Wrapper -->

@section('script')
<script>
    //Edit SPK Nakes Lain
    $(document).on('click', '.edit_spk_nekes_lain', function()
    {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_unit_kerja').val(_this.find('.unit_kerja').text());
    $('#e_nomor_sip').val(_this.find('.nomor_sip').text());
    $('#e_tanggal_terbit').val(_this.find('.tanggal_terbit').text());
    $('#e_tanggal_berlaku').val(_this.find('.tanggal_berlaku').text());
    $('#e_dokumen_sip').val(_this.find('.dokumen_sip').text());
    });

    $('#name').on('change',function()
    {
    $('#user_id').val($(this).find(':selected').data('user_id'));
    $('#nip').val($(this).find(':selected').data('nip'));
    });

    // Hapus SPK Nakes Lain
    $(document).on('click', '.delete_spk_nakes_lain', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>
@endsection
@endsection
