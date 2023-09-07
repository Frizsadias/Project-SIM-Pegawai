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
                                <th class="dokumen_transkrip">Dokumen Transkrip</th>
                                <th class="dokumen_ijazah">Dokumen Ijazah</th>
                                <th class="dokumen_gelar">Dokumen Gelar</th>
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
                                        <td class="dokumen_transkrip">{{ $result_pendidikan->dokumen_transkrip }}</td>
                                        <td class="dokumen_ijazah">{{ $result_pendidikan->dokumen_ijazah }}</td>
                                        <td class="dokumen_gelar">{{ $result_pendidikan->dokumen_gelar }}</td>

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
                                        <label>Tingkat Pendidikan</label>
                                        <select name="tingkat_pendidikan" class="form-control" id="tingkat_pendidikan"
                                            required>
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
                                        <input type="text" class="form-control" name="pendidikan" required>
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
                                        <input type="number" class="form-control" name="no_ijazah" required>
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
                                        <input type="text" class="form-control" name="gelar_depan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input type="text" class="form-control" name="gelar_belakang" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan</label>
                                        <br>
                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan-Pertama">
                                        Pendidikan Pertama
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Transkrip Nilai</label>
                                        <input type="file" class="form-control" name="dokumen_transkrip" required>
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Ijazah</label>
                                        <input type="file" class="form-control" name="dokumen_ijazah" required>
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dokumen">Dokumen Pencantuman Gelar </label>
                                        <input type="file" class="form-control" name="dokumen_gelar" required>
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
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan</label>
                                        <select class="select" name="tingkat_pendidikan" id="e_tingkat_pendidikan">
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
                                        <label>Dokumen Transkrip</label>
                                        <input class="form-control" type="file" id="dokumen_transkrip"
                                            name="dokumen_transkrip">
                                        <input type="" name="hidden_dokumen" id="e_dokumen_transkrip"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Ijazah</label>
                                        <input class="form-control" type="file" id="dokumen_ijazah"
                                            name="dokumen_ijazah">
                                        <input type="" name="hidden_dokumen" id="e_dokumen_ijazah"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Gelar</label>
                                        <input class="form-control" type="file" id="dokumen_gelar"
                                            name="dokumen_gelar">
                                        <input type="" name="hidden_dokumen" id="e_dokumen_gelar" value="">
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
        <!-- Delete Expense Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_riwayat_pendidikan', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_pendidikan').val(_this.find('.pendidikan').text());
            $('#e_tahun_lulus').val(_this.find('.tahun_lulus').text());
            $('#e_no_ijazah').val(_this.find('.no_ijazah').text());
            $('#e_nama_sekolah').val(_this.find('.nama_sekolah').text());
            $('#e_gelar_depan').val(_this.find('.gelar_depan').text());
            $('#e_gelar_belakang').val(_this.find('.gelar_belakang').text());
            $('#e_jenis_pendidikan').val(_this.find('.jenis_pendidikan').text());
            $('#e_dokumen_transkrip').val(_this.find('.dokumen_transkrip').text());
            $('#e_dokumen_ijazah').val(_this.find('.dokumen_ijazah').text());
            $('#e_dokumen_gelar').val(_this.find('.dokumen_gelar').text());

            var tingkat_pendidikan = (_this.find(".tingkat_pendidikan").text());
            var _option = '<option selected value="' + tingkat_pendidikan + '">' + _this.find('.tingkat_pendidikan')
                .text() +
                '</option>'
            $(_option).appendTo("#e_tingkat_pendidikan");
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
@endsection
@endsection
