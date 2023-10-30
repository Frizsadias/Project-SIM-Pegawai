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
                    <h3 class="page-title">Perjanjian Kontrak</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Perjanjian Kontrak</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_layanan_kontrak"><i
                            class="fa fa-plus"></i> Tambah Perjanjian Kontrak</a>
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
                                <th>NIK BLUD</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Pendidikan</th>
                                <th>Tahun Lulus</th>
                                <th>Jabatan</th>
                                <th>Tanggal Kontrak</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_perjanjian_kontrak as $sqlkontrak => $result_perjanjian_kontrak)
                                <tr>
                                    <td>{{ ++$sqlkontrak }}</td>
                                    <td hidden class="id">{{ $result_perjanjian_kontrak->id }}</td>
                                    <td class="name">{{ $result_perjanjian_kontrak->name }}</td>
                                    <td class="nip">{{ $result_perjanjian_kontrak->nip }}</td>
                                    <td class="nik_blud">{{ $result_perjanjian_kontrak->nik_blud }}</td>
                                    <td class="tempat_lahir">{{ $result_perjanjian_kontrak->tempat_lahir }}</td>
                                    <td class="tanggal_lahir">{{ $result_perjanjian_kontrak->tanggal_lahir }}</td>
                                    <td class="pendidikan">{{ $result_perjanjian_kontrak->pendidikan }}</td>
                                    <td class="tahun_lulus">{{ $result_perjanjian_kontrak->tahun_lulus }}</td>
                                    <td class="jabatan">{{ $result_perjanjian_kontrak->jabatan }}</td>
                                    <td class="tgl_kontrak">{{ $result_perjanjian_kontrak->tgl_kontrak }}</td>

                                    {{-- Edit Layanan KGB --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_kontrak" href="#" data-toggle="modal"
                                                    data-target="#edit_kontrak"><i class="fa fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item delete_perjanjian" href="#"
                                                    data-toggle="modal" data-target="#delete_perjanjian"><i
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

    <!-- Tambah Layanan Cuti Modal -->
    <div id="daftar_layanan_kontrak" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Perjanjian Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/perjanjian-kontrak/tambah-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Pegawai</label>
                                    <select class="select" id="name" name="name">
                                        <option value="">-- Pilih Nama Pegawai --</option>
                                        @foreach ($userList as $user)
                                            <option value="{{ $user->name }}" data-user_id="{{ $user->user_id }}"
                                                data-nip="{{ $user->nip }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">ID Pengguna <span
                                            class="text-danger">*</span></label>
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        placeholder="Tempat Lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        placeholder="Tempat Lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK BLUD</label>
                                    <input type="number" class="form-control" name="nik_blud"
                                        placeholder="NIK BLUD">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <input type="text" class="form-control" name="pendidikan"
                                        placeholder="Pendidikan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Lulus</label>
                                    <input type="number" class="form-control" name="tahun_lulus"
                                        placeholder="Tahun Lulus">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku Kontrak</label>
                                    <input type="date" class="form-control" name="tgl_kontrak">
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
    <div id="edit_kontrak" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Perjanjian Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/perjanjian-kontrak/edit-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="e_id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        id="e_tempat_lahir" placeholder="Tempat Lahir" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        id="e_tanggal_lahir" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK BLUD</label>
                                    <input type="text" class="form-control" name="nik_blud" id="e_nik_blud"
                                        placeholder="NIK BLUD" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <input type="text" class="form-control" name="pendidikan" id="e_pendidikan"
                                        placeholder="Pendidikan" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Lulus</label>
                                    <input type="text" class="form-control" name="tahun_lulus" id="e_tahun_lulus"
                                        placeholder="Tahun Lulus" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="e_jabatan"
                                        placeholder="Jabatan" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku Kontrak</label>
                                    <input type="date" class="form-control" name="tgl_kontrak" id="e_tgl_kontrak"
                                        value="">
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

    <!-- Delete Perjanjian Modal -->
    <div class="modal custom-modal fade" id="delete_perjanjian" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Hapus Perjanjian Kontrak</h3>
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('layanan/perjanjian-kontrak/delete') }}" method="POST">
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
    <!-- /Delete Perjanjian Modal -->
</div>
<!-- /Page Wrapper -->

@section('script')
    <script>
        $(document).on('click', '.edit_kontrak', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_tempat_lahir').val(_this.find('.tempat_lahir').text());
            $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
            $('#e_nik_blud').val(_this.find('.nik_blud').text());
            $('#e_pendidikan').val(_this.find('.pendidikan').text());
            $('#e_tahun_lulus').val(_this.find('.tahun_lulus').text());
            $('#e_jabatan').val(_this.find('.jabatan').text());
            $('#e_tgl_kontrak').val(_this.find('.tgl_kontrak').text());
        });
    </script>


    <script>
        $('#name').on('change', function() {
            $('#user_id').val($(this).find(':selected').data('user_id'));
            $('#nip').val($(this).find(':selected').data('nip'));
        });
    </script>
@endsection
@endsection
