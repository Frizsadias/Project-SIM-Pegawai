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
                        <h3 class="page-title">Riwayat Diklat</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Diklat</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_diklat"><i
                                class="fa fa-plus"></i> Tambah Riwayat Diklat</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="user_name" name="user_name">
                        <label class="focus-label">User Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_role">
                            <option selected disabled>-- Select Role Name --</option>
                            {{-- @foreach ($role_name as $name)
                                <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                            @endforeach --}}
                        </select>
                        <label class="focus-label">Role Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_status">
                            <option selected disabled> --Select --</option>
                            {{-- @foreach ($status_user as $status)
                                <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                            @endforeach --}}
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <button type="sumit" class="btn btn-success btn-block btn_search"> Search </button>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="jenis_diklat"><center>Jenis Diklat</center></th>
                                    <th class="nama_diklat">Nama Diklat</th>
                                    <th class="Institusi Penyelenggara">Institusi Penyelenggara</th>
                                    <th class="no_sertifikat">No Sertifikat</th>
                                    <th class="tanggal_mulai">Tanggal Mulai</th>
                                    <th class="tanggal_selesai">Tanggal Selesai</th>
                                    <th class="tahun_diklat">Tahun Diklat</th>
                                    <th class="durasi_jam">Durasi</th>
                                    <th class="dokumen_diklat">Dokumen Diklat</th>
                                    <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatDiklat as $sqldiklat => $result_diklat)
                                    <tr>
                                        <td><center>{{ ++$sqldiklat }}</center></td>
                                        <td hidden class="user_id"><center>{{ $result_diklat->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $result_diklat->id }}</center></td>
                                        <td class="jenis_diklat"><center>{{ $result_diklat->jenis_diklat }}</center></td>
                                        <td class="nama_diklat"><center>{{ $result_diklat->nama_diklat }}</center></td>
                                        <td class="institusi_penyelenggara"><center>{{ $result_diklat->institusi_penyelenggara }}</center></td>
                                        <td class="no_sertifikat"><center>{{ $result_diklat->no_sertifikat }}</center></td>
                                        <td class="tanggal_mulai"><center>{{ $result_diklat->tanggal_mulai }}</center></td>
                                        <td class="tanggal_selesai"><center>{{ $result_diklat->tanggal_selesai }}</center></td>
                                        <td class="tahun_diklat"><center>{{ $result_diklat->tahun_diklat }}</center></td>
                                        <td class="durasi_jam"><center>{{ $result_diklat->durasi_jam }}</center></td>
                                        <td class="dokumen_diklat">
                                            <center><a href="{{ asset('assets/DokumenDiklat/' . $result_diklat->dokumen_diklat) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_diklat" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_diklat"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_diklat" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_diklat"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        Delete</a>
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

        <!-- Tambah Riwayat Modal -->
        <div id="add_riwayat_diklat" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Diklat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/diklat/tambah-data') }}" method="POST"
                            enctype="multipart/form-data">
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
                                        <label>Jenis Diklat</label>
                                        <select class="form-control" name="jenis_diklat" required>
                                            <option selected disabled> --Pilih Jenis Diklat --</option>
                                            <option value="Diklat Struktural">Diklat Struktural</option>
                                            <option value="Diklat Fungsional">Diklat Fungsional</option>
                                            <option value="Diklat Teknis">Diklat Teknis</option>
                                            <option value="Workshop">Workshop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Diklat</label>
                                        <input class="form-control" type="text" name="nama_diklat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Institusi Penyelenggara</label>
                                        <input class="form-control" type="text" name="institusi_penyelenggara"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Sertifikat</label>
                                        <input class="form-control" type="text" name="no_sertifikat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input class="form-control" type="date" name="tanggal_mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input class="form-control" type="date" name="tanggal_selesai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Diklat</label>
                                        <input class="form-control" type="number" name="tahun_diklat" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Durasi (Jam)</label>
                                        <input class="form-control" type="number" name="durasi_jam" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Diklat</label>
                                        <input class="form-control" type="file" name="dokumen_diklat" required>
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Diklat Modal -->

        <!-- Edit Riwayat Diklat Modal -->
        <div id="edit_riwayat_diklat" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Diklat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/diklat/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Diklat</label>
                                        <select name="jenis_diklat" class="select" id="e_jenis_diklat">
                                            <option selected disabled> --Pilih Jenis Diklat --</option>
                                            <option>Diklat Struktural</option>
                                            <option>Diklat Fungsional</option>
                                            <option>Diklat Teknis</option>
                                            <option>Workshop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Diklat</label>
                                        <input type="text" class="form-control" name="nama_diklat" id="e_nama_diklat" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Institusi Penyelenggara</label>
                                        <input type="text" class="form-control" name="institusi_penyelenggara" id="e_institusi_penyelenggara" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Sertifikat</label>
                                        <input type="text" class="form-control" name="no_sertifikat" id="e_no_sertifikat" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" id="e_tanggal_mulai" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" class="form-control" name="tanggal_selesai" id="e_tanggal_selesai" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Diklat</label>
                                        <input type="number" class="form-control" name="tahun_diklat" id="e_tahun_diklat" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Durasi (Jam)</label>
                                        <input type="number" class="form-control" name="durasi_jam" id="e_durasi_jam" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Diklat</label>
                                        <input type="file" class="form-control" name="dokumen_diklat"
                                            id="dokumen_diklat">
                                        <input type="hidden" name="hidden_dokumen_diklat" id="e_dokumen_diklat" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Riwayat Diklat Modal -->

        <!-- Delete Riwayat Diklat Modal -->
        <div class="modal custom-modal fade" id="delete_riwayat_diklat" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Diklat</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/diklat/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_diklat" class="d_dokumen_diklat" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-primary continue-btn submit-btn">Hapus</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Riwayat Diklat Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_riwayat_diklat', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_nama_diklat').val(_this.find('.nama_diklat').text());
            $('#e_institusi_penyelenggara').val(_this.find('.institusi_penyelenggara').text());
            $('#e_no_sertifikat').val(_this.find('.no_sertifikat').text());
            $('#e_tanggal_mulai').val(_this.find('.tanggal_mulai').text());
            $('#e_tanggal_selesai').val(_this.find('.tanggal_selesai').text());
            $('#e_tahun_diklat').val(_this.find('.tahun_diklat').text());
            $('#e_durasi_jam').val(_this.find('.durasi_jam').text());
            $('#e_dokumen_diklat').val(_this.find('.dokumen_diklat').text());

            var jenis_diklat = (_this.find(".jenis_diklat").text());
            var _option = '<option selected value="' + jenis_diklat + '">' + _this.find('.jenis_diklat').text() +
                '</option>'
            $(_option).appendTo("#e_jenis_diklat");
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_riwayat_diklat', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_diklat').val(_this.find('.dokumen_diklat').text());
        });
    </script>
@endsection
@endsection
