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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
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
            <form action="{{ route('riwayat/pendidikan/cari') }}" method="GET" id="search-form">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="ting_ped" name="ting_ped">
                                <option selected disabled>-- Pilih Tingkat Pendidikan --</option>
                                @foreach($tingkatpendidikanOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Tingkat Pendidikan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="number" class="form-control floating" id="tahun_lulus" name="tahun_lulus">
                            <label class="focus-label">Tahun Lulus</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nama_sekolah" name="nama_sekolah">
                            <label class="focus-label">Nama Sekolah</label>
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
                                <th>No</th>
                                <th class="ting_ped">Tingkat Pendidikan</th>
                                <th class="pendidikan">Pendidikan</th>
                                <th class="tahun_lulus">Tahun Lulus</th>
                                <th class="no_ijazah">Nomor Ijazah</th>
                                <th class="nama_sekolah">Nama Sekolah</th>
                                <th class="gelar_depan_pend">Gelar Depan</th>
                                <th class="gelar_belakang_pend">Gelar Belakang</th>
                                <th class="jenis_pendidikan">Jenis Pendidikan</th>
                                <th class="dokumen_transkrip">Dokumen Transkrip</th>
                                <th class="dokumen_ijazah">Dokumen Ijazah</th>
                                <th class="dokumen_gelar">Dokumen Gelar</th>
                                <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPendidikan as $sqlpendidikan => $result_pendidikan)
                                    <tr>
                                        <td><center>{{ ++$sqlpendidikan }}</center></td>
                                        <td hidden class="id"><center>{{ $result_pendidikan->id }}</center></td>
                                        <td hidden class="id_pend"><center>{{ $result_pendidikan->id_pend }}</center></td>
                                        <td class="ting_ped"><center>{{ $result_pendidikan->ting_ped }}</center></td>
                                        <td class="pendidikan"><center>{{ $result_pendidikan->pendidikan }}</center></td>
                                        <td class="tahun_lulus"><center>{{ $result_pendidikan->tahun_lulus }}</center></td>
                                        <td class="no_ijazah"><center>{{ $result_pendidikan->no_ijazah }}</center></td>
                                        <td class="nama_sekolah"><center>{{ $result_pendidikan->nama_sekolah }}</center></td>
                                        <td class="gelar_depan_pend"><center>{{ $result_pendidikan->gelar_depan_pend }}</center></td>
                                        <td class="gelar_belakang_pend"><center>{{ $result_pendidikan->gelar_belakang_pend }}</center></td>
                                        <td class="jenis_pendidikan"><center>{{ $result_pendidikan->jenis_pendidikan }}</center></td>
                                        <td class="dokumen_transkrip"><center>
                                            <a href="{{ asset('assets/DokumenTranskrip/' . $result_pendidikan->dokumen_transkrip) }}" target="_blank">
                                                @if (pathinfo($result_pendidikan->dokumen_transkrip, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_transkrip">{{ $result_pendidikan->dokumen_transkrip }}</td>
                                            </a></center></td>
                                        <td class="dokumen_ijazah"><center>
                                            <a href="{{ asset('assets/DokumenIjazah/' . $result_pendidikan->dokumen_ijazah) }}" target="_blank">
                                                @if (pathinfo($result_pendidikan->dokumen_ijazah, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_ijazah">{{ $result_pendidikan->dokumen_ijazah }}</td>
                                            </a></center></td>
                                        <td class="dokumen_gelar"><center>
                                            <a href="{{ asset('assets/DokumenGelar/' . $result_pendidikan->dokumen_gelar) }}" target="_blank">
                                                @if (pathinfo($result_pendidikan->dokumen_gelar, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_gelar">{{ $result_pendidikan->dokumen_gelar }}</td>
                                            </a></center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_pendidikan" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_pendidikan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_pendidikan" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_pendidikan"><i
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
                        <form action="{{ route('riwayat/pendidikan/tambah-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="user_id"
                                            value="{{ Auth::user()->user_id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan</label><br>
                                        <select name="ting_ped" class="theSelect" id="ting_ped" required>
                                            <option selected disabled> --Pilih Tingkat Pendidikan --</option>
                                            @foreach($tingkatpendidikanOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label><br>
                                        <select name="pendidikan" class="theSelect" id="pendidikan" required>
                                            <option selected disabled> --Pilih Pendidikan --</option>
                                            @foreach($pendidikanterakhirOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input type="number" class="form-control" name="tahun_lulus" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Ijazah</label>
                                        <input type="text" class="form-control" name="no_ijazah" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input type="text" class="form-control" name="nama_sekolah" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Depan</label>
                                        <input type="text" class="form-control" name="gelar_depan_pend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input type="text" class="form-control" name="gelar_belakang_pend">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan</label>
                                        <br>
                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Pertama">
                                        Pendidikan Pertama
                                        <br>
                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Kedua">
                                        Pendidikan Kedua
                                        <br>
                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Ketiga">
                                        Pendidikan Ketiga
                                        <br>
                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Keempat">
                                        Pendidikan Keempat
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Transkrip Nilai</label>
                                        <input type="file" class="form-control" name="dokumen_transkrip">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Ijazah</label>
                                        <input type="file" class="form-control" name="dokumen_ijazah">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Pencantuman Gelar </label>
                                        <input type="file" class="form-control" name="dokumen_gelar">
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
        <!-- /Tambah Riwayat Modal -->

        <!-- Edit Riwayat Pendidikan Modal -->
        <div id="edit_riwayat_pendidikan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Pendidikan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/pendidikan/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_pend" id="e_id_pend" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan</label>
                                        <select name="ting_ped" class="select" id="e_ting_ped">
                                            <option selected disabled> --Pilih Jenis Pendidikan --</option>
                                            <option>SLTP</option>
                                            <option>SLTA</option>
                                            <option>Diploma I</option>
                                            <option>Diploma II</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <input type="text" class="form-control" name="pendidikan" id="e_pendidikan"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input type="number" class="form-control" name="tahun_lulus" id="e_tahun_lulus"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Ijazah</label>
                                        <input type="text" class="form-control" name="no_ijazah" id="e_no_ijazah"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input type="text" class="form-control" name="nama_sekolah"
                                            id="e_nama_sekolah" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Depan</label>
                                        <input type="text" class="form-control" name="gelar_depan_pend"
                                            id="e_gelar_depan_pend" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input type="text" class="form-control" name="gelar_belakang_pend"
                                            id="e_gelar_belakang_pend" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan</label>
                                        <input type="text" class="form-control" name="jenis_pendidikan"
                                            id="e_jenis_pendidikan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Transkrip</label>
                                        <input type="file" class="form-control" id="dokumen_transkrip"
                                            name="dokumen_transkrip">
                                        <input type="hidden" name="hidden_dokumen_transkrip" id="e_dokumen_transkrip"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Ijazah</label>
                                        <input type="file" class="form-control" id="dokumen_ijazah"
                                            name="dokumen_ijazah">
                                        <input type="hidden" name="hidden_dokumen_ijazah" id="e_dokumen_ijazah"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Gelar</label>
                                        <input type="file" class="form-control" id="dokumen_gelar"
                                            name="dokumen_gelar">
                                        <input type="hidden" name="hidden_dokumen_gelar" id="e_dokumen_gelar"
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
        <!-- /Edit Riwayat Pendidikan Modal -->

        <!-- Delete Riwayat Pendidikan Modal -->
        <div class="modal custom-modal fade" id="delete_riwayat_pendidikan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Pendidikan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/pendidikan/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_transkrip" class="d_dokumen_transkrip"
                                    value="">
                                <input type="hidden" name="dokumen_ijazah" class="d_dokumen_ijazah" value="">
                                <input type="hidden" name="dokumen_gelar" class="d_dokumen_gelar" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-danger continue-btn submit-btn">Hapus</button>
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
        <!-- End Delete Riwayat Pendidikan Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_riwayat_pendidikan', function() {
            var _this = $(this).parents('tr');
            $('#e_id_pend').val(_this.find('.id_pend').text());
            $('#e_pendidikan').val(_this.find('.pendidikan').text());
            $('#e_tahun_lulus').val(_this.find('.tahun_lulus').text());
            $('#e_no_ijazah').val(_this.find('.no_ijazah').text());
            $('#e_nama_sekolah').val(_this.find('.nama_sekolah').text());
            $('#e_gelar_depan_pend').val(_this.find('.gelar_depan_pend').text());
            $('#e_gelar_belakang_pend').val(_this.find('.gelar_belakang_pend').text());
            $('#e_jenis_pendidikan').val(_this.find('.jenis_pendidikan').text());
            $('#e_dokumen_transkrip').val(_this.find('.dokumen_transkrip').text());
            $('#e_dokumen_ijazah').val(_this.find('.dokumen_ijazah').text());
            $('#e_dokumen_gelar').val(_this.find('.dokumen_gelar').text());

            var ting_ped = (_this.find(".ting_ped").text());
            var _option = '<option selected value="' + ting_ped + '">' + _this.find('.ting_ped')
                .text() + '</option>'
            $(_option).appendTo("#e_ting_ped");
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_riwayat_pendidikan', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_transkrip').val(_this.find('.dokumen_transkrip').text());
            $('.d_dokumen_ijazah').val(_this.find('.dokumen_ijazah').text());
            $('.d_dokumen_gelar').val(_this.find('.dokumen_gelar').text());
        });
    </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
		$(".theSelect").select2();
	    </script>

        <script>
        history.pushState({}, "", '/riwayat/pendidikan');
    </script>
@endsection
@endsection
