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
                    <h3 class="page-title">Surat Tanda Registrasi</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Surat Tanda Registrasi</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_str"><i
                            class="fa fa-plus"></i> Tambah Surat Tanda Registrasi</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

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
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Nomor Registrasi</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor Ijazah</th>
                                <th>Tanggal Lulus</th>
                                <th>Perguruan Tinggi</th>
                                <th>Kompetensi</th>
                                <th>No. Sertifikat Kompetensi</th>
                                <th>Tanggal Berlaku STR</th>
                                <th>Dokumen STR</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_str as $sqlstr => $result_str)
                                <tr>
                                    <td>{{ ++$sqlstr }}</td>
                                    <td hidden class="id">{{ $result_str->id }}</td>
                                    <td class="nip">{{ $result_str->nip }}</td>
                                    <td class="name">{{ $result_str->name }}</td>
                                    <td class="nomor_reg">{{ $result_str->nomor_reg }}</td>
                                    <td class="tempat_lahir">{{ $result_str->tempat_lahir }}</td>
                                    <td class="tanggal_lahir">{{ $result_str->tanggal_lahir }}</td>
                                    <td class="jenis_kelamin">{{ $result_str->jenis_kelamin }}</td>
                                    <td class="nomor_ijazah">{{ $result_str->nomor_ijazah }}</td>
                                    <td class="tanggal_lulus">{{ $result_str->tanggal_lulus }}</td>
                                    <td class="pendidikan_terakhir">{{ $result_str->pendidikan_terakhir }}</td>
                                    <td class="kompetensi">{{ $result_str->kompetensi }}</td>
                                    <td class="no_sertifikat_kompetensi">{{ $result_str->no_sertifikat_kompetensi }}
                                    </td>
                                    <td class="tgl_berlaku_str">{{ $result_str->tgl_berlaku_str }}</td>
                                    <td class="dokumen_str">
                                        <center>
                                            <a href="{{ asset('assets/DokumenSTR/' . $result_str->dokumen_str) }}"
                                                target="_blank">
                                                @if (pathinfo($result_str->dokumen_str, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;"
                                                        aria-hidden="true"></i>
                                                @endif
                                    <td hidden class="dokumen_str">{{ $result_str->dokumen_str }}</td>
                                    </a></center>
                                    </td>

                                    {{-- Edit Layanan KGB --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_str" href="#" data-toggle="modal"
                                                    data-target="#edit_str"><i class="fa fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item delete_str" href="#" data-toggle="modal"
                                                    data-target="#delete_str"><i
                                                        class="fa fa-trash-o m-r-5"></i>Delete</a>
                                                {{-- <a class="dropdown-item cetak_perjanjian" href="#"
                                                    data-id="{{ $perjanjian->id }}" data-toggle="modal"
                                                    data-target="#cetak-perjanjian">
                                                    <i class="fa fa-print m-r-5"></i>Cetak
                                                </a> --}}
                                                {{-- <a href="{{ route('cetak-perjanjian-kontrak') }}" target="_blank">Cetak Perjanjian</a> --}}
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

    <!-- Tambah Surat Tanda Perjanjian Kontrak Modal -->
    <div id="daftar_str" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Surat Tanda Perjanjian Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/surat-tanda-registrasi/tambah-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Registrasi</label>
                                    <input type="text" class="form-control" name="nomor_reg"
                                        placeholder="Nomor Registrasi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lulus</label>
                                    <input type="date" class="form-control" name="tanggal_lulus">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kompetensi</label>
                                    <input type="text" class="form-control" name="kompetensi"
                                        placeholder="Kompetensi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Sertifikat Kompetensi</label>
                                    <input type="text" class="form-control" name="no_sertifikat_kompetensi"
                                        placeholder="Nomor Sertifikat Kompetensi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Ijazah</label>
                                    <input type="text" class="form-control" name="nomor_ijazah"
                                        placeholder="Nomor Ijazah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku STR</label>
                                    <input type="date" class="form-control" name="tgl_berlaku_str">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokumen STR</label>
                                    <input type="file" class="form-control" name="dokumen_str">
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                            </div>
                        </div>
                        @foreach ($data_profil_str as $profil_pegawai)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="tempat_lahir"
                                            value="{{ $profil_pegawai->tempat_lahir }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="tanggal_lahir"
                                            value="{{ $profil_pegawai->tanggal_lahir }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="jenis_kelamin"
                                            value="{{ $profil_pegawai->jenis_kelamin }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="pendidikan_terakhir"
                                            value="{{ $profil_pegawai->pendidikan_terakhir }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="name"
                                            value="{{ $profil_pegawai->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="nip"
                                            value="{{ $profil_pegawai->nip }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Tambah Surat Tanda Perjanjian Kontrak Modal -->

    <!-- Edit Surat Tanda Perjanjian Kontrak Modal -->
    <div id="edit_str" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Surat Tanda Perjanjian Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/surat-tanda-registrasi/edit-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="e_id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Registrasi</label>
                                    <input type="text" class="form-control" name="nomor_reg" id="e_nomor_reg"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lulus</label>
                                    <input type="date" class="form-control" name="tanggal_lulus"
                                        id="e_tanggal_lulus" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kompetensi</label>
                                    <input type="text" class="form-control" name="kompetensi" id="e_kompetensi"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Sertifikat Kompetensi</label>
                                    <input type="text" class="form-control" name="no_sertifikat_kompetensi"
                                        id="e_no_sertifikat_kompetensi" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Ijazah</label>
                                    <input type="text" class="form-control" name="nomor_ijazah"
                                        id="e_nomor_ijazah" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku STR</label>
                                    <input type="date" class="form-control" name="tgl_berlaku_str"
                                        id="e_tgl_berlaku_str" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokumen STR</label>
                                    <input type="file" class="form-control" name="dokumen_str">
                                    <input type="hidden" name="hidden_dokumen_str" id="e_dokumen_str"
                                        value="">
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Layanan Cuti Modal -->

    <!-- Delete Perjanjian Modal -->
    <div class="modal custom-modal fade" id="delete_str" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Hapus Surat Tanda Perjanjian</h3>
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('layanan/surat-tanda-registrasi/hapus-data') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" class="e_id" value="">
                        <input type="hidden" name="dokumen_str" class="d_dokumen_str" value="">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn submit-btn">Hapus</button>
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
</div>
<!-- /Page Wrapper -->

@section('script')
    <script>
        $(document).on('click', '.edit_str', function() {
            var _this = $(this).closest('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_tempat_lahir').val(_this.find('.tempat_lahir').text());
            $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
            $('#e_jenis_kelamin').val(_this.find('.jenis_kelamin').text());
            $('#e_pendidikan_terakhir').val(_this.find('.pendidikan_terakhir').text());
            $('#e_nomor_reg').val(_this.find('.nomor_reg').text());
            $('#e_tanggal_lulus').val(_this.find('.tanggal_lulus').text());
            $('#e_kompetensi').val(_this.find('.kompetensi').text());
            $('#e_no_sertifikat_kompetensi').val(_this.find('.no_sertifikat_kompetensi').text());
            $('#e_nomor_ijazah').val(_this.find('.nomor_ijazah').text());
            $('#e_tgl_berlaku_str').val(_this.find('.tgl_berlaku_str').text());
            $('#e_dokumen_str').val(_this.find('.dokumen_str').text());
        });

        $(document).on('click', '.delete_str', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_str').val(_this.find('.dokumen_str').text());
        });
    </script>
@endsection
@endsection
