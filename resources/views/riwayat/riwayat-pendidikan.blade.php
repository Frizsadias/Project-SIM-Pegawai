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
                        <h3 class="page-title">Riwayat Pendidikan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Informasi Riwayat</a></li>
                            <li class="breadcrumb-item active">Riwayat Pendidikan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_pendidikan"><i
                                class="fa fa-plus"></i> Tambah Riwayat Pendidikan</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="user_name" name="user_name">
                        <label class="focus-label">Nama Sekolah</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_role">
                            <option selected disabled>-- Pilih Tingkat Pendidikan --</option>
                            {{-- @foreach ($role_name as $name)
                                <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                            @endforeach --}}
                        </select>
                        <label class="focus-label">Tingkat Pendidikan</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_status">
                            <option selected disabled> --Pilih Jenis Pendidikan --</option>
                            {{-- @foreach ($status_user as $status)
                            <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                            @endforeach --}}
                        </select>
                        <label class="focus-label">Jenis Pendidikan</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <button type="sumit" class="btn btn-success btn-block btn_search"> Cari </button>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                    <th>No</th>
                                    <th class="tingkat_pendidikan">Tingkat Pendidikan</th>
                                    <th class="pendidikan">Pendidikan</th>
                                    <th class="tahun_lulus">Tahun Lulus</th>
                                    <th class="no_ijazah">Nomor Ijazah</th>
                                    <th class="nama_sekolah">Nama Sekolah</th>
                                    <th class="gelar_depan">Gelar Depan</th>
                                    <th class="gelar_belakang">Gelar Belakang</th>
                                    <th class="jenis_pendidikan">Jenis Pendidikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPendidikan as $sqlpendidikan => $result_pendidikan)
                                <tr>
                                    <td>{{ ++$sqlpendidikan }}</td>
                                    <td hidden class="id">{{ $result_pendidikan->id }}</td>
                                    <td class="tingkat_pendidikan">{{ $result_pendidikan->tingkat_pendidikan }}</td>
                                    <td class="pendidikan">{{ $result_pendidikan->pendidikan }}</td>
                                    <td class="tahun_lulus">{{ $result_pendidikan->tahun_lulus }}</td>
                                    <td class="no_ijazah">{{ $result_pendidikan->no_ijazah }}</td>
                                    <td class="nama_sekolah">{{ $result_pendidikan->nama_sekolah }}</td>
                                    <td class="gelar_depan">{{ $result_pendidikan->gelar_depan }}</td>
                                    <td class="gelar_belakang">{{ $result_pendidikan->gelar_belakang }}</td>
                                    <td class="jenis_pendidikan">{{ $result_pendidikan->jenis_pendidikan }}</td>
                                    <td hidden class="dokumen">{{ $result_pendidikan->dokumen }}</td>
                                @endforeach
                            </tbody>
                            <!-- Contoh Function Edit & Delete
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_expense" href="#" data-toggle="modal"
                                                        data-target="#edit_riwayat_pendidikan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_expense" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_pendidikan"><i
                                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>-->
                        </table>
                    </div>
                </div>
            </div>

            {{-- message --}}
            {!! Toastr::message() !!}
        </div>
        <!-- /Page Content -->

        <!-- Tambah Riwayat Modal -->
        <div id="add_riwayat_pendidikan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Pendidikan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pendidikan.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tingkat_pendidikan">Tingkat Pendidikan</label>
                                        <select class="form-control" name="tingkat_pendidikan" id="tingkat_pendidikan">
                                            <option selected disabled> --Pilih Tingkat Pendidikan --</option>
                                            <option value="SLTP">SLTP</option>
                                            <option value="SLTA">SLTA</option>
                                            <option value="Diploma I">Diploma I</option>
                                            <option value="Diploma II">Diploma II</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <input class="form-control" type="text" name="pendidikan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input class="form-control" type="text" name="tahun_lulus">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Ijazah</label>
                                        <input class="form-control" type="text" name="no_ijazah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input class="form-control" type="text" name="nama_sekolah">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Depan</label>
                                        <input class="form-control" type="text" name="gelar_depan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input class="form-control" type="text" name="gelar_belakang">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan</label>
                                        <br>
                                        <input type="checkbox" name="jenis_pendidikan" value="pendidikan_pertama">
                                        Pendidikan Pertama
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Transkrip Nilai</label>
                                        <input class="form-control" type="file" name="dokumen">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Ijazah</label>
                                        <input class="form-control" type="file" name="dokumen">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dokumen">Dokumen Pencantuman Gelar </label>
                                        <input class="form-control" type="file" name="dokumen" id="dokumen">
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
        <!-- /Add Expense Modal -->

        <!-- Edit Riwayat Pendidikan Modal -->
        <div id="edit_expense" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Pendidikan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('expenses/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan</label>
                                        <input class="form-control" type="text" name="tingkat_pendidikan"
                                            id="e_tingkat_pendidikan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <input class="form-control" type="text" name="pendidikan" id="e_pendidikan"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <div class="cal-icon">
                                            <input class="form-control" type="text" name="tahun_lulus"
                                                id="e_tahun_lulus" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Ijazah</label>
                                        <input class="form-control" type="text" name="no_ijazah" id="e_no_ijazah"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input class="form-control" type="text" name="nama_sekolah"
                                            id="e_nama_sekolah" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Depan</label>
                                        <input class="form-control" type="text" name="gelar_depan" id="e_gelar_depan"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input class="form-control" type="text" name="gelar_belakang"
                                            id="e_gelar_belakang" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan</label>
                                        <input class="form-control" type="text" name="jenis_pendidikan"
                                            id="e_jenis_pendidikan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen</label>
                                        <input class="form-control" type="file" id="dokumen" name="dokumen">
                                        <input type="hidden" name="hidden_dokumen" id="e_dokumen" value="">
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
        <!-- /Edit Expense Modal -->

        <!-- Delete Expense Modal -->
        <div class="modal custom-modal fade" id="delete_expense" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Riwayat Pendidikan</h3>
                            <p>Apakah anda yakin ingin menghapus?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('expenses/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="attachments" class="d_attachments" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Cancel</a>
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
        $(document).on('click', '.edit_expense', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_item_name').val(_this.find('.item_name').text());
            $('#e_purchase_from').val(_this.find('.purchase_from').text());
            $('#e_purchase_date').val(_this.find('.purchase_date').text());
            $('#e_amount').val(_this.find('.amount').text());
            $('#e_attachments').val(_this.find('.attachments').text());

            var purchased_by = (_this.find(".purchased_by").text());
            var _option = '<option selected value="' + purchased_by + '">' + _this.find('.purchased_by').text() +
                '</option>'
            $(_option).appendTo("#e_purchased_by");

            var paid_by = (_this.find(".paid_by").text());
            var _option = '<option selected value="' + paid_by + '">' + _this.find('.paid_by').text() + '</option>'
            $(_option).appendTo("#e_paid_by");

            var status = (_this.find(".status").text());
            var _option = '<option selected value="' + status + '">' + _this.find('.status').text() + '</option>'
            $(_option).appendTo("#e_status");
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_expense', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_attachments').val(_this.find('.attachments').text());
        });
    </script>
@endsection
@endsection
