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
                        <h3 class="page-title">Riwayat Golongan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Informasi Riwayat</a></li>
                            <li class="breadcrumb-item active">Riwayat Golongan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_expense"><i
                                class="fa fa-plus"></i> Tambah Riwayat Golongan</a>
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
                                    <th class="golongan">Golongan</th>
                                    <th class="jenis_kenaikan_pangkat">Jenis Kenaikan Pangkat (KP)</th>
                                    <th class="jenis_kerja_golongan_tahun">Masa Kerja Golongan (Tahun)</th>
                                    <th class="jenis_kerja_golongan_bulan">Masa Kerja Golongan (Bulan)</th>
                                    <th class="tmt_golongan">TMT Golongan</th>
                                    <th class="no_teknis_bkn">No Teknis BKN</th>
                                    <th class="tanggal_teknis_bkn">Tanggal Teknis BKN</th>
                                    <th class="no_sk">No SK</th>
                                    <th class="tanggal_sk">Tanggal SK</th>
                                    <th class="dokumen_skkp">Dokumen SK KP</th>
                                    <th class="dokumen_teknis_kp">Dokumen Teknis KP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatGolongan as $sqlgolongan => $result_golongan)
                                    <tr>
                                        <td>{{ ++$sqlgolongan }}</td>
                                        <td hidden class="id">{{ $result_golongan->id }}</td>
                                        <td class="golongan">{{ $result_golongan->golongan }}</td>
                                        <td class="jenis_kenaikan_pangkat">{{ $result_golongan->jenis_kenaikan_pangkat }}
                                        </td>
                                        <td class="masa_kerja_golongan_tahun">
                                            {{ $result_golongan->masa_kerja_golongan_tahun }}</td>
                                        <td class="masa_kerja_golongan_bulan">
                                            {{ $result_golongan->masa_kerja_golongan_bulan }}</td>
                                        <td class="tmt_golongan">{{ $result_golongan->tmt_golongan }}</td>
                                        <td class="no_teknis_bkn">{{ $result_golongan->no_teknis_bkn }}</td>
                                        <td class="tanggal_teknis_bkn">{{ $result_golongan->tanggal_teknis_bkn }}</td>
                                        <td class="no_sk">{{ $result_golongan->no_sk }}</td>
                                        <td class="tanggal_sk">{{ $result_golongan->tanggal_sk }}</td>
                                        <td class="dokumen_skkp">{{ $result_golongan->dokumen_skkp }}</td>
                                        <td class="dokumen_teknis_kp">{{ $result_golongan->dokumen_teknis_kp }}</td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_golongan" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_golongan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_golongan" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_golongan"><i
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
                        <h5 class="modal-title">Tambah Riwayat Golongan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/golongan/tambah-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <input class="form-control" type="text" name="golongan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kenaikan Pangkat (KP)</label>
                                        <input class="form-control" type="text" name="jenis_kenaikan_pangkat">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja Golongan (Tahun)</label>
                                        <input class="form-control" type="text" name="masa_kerja_golongan_tahun">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja Golongan (Bulan)</label>
                                        <input class="form-control" type="text" name="masa_kerja_golongan_bulan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Golongan</label>
                                        <input class="form-control" type="date" name="tmt_golongan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Pertimbangan Teknis BKN</label>
                                        <input class="form-control" type="number" name="no_teknis_bkn">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Pertimbangan Teknis BKN</label>
                                        <input class="form-control" type="date" name="tanggal_teknis_bkn">
                                    </div>
                                </div>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK KP</label>
                                        <input class="form-control" type="file" name="dokumen_skkp">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Pertimbangan Teknis KP</label>
                                        <input class="form-control" type="file" name="dokumen_teknis_kp">
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

        <!-- Edit Riwayat Golongan Modal -->
        <div id="edit_riwayat_golongan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Golongan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/golongan/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <input class="form-control" type="text" name="golongan" id="e_golongan"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kenaikan Pangkat</label>
                                        <input class="form-control" type="text" name="jenis_kenaikan_pangkat"
                                            id="e_jenis_kenaikan_pangkat" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja Golongan (Tahun)</label>
                                        <input class="form-control" type="text" name="masa_kerja_golongan_tahun"
                                            id="e_masa_kerja_golongan_tahun" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja golongan (Bulan)</label>
                                        <input class="form-control" type="text" name="masa_kerja_golongan_bulan"
                                            id="e_masa_kerja_golongan_bulan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Golongan</label>
                                        <input class="form-control" type="date" name="tmt_golongan"
                                            id="e_tmt_golongan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Teknis BKN</label>
                                        <input class="form-control" type="number" name="no_teknis_bkn"
                                            id="e_no_teknis_bkn" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Teknis BKN</label>
                                        <input class="form-control" type="date" name="tanggal_teknis_bkn"
                                            id="e_tanggal_teknis_bkn" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK KP</label>
                                        <input class="form-control" type="file" id="dokumen_skkp"
                                            name="dokumen_skkp">
                                        <input type="hidden" name="hidden_dokumen_skkp" id="e_dokumen_skkp"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Teknis KP</label>
                                        <input class="form-control" type="file" id="dokumen_teknis_kp"
                                            name="dokumen_teknis_kp">
                                        <input type="hidden" name="hidden_dokumen_teknis_kp" id="e_dokumen_teknis_kp"
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
        <!-- /Edit Riwayat Golongan Modal -->

        <!-- Delete Riwayat Golongan Modal -->
        <div class="modal custom-modal fade" id="delete_riwayat_golongan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Golongan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/golongan/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_skkp" class="d_dokumen_skkp" value="">
                                <input type="hidden" name="dokumen_teknis_kp" class="d_dokumen_teknis_kp" value="">
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
        $(document).on('click', '.edit_riwayat_golongan', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_golongan').val(_this.find('.golongan').text());
            $('#e_jenis_kenaikan_pangkat').val(_this.find('.jenis_kenaikan_pangkat').text());
            $('#e_masa_kerja_golongan_tahun').val(_this.find('.masa_kerja_golongan_tahun').text());
            $('#e_tmt_golongan').val(_this.find('.tmt_golongan').text());
            $('#e_no_teknis_bkn').val(_this.find('.no_teknis_bkn').text());
            $('#e_tanggal_teknis_bkn').val(_this.find('.tanggal_teknis_bkn').text());
            $('#e_no_sk').val(_this.find('.no_sk').text());
            $('#e_tanggal_sk').val(_this.find('.tanggal_sk').text());
            $('#e_dokumen_skkp').val(_this.find('.dokumen_skkp').text());
            $('#e_dokumen_teknis_kp').val(_this.find('.dokumen_teknis_kp').text());
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_riwayat_golongan', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_skkp').val(_this.find('.dokumen_skkp').text());
            $('.d_dokumen_teknis_kp').val(_this.find('.dokumen_teknis_kp').text());
        });
    </script>
@endsection
@endsection
