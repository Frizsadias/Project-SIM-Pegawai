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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Golongan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_golongan"><i
                                class="fa fa-plus"></i> Tambah Riwayat Golongan</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('riwayat/golongan/cari') }}" method="GET" id="search-form">
                <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="golongan" name="golongan">
                        <label class="focus-label">Nama Golongan</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="jenis_kenaikan_pangkat" name="jenis_kenaikan_pangkat">
                        <label class="focus-label">Jenis Kenaikan Pangkat (KP)</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="no_sk_golongan" name="no_sk_golongan">
                        <label class="focus-label">Nomor SK</label>
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
                                    <th class="golongan">Golongan</th>
                                    <th class="jenis_kenaikan_pangkat">Jenis Kenaikan Pangkat (KP)</th>
                                    <th class="jenis_kerja_golongan_tahun">Masa Kerja Golongan (Tahun)</th>
                                    <th class="jenis_kerja_golongan_bulan">Masa Kerja Golongan (Bulan)</th>
                                    <th class="tmt_golongan_riwayat">TMT Golongan</th>
                                    <th class="no_teknis_bkn">No Teknis BKN</th>
                                    <th class="tanggal_teknis_bkn">Tanggal Teknis BKN</th>
                                    <th class="no_sk_golongan">No SK</th>
                                    <th class="tanggal_sk_golongan">Tanggal SK</th>
                                    <th class="dokumen_skkp">Dokumen SK KP</th>
                                    <th class="dokumen_teknis_kp">Dokumen Teknis KP</th>
                                    <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatGolongan as $sqlgolongan => $result_golongan)
                                    <tr>
                                        <td><center>{{ ++$sqlgolongan }}</center></td>
                                        <td hidden class="id"><center>{{ $result_golongan->id }}</center></td>
                                        <td hidden class="id_gol"><center>{{ $result_golongan->id_gol }}</center></td>
                                        <td class="golongan"><center>{{ $result_golongan->golongan }}</center></td>
                                        <td class="jenis_kenaikan_pangkat"><center>{{ $result_golongan->jenis_kenaikan_pangkat }}</center></td>
                                        <td class="masa_kerja_golongan_tahun"><center>{{ $result_golongan->masa_kerja_golongan_tahun }}</center></td>
                                        <td class="masa_kerja_golongan_bulan"><center>{{ $result_golongan->masa_kerja_golongan_bulan }}</center></td>
                                        <td class="tmt_golongan_riwayat"><center>{{ $result_golongan->tmt_golongan_riwayat }}</center></td>
                                        <td class="no_teknis_bkn"><center>{{ $result_golongan->no_teknis_bkn }}</center></td>
                                        <td class="tanggal_teknis_bkn"><center>{{ $result_golongan->tanggal_teknis_bkn }}</center></td>
                                        <td class="no_sk_golongan"><center>{{ $result_golongan->no_sk_golongan }}</center></td>
                                        <td class="tanggal_sk_golongan"><center>{{ $result_golongan->tanggal_sk_golongan }}</center></td>
                                        <td class="dokumen_skkp"><center>
                                            <a href="{{ asset('assets/DokumenSKKP/' . $result_golongan->dokumen_skkp) }}" target="_blank">
                                                @if (pathinfo($result_golongan->dokumen_skkp, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_skkp">{{ $result_golongan->dokumen_skkp }}</td>
                                            </a></center></td>
                                        <td class="dokumen_teknis_kp"><center>
                                            <a href="{{ asset('assets/DokumenTeknisKP/' . $result_golongan->dokumen_teknis_kp) }}" target="_blank">
                                                @if (pathinfo($result_golongan->dokumen_teknis_kp, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_teknis_kp">{{ $result_golongan->dokumen_teknis_kp }}</td>
                                            </a></center></td>

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

        <!-- Tambah Riwayat Golongan Modal -->
        <div id="add_riwayat_golongan" class="modal custom-modal fade" role="dialog">
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
                                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->user_id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Golongan</label><br>
                                        <select name="golongan" class="theSelect" id="golongan" required>
                                            <option selected disabled>-- Pilih Golongan--</option>
                                            @foreach ($golonganOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kenaikan Pangkat (KP)</label>
                                        <input type="text" class="form-control" name="jenis_kenaikan_pangkat"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja Golongan (Tahun)</label>
                                        <input type="number" class="form-control" name="masa_kerja_golongan_tahun"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja Golongan (Bulan)</label>
                                        <input type="number" class="form-control" name="masa_kerja_golongan_bulan"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Golongan</label>
                                        <input type="date" class="form-control" name="tmt_golongan_riwayat" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Pertimbangan Teknis BKN</label>
                                        <input type="number" class="form-control" name="no_teknis_bkn" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Pertimbangan Teknis BKN</label>
                                        <input type="date" class="form-control" name="tanggal_teknis_bkn" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <input type="text" class="form-control" name="no_sk_golongan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input type="date" class="form-control" name="tanggal_sk_golongan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK KP</label>
                                        <input type="file" class="form-control" name="dokumen_skkp">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Pertimbangan Teknis KP</label>
                                        <input type="file" class="form-control" name="dokumen_teknis_kp">
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
        <!-- /Tambah Riwayat Golongan Modal -->

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
                        <form action="{{ route('riwayat/golongan/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_gol" id="e_id_gol" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <input type="text" class="form-control" name="golongan" id="e_golongan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kenaikan Pangkat</label>
                                        <input type="text" class="form-control" name="jenis_kenaikan_pangkat" id="e_jenis_kenaikan_pangkat" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja Golongan (Tahun)</label>
                                        <input type="number" class="form-control" name="masa_kerja_golongan_tahun" id="e_masa_kerja_golongan_tahun" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Kerja golongan (Bulan)</label>
                                        <input type="number" class="form-control" name="masa_kerja_golongan_bulan" id="e_masa_kerja_golongan_bulan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Golongan</label>
                                        <input type="date" class="form-control" name="tmt_golongan_riwayat" id="e_tmt_golongan_riwayat" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Teknis BKN</label>
                                        <input type="number" class="form-control" name="no_teknis_bkn" id="e_no_teknis_bkn" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Teknis BKN</label>
                                        <input type="date" class="form-control" name="tanggal_teknis_bkn" id="e_tanggal_teknis_bkn" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <input type="text" class="form-control" name="no_sk_golongan" id="e_no_sk_golongan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input type="date" class="form-control" name="tanggal_sk_golongan" id="e_tanggal_sk_golongan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SK KP</label>
                                        <input type="file" class="form-control" id="dokumen_skkp" name="dokumen_skkp">
                                        <input type="hidden" name="hidden_dokumen_skkp" id="e_dokumen_skkp" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Teknis KP</label>
                                        <input type="file" class="form-control" id="dokumen_teknis_kp" name="dokumen_teknis_kp">
                                        <input type="hidden" name="hidden_dokumen_teknis_kp" id="e_dokumen_teknis_kp" value="">
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
                                <input type="hidden" name="dokumen_teknis_kp" class="d_dokumen_teknis_kp"
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
        <!-- End Delete Riwayat Golongan Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_riwayat_golongan', function() {
            var _this = $(this).parents('tr');
            $('#e_id_gol').val(_this.find('.id_gol').text());
            $('#e_golongan').val(_this.find('.golongan').text());
            $('#e_jenis_kenaikan_pangkat').val(_this.find('.jenis_kenaikan_pangkat').text());
            $('#e_masa_kerja_golongan_tahun').val(_this.find('.masa_kerja_golongan_tahun').text());
            $('#e_masa_kerja_golongan_bulan').val(_this.find('.masa_kerja_golongan_bulan').text());
            $('#e_tmt_golongan_riwayat').val(_this.find('.tmt_golongan_riwayat').text());
            $('#e_no_teknis_bkn').val(_this.find('.no_teknis_bkn').text());
            $('#e_tanggal_teknis_bkn').val(_this.find('.tanggal_teknis_bkn').text());
            $('#e_no_sk_golongan').val(_this.find('.no_sk_golongan').text());
            $('#e_tanggal_sk_golongan').val(_this.find('.tanggal_sk_golongan').text());
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
		$(".theSelect").select2();
	    </script>

    <script>
        history.pushState({}, "", '/riwayat/golongan');
    </script>
@endsection
@endsection
