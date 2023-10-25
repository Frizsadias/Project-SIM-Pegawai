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
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_spk_dokter"><i class="fa fa-plus"></i> Tambah SPK Dokter</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <!-- Form untuk filter data, jika diperlukan -->
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
                                <th>Dokumen SIP</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_spk_nakes_lain as $sqlspk_nakes => $result_spk_nakes)
                                <tr>
                                    <td>{{ ++$sqlspk_nakes }}</td>
                                    <td hidden class="id">{{ $result_spk_nakes->id }}</td>
                                    <td class="name">{{ $result_spk_nakes->name }}</td>
                                    <td class="nip">{{ $result_spk_nakes->nip }}</td>
                                    <td class="unit_kerja">{{ $result_spk_nakes->unit_kerja }}</td>
                                    <td class="nomor_sip">{{ $result_spk_nakes->nomor_sip }}</td>
                                    <td class="tanggal_terbit">{{ $result_spk_nakes->tanggal_terbit }}</td>
                                    <td class="tanggal_berlaku">{{ $result_spk_nakes->tanggal_berlaku }}</td>
                                    <td class="ruangan">{{ $result_spk_nakes->ruangan }}</td>
                                    <td class="dokumen_sip">
                                        <a href="{{ asset('assets/DokumenSPKNakesLain/' . $result_spk_nakes->dokumen_sip) }}" target="_blank">
                                            @if (pathinfo($result_spk_nakes->dokumen_sip, PATHINFO_EXTENSION) == 'pdf')
                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                            @endif
                                    <td hidden class="dokumen_sip">{{ $result_spk_nakes->dokumen_sip }}</td>
                                    </a></td>
                                    </td>

                                    {{-- Edit Layanan SIP Dokter --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_spk_dokter" href="#" data-toggle="modal" data-target="#edit_spk_dokter"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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

    <!-- Tambah Layanan SPK Dokter Modal -->
    <div id="daftar_spk_dokter" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah SPK Nakes Lain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transaksi/spk-nakes-lain/tambah-data') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                    @foreach ($data_profil_sip as $result_profil_sip)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{ $result_profil_sip->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nip" value="{{ $result_profil_sip->nip }}" readonly>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="sip_spk_jabatan" value="Nakes Lain" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Unit Kerja</label>
                                <input type="text" class="form-control" name="unit_kerja" placeholder="Unit Kerja">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor SPK</label>
                                <input type="text" class="form-control" name="nomor_sip" placeholder="Nomor SPK">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Terbit</label>
                                <input type="date" class="form-control" name="tanggal_terbit">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Berlaku</label>
                                <input type="date" class="form-control" name="tanggal_berlaku">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Dokumen</label>
                                <input type="text" class="form-control" name="jenis_dokumen" value="SPK Nakes Lain" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- /Tambah SIP Dokter Modal -->

    <!-- Edit SIP Dokter Modal -->
    <div id="edit_spk_dokter" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit SPK Nakes Lain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi/spk-nakes-lain/edit-data') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="e_id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit Kerja</label>
                                    <input type="text" class="form-control" name="unit_kerja" id="e_unit_kerja" placeholder="Unit Kerja">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor SPK</label>
                                    <input type="text" class="form-control" name="nomor_sip" id="e_nomor_sip" placeholder="Nomor SIP">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Terbit</label>
                                    <input type="date" class="form-control" name="tanggal_terbit" id="e_tanggal_terbit" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku</label>
                                    <input type="date" class="form-control" name="tanggal_berlaku" id="e_tanggal_berlaku" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokumen SPK</label>
                                    <input type="file" class="form-control" id="dokumen_sip" name="dokumen_sip">
                                    <input type="hidden" name="hidden_dokumen_sip" id="e_dokumen_sip" value="">
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
    <script>
        $(document).on('click', '.edit_spk_dokter', function()
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
    </script>
@endsection
@endsection
