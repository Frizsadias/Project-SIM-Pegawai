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
                        <h3 class="page-title">Riwayat Jabatan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Informasi Riwayat</a></li>
                            <li class="breadcrumb-item active">Riwayat Jabatan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_expense"><i
                                class="fa fa-plus"></i> Tambah Riwayat Jabatan</a>
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
                                    <th class="jenis_jabatan"> Jenis Jabatan</th>
                                    <th class="satuan_kerja">Satuan Kerja</th>
                                    <th class="satuan_kerja_induk">Satuan Kerja Induk</th>
                                    <th class="unit_organisasi">Unit Organisasi</th>
                                    <th class="no_sk">No SK</th>
                                    <th class="tanggal_sk">Tanggal SK</th>
                                    <th class="tmt_jabatan">TMT Jabatan</th>
                                    <th class="tmt_pelantikan">TMT Pelantikan</th>
                                    <th class="dokumen_sk_jabatan">Dokumen SK Jabatan</th>
                                    <th class="dokumen_pelantikan">Dokumen Pelantikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatJabatan as $sqljabatan => $result_jabatan)
                                    <tr>
                                        <td>{{ ++$sqljabatan }}</td>
                                        <td hidden class="id">{{ $result_jabatan->id }}</td>
                                        <td class="jenis_jabatan">{{ $result_jabatan->jenis_jabatan }}</td>
                                        <td class="satuan_kerja">{{ $result_jabatan->satuan_kerja }}</td>
                                        <td class="satuan_kerja_induk">{{ $result_jabatan->satuan_kerja_induk }}</td>
                                        <td class="unit_organisasi">{{ $result_jabatan->unit_organisasi }}</td>
                                        <td class="no_sk">{{ $result_jabatan->no_sk }}</td>
                                        <td class="tanggal_sk">{{ $result_jabatan->tanggal_sk }}</td>
                                        <td class="tmt_jabatan">{{ $result_jabatan->tmt_jabatan }}</td>
                                        <td class="tmt_pelantikan">{{ $result_jabatan->tmt_pelantikan }}</td>
                                        <td class="dokumen_sk_jabatan">{{ $result_jabatan->dokumen_sk_jabatan }}</td>
                                        <td class="dokumen_pelantikan">{{ $result_jabatan->dokumen_pelantikan }}</td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_jabatan" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_jabatan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_jabatan" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_jabatan"><i
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
        <div id="add_expense" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Jabatan
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/jabatan/tambah-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Jabatan</label>
                                        <select class="form-control" name="jenis_jabatan">
                                            <option selected disabled> --Pilih Jenis Jabatan --</option>
                                            <option value="jabatan_struktural">Jabatan Struktural</option>
                                            <option value="jabatan_fungsional_tertentu">Jabatan Fungsional Tertentu
                                            </option>
                                            <option value="jabatan_fungsional_umum">Jabatan Fungsional Umum</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja</label>
                                        <input class="form-control" type="text" name="satuan_kerja">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja Induk</label>
                                        <input class="form-control" type="text" name="satuan_kerja_induk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Organisasi</label>
                                        <input class="form-control" type="text" name="unit_organisasi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <input class="form-control" type="number" name="no_sk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input class="form-control" type="date" name="tanggal_sk">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Jabatan</label>
                                        <input class="form-control" type="date" name="tmt_jabatan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Pelantikan</label>
                                        <input class="form-control" type="date" name="tmt_pelantikan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Jabatan</label>
                                        <input class="form-control" type="file" name="dokumen_sk_jabatan">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Pelantikan</label>
                                        <input class="form-control" type="file" name="dokumen_pelantikan">
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
        <!-- /Add Jabatan Modal -->

        <!-- Edit Riwayat Jabatan Modal -->
        <div id="edit_riwayat_jabatan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Jabatan
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/jabatan/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Jabatan
                                        </label>
                                        <select class="select" name="jenis_jabatan" id="e_jenis_jabatan">
                                            <option>Jabatan Struktural</option>
                                            <option>Jabatan Fungsional Tertentu</option>
                                            <option>Jabatan Fungsional Umum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja</label>
                                        <input class="form-control" type="text" name="satuan_kerja"
                                            id="e_satuan_kerja" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja Induk</label>
                                        <input class="form-control" type="text" name="satuan_kerja_induk"
                                            id="e_satuan_kerja_induk" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Organisasi</label>
                                        <input class="form-control" type="text" name="unit_organisasi"
                                            id="e_unit_organisasi" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No SK</label>
                                        <input class="form-control" type="number" name="no_sk" id="e_no_sk"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input class="form-control" type="date" name="tanggal_sk" id="e_tanggal_sk"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Jabatan</label>
                                        <input class="form-control" type="date" name="tmt_jabatan" id="e_tmt_jabatan"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Pelantikan</label>
                                        <input class="form-control" type="date" name="tmt_pelantikan"
                                            id="e_tmt_pelantikan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Jabatan</label>
                                        <input class="form-control" type="file" id="dokumen_sk_jabatan"
                                            name="dokumen_sk_jabatan">
                                        <input type="hidden" name="hidden_dokumen_sk_jabatan" id="e_dokumen_sk_jabatan"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Pelantikan</label>
                                        <input class="form-control" type="file" id="dokumen_pelantikan"
                                            name="dokumen_pelantikan">
                                        <input type="hidden" name="hidden_dokumen_pelantikan" id="e_dokumen_pelantikan"
                                            value="">
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
        <!-- /Edit Riwayat Jabatan Modal -->

        <!-- Delete Riwayat Jabatan Modal -->
        <div class="modal custom-modal fade" id="delete_riwayat_jabatan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Jabatan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/jabatan/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_sk_jabatan" class="d_dokumen_sk_jabatan"
                                    value="">
                                <input type="hidden" name="dokumen_pelantikan" class="d_dokumen_pelantikan"
                                    value="">
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
        <!-- Delete Expense Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_riwayat_jabatan', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_satuan_kerja').val(_this.find('.satuan_kerja').text());
            $('#e_satuan_kerja_induk').val(_this.find('.satuan_kerja_induk').text());
            $('#e_unit_organisasi').val(_this.find('.unit_organisasi').text());
            $('#e_no_sk').val(_this.find('.no_sk').text());
            $('#e_tanggal_sk').val(_this.find('.tanggal_sk').text());
            $('#e_tmt_jabatan').val(_this.find('.tmt_jabatan').text());
            $('#e_tmt_pelantikan').val(_this.find('.tmt_pelantikan').text());
            $('#e_dokumen_sk_jabatan').val(_this.find('.dokumen_sk_jabatan').text());
            $('#e_dokumen_pelantikan').val(_this.find('.dokumen_pelantikan').text());

            var jenis_jabatan = (_this.find(".jenis_jabatan").text());
            var _option = '<option selected value="' + jenis_jabatan + '">' + _this.find('.jenis_jabatan').text() +
                '</option>'
            $(_option).appendTo("#e_jenis_jabatan");
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_riwayat_jabatan', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_sk_jabatan').val(_this.find('.dokumen_sk_jabatan').text());
            $('.d_dokumen_pelantikan').val(_this.find('.dokumen_pelantikan').text());
        });
    </script>
@endsection
@endsection
