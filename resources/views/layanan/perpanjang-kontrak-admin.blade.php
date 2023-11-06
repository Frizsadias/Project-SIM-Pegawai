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
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_layanan_kontrak"><i
                            class="fa fa-plus"></i> Tambah Perpanjangan Kontrak</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Cetak Dokumen Perpanjangan PDF -->
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <select id="pilihDokumenPerpanjangan" class="form-control">
                    <option selected disabled> --Pilih Dokumen Perpanjangan --</option>
                    @foreach ($data_perpanjang_pdf as $kontrak)
                        <option value="{{ $kontrak->id }}">Dokumen Perpanjangan - {{ $kontrak->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <button id="cetakDokumenPerpanjangan" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i>
                    Dokumen Perpanjangan</button>
            </div>
        </div><br>

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
                                <th>Mulai Kontrak</th>
                                <th>Akhir Kontrak</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_perpanjang_kontrak as $sqlkontrak => $result_kontrak)
                                <tr>
                                    <td>{{ ++$sqlkontrak }}</td>
                                    <td hidden class="id">{{ $result_kontrak->id }}</td>
                                    <td class="name">{{ $result_kontrak->name }}</td>
                                    <td class="nip">{{ $result_kontrak->nip }}</td>
                                    <td class="nik_blud">{{ $result_kontrak->nik_blud }}</td>
                                    <td class="tempat_lahir">{{ $result_kontrak->tempat_lahir }}</td>
                                    <td class="tanggal_lahir">{{ $result_kontrak->tanggal_lahir }}</td>
                                    <td class="pendidikan">{{ $result_kontrak->pendidikan }}</td>
                                    <td class="tahun_lulus">{{ $result_kontrak->tahun_lulus }}</td>
                                    <td class="jabatan">{{ $result_kontrak->jabatan }}</td>
                                    <td class="mulai_kontrak">{{ $result_kontrak->mulai_kontrak }}</td>
                                    <td class="akhir_kontrak">{{ $result_kontrak->akhir_kontrak }}</td>

                                    {{-- Edit Layanan KGB --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_kontrak" href="#" data-toggle="modal"
                                                    data-target="#edit_kontrak"><i class="fa fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item delete_kontrak" href="#"
                                                    data-toggle="modal" data-target="#delete_kontrak"><i
                                                        class="fa fa-trash-o m-r-5"></i>Delete</a>
                                                <a href="{{ route('layanan-perpanjang-kontrak-admin', ['id' => $result_kontrak->id]) }}"
                                                    target="_blank" class="dropdown-item cetak-kinerja">
                                                    <i class="fa fa-print m-r-5"></i>Cetak
                                                </a>
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
                    <h5 class="modal-title">Tambah Perpanjangan Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/kontrak/tambah-data') }}" method="POST"
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
                                                data-nip="{{ $user->nip }}"
                                                data-tempat_lahir="{{ $user->tempat_lahir }}"
                                                data-tanggal_lahir="{{ $user->tanggal_lahir }}"
                                                data-tingkat_pendidikan="{{ $user->tingkat_pendidikan }}"
                                                data-jabatan="{{ $user->jabatan }}">{{ $user->name }}</option>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Tempat Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        placeholder="Tempat lahir otomatis terisi" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tanggal_lahir"
                                        name="tanggal_lahir" placeholder="Tanggal lahir otomatis terisi" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Pendidikan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tingkat_pendidikan"
                                        name="pendidikan" placeholder="Pendidikan otomatis terisi" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        placeholder="Jabatan otomatis terisi" readonly>
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
                                    <label>Tahun Lulus</label>
                                    <input type="number" class="form-control" name="tahun_lulus"
                                        placeholder="Tahun Lulus">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mulai Kontrak</label>
                                    <input type="date" class="form-control" name="mulai_kontrak">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Akhir Kontrak</label>
                                    <input type="date" class="form-control" name="akhir_kontrak">
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
                    <h5 class="modal-title">Edit Perpanjangan Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/kontrak/edit-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="e_id" value="">
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
                                    <label>Tahun Lulus</label>
                                    <input type="text" class="form-control" name="tahun_lulus" id="e_tahun_lulus"
                                        placeholder="Tahun Lulus" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mulai Kontrak</label>
                                    <input type="date" class="form-control" name="mulai_kontrak"
                                        id="e_mulai_kontrak" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Akhir Kontrak</label>
                                    <input type="date" class="form-control" name="akhir_kontrak"
                                        id="e_akhir_kontrak" value="">
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
    <div class="modal custom-modal fade" id="delete_kontrak" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Hapus Perpanjangan Kontrak</h3>
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('layanan/perpanjangan-kontrak/hapus-data') }}" method="POST">
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
</div>
<!-- /Page Wrapper -->

@section('script')
    <script src="{{ asset('assets/js/perpanjangankontrak.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#pilihDokumenPerpanjangan').select2();
            $('#cetakDokumenPerpanjangan').on('click', function() {
                const selectedCutiId = $('#pilihDokumenPerpanjangan').val();
                if (selectedCutiId) {
                    const url = "{{ route('layanan-perpanjang-kontrak-admin', ['id' => ':id']) }}".replace(
                        ':id', selectedCutiId);
                    window.open(url, '_blank');
                }
            });
        });
    </script>

    <script>
        $(document).on("click", ".delete_kontrak", function() {
            var _this = $(this).parents("tr");
            $(".e_id").val(_this.find(".id").text());
        });
    </script>
@endsection
@endsection
