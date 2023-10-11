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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Jabatan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_jabatan"><i
                                class="fa fa-plus"></i> Tambah Riwayat Jabatan</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('riwayat/jabatan/cari') }}" method="GET" id="search-form">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="jenis_jabatan_riwayat" name="jenis_jabatan_riwayat">
                                <option selected disabled> --Pilih Jenis Jabatan --</option>
                                            @foreach($jenisjabatanOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                            </select>
                            <label class="focus-label">Jenis Jabatan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="satuan_kerja" name="satuan_kerja">
                            <label class="focus-label">Satuan Kerja</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="unit_organisasi_riwayat" name="unit_organisasi_riwayat">
                            <label class="focus-label">Unit Organisasi</label>
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
                                    <th class="jenis_jabatan_riwayat"> Jenis Jabatan</th>
                                    <th class="satuan_kerja">Satuan Kerja</th>
                                    <th class="satuan_kerja_induk">Satuan Kerja Induk</th>
                                    <th class="unit_organisasi_riwayat">Unit Organisasi</th>
                                    <th class="no_sk">No SK</th>
                                    <th class="tanggal_sk">Tanggal SK</th>
                                    <th class="tmt_jabatan">TMT Jabatan</th>
                                    <th class="tmt_pelantikan">TMT Pelantikan</th>
                                    <th class="dokumen_sk_jabatan">Dokumen SK Jabatan</th>
                                    <th class="dokumen_pelantikan">Dokumen Pelantikan</th>
                                    <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatJabatan as $sqljabatan => $result_jabatan)
                                    <tr>
                                        <td><center>{{ ++$sqljabatan }}</center></td>
                                        <td hidden class="id"><center>{{ $result_jabatan->id }}</center></td>
                                        <td hidden class="id_jab"><center>{{ $result_jabatan->id_jab }}</center></td>
                                        <td class="jenis_jabatan_riwayat"><center>{{ $result_jabatan->jenis_jabatan_riwayat }}</center></td>
                                        <td class="satuan_kerja"><center>{{ $result_jabatan->satuan_kerja }}</center></td>
                                        <td class="satuan_kerja_induk"><center>{{ $result_jabatan->satuan_kerja_induk }}</center></td>
                                        <td class="unit_organisasi_riwayat"><center>{{ $result_jabatan->unit_organisasi_riwayat }}</center></td>
                                        <td class="no_sk"><center>{{ $result_jabatan->no_sk }}</center></td>
                                        <td class="tanggal_sk"><center>{{ $result_jabatan->tanggal_sk }}</center></td>
                                        <td class="tmt_jabatan"><center>{{ $result_jabatan->tmt_jabatan }}</center></td>
                                        <td class="tmt_pelantikan"><center>{{ $result_jabatan->tmt_pelantikan }}</center></td>
                                        <td class="dokumen_sk_jabatan"><center>
                                            <a href="{{ asset('assets/DokumenSKJabatan/' . $result_jabatan->dokumen_sk_jabatan) }}" target="_blank">
                                                @if (pathinfo($result_jabatan->dokumen_sk_jabatan, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_sk_jabatan">{{ $result_jabatan->dokumen_sk_jabatan }}</td>
                                            </a></center></td>
                                        <td class="dokumen_pelantikan"><center>
                                            <a href="{{ asset('assets/DokumenPelantikan/' . $result_jabatan->dokumen_pelantikan) }}" target="_blank">
                                                @if (pathinfo($result_jabatan->dokumen_pelantikan, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_pelantikan">{{ $result_jabatan->dokumen_pelantikan }}</td>
                                            </a></center></td>

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

        <!-- Tambah Riwayat Jabatan Modal -->
        <div id="add_riwayat_jabatan" class="modal custom-modal fade" role="dialog">
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
                        <form action="{{ route('riwayat/jabatan/tambah-data') }}" method="POST" enctype="multipart/form-data">
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
                                        <label>Jenis Jabatan</label>
                                        <br>
                                        <select class="theSelect form-control" name="jenis_jabatan_riwayat" required>
                                            <option selected disabled> --Pilih Jenis Jabatan --</option>
                                            @foreach($jenisjabatanOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja</label>
                                        <input class="form-control" type="text" name="satuan_kerja" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja Induk</label>
                                        <input class="form-control" type="text" name="satuan_kerja_induk" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Organisasi</label>
                                        <input class="form-control" type="text" name="unit_organisasi_riwayat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <input class="form-control" type="text" name="no_sk" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input class="form-control" type="date" name="tanggal_sk" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Jabatan</label>
                                        <input class="form-control" type="date" name="tmt_jabatan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Pelantikan</label>
                                        <input class="form-control" type="date" name="tmt_pelantikan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
        <!-- /Tambah Riwayat Jabatan Modal -->

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
                        <form action="{{ route('riwayat/jabatan/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_jab" id="e_id_jab" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Jabatan
                                        </label>
                                        <select name="jenis_jabatan_riwayat" class="select" id="e_jenis_jabatan_riwayat">
                                            <option selected disabled> --Pilih Jenis Jabatan --</option>
                                            <option>Jabatan Struktural</option>
                                            <option>Jabatan Fungsional Tertentu</option>
                                            <option>Jabatan Fungsional Umum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja</label>
                                        <input type="text" class="form-control" name="satuan_kerja" id="e_satuan_kerja" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja Induk</label>
                                        <input type="text" class="form-control" name="satuan_kerja_induk" id="e_satuan_kerja_induk" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Organisasi</label>
                                        <input type="text" class="form-control" name="unit_organisasi_riwayat" id="e_unit_organisasi_riwayat" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <input type="text" class="form-control" name="no_sk" id="e_no_sk" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input type="date" class="form-control" name="tanggal_sk" id="e_tanggal_sk" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Jabatan</label>
                                        <input type="date" class="form-control" name="tmt_jabatan" id="e_tmt_jabatan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Pelantikan</label>
                                        <input type="date" class="form-control" name="tmt_pelantikan" id="e_tmt_pelantikan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK Jabatan</label>
                                        <input type="file" class="form-control" id="dokumen_sk_jabatan" name="dokumen_sk_jabatan">
                                        <input type="hidden" name="hidden_dokumen_sk_jabatan" id="e_dokumen_sk_jabatan" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Pelantikan</label>
                                        <input type="file" class="form-control" id="dokumen_pelantikan" name="dokumen_pelantikan">
                                        <input type="hidden" name="hidden_dokumen_pelantikan" id="e_dokumen_pelantikan" value="">
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
                                <input type="hidden" name="dokumen_sk_jabatan" class="d_dokumen_sk_jabatan" value="">
                                <input type="hidden" name="dokumen_pelantikan" class="d_dokumen_pelantikan" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Hapus</button>
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
        <!-- End Delete Riwayat Jabatan Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_riwayat_jabatan', function() {
            var _this = $(this).parents('tr');
            $('#e_id_jab').val(_this.find('.id_jab').text());
            $('#e_satuan_kerja').val(_this.find('.satuan_kerja').text());
            $('#e_satuan_kerja_induk').val(_this.find('.satuan_kerja_induk').text());
            $('#e_unit_organisasi_riwayat').val(_this.find('.unit_organisasi_riwayat').text());
            $('#e_no_sk').val(_this.find('.no_sk').text());
            $('#e_tanggal_sk').val(_this.find('.tanggal_sk').text());
            $('#e_tmt_jabatan').val(_this.find('.tmt_jabatan').text());
            $('#e_tmt_pelantikan').val(_this.find('.tmt_pelantikan').text());
            $('#e_dokumen_sk_jabatan').val(_this.find('.dokumen_sk_jabatan').text());
            $('#e_dokumen_pelantikan').val(_this.find('.dokumen_pelantikan').text());

            var jenis_jabatan_riwayat = (_this.find(".jenis_jabatan_riwayat").text());
            var _option = '<option selected value="' + jenis_jabatan_riwayat + '">' + _this.find('.jenis_jabatan_riwayat').text() +
                '</option>'
            $(_option).appendTo("#e_jenis_jabatan_riwayat");
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
		$(".theSelect").select2();
	    </script>
@endsection
@endsection
