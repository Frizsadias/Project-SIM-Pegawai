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
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="theSelect" style="width: 100% !important" id="jenis_jabatan_riwayat" name="jenis_jabatan_riwayat">
                                <option selected disabled>-- Pilih Jenis Jabatan --</option>
                                @foreach ($jenisjabatanOptions as $key => $value)
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

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Jenis Jabatan</th>
                                    <th>Satuan Kerja</th>
                                    <th>Satuan Kerja Induk</th>
                                    <th>Unit Organisasi</th>
                                    <th>No SK</th>
                                    <th>Tanggal SK</th>
                                    <th>TMT Jabatan</th>
                                    <th>TMT Pelantikan</th>
                                    <th>Dokumen SK Jabatan</th>
                                    <th>Dokumen Pelantikan</th>
                                    <th class="text-right no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatJabatan as $sqljabatan => $result_jabatan)
                                    <tr>
                                        {{-- <td><center>{{ ++$sqljabatan }}</center></td> --}}
                                        <td class="id"><center>{{ $result_jabatan->id }}</center></td>
                                        {{-- <td hidden class="id_jab"><center>{{ $result_jabatan->id_jab }}</center></td> --}}
                                        <td class="jenis_jabatan_riwayat"><center>{{ $result_jabatan->jenis_jabatan_riwayat }}</center></td>
                                        <td class="satuan_kerja"><center>{{ $result_jabatan->satuan_kerja }}</center></td>
                                        <td class="satuan_kerja_induk"><center>{{ $result_jabatan->satuan_kerja_induk }}</center></td>
                                        <td class="unit_organisasi_riwayat"><center>{{ $result_jabatan->unit_organisasi_riwayat }}</center></td>
                                        <td class="no_sk"><center>{{ $result_jabatan->no_sk }}</center></td>
                                        <td class="tanggal_sk"><center>{{ $result_jabatan->tanggal_sk }}</center></td>
                                        <td class="tmt_jabatan"><center>{{ $result_jabatan->tmt_jabatan }}</center></td>
                                        <td class="tmt_pelantikan"><center>{{ $result_jabatan->tmt_pelantikan }}</center></td>
                                        <td class="dokumen_sk_jabatan"><center><a href="{{ asset('assets/DokumenSKJabatan/' . $result_jabatan->dokumen_sk_jabatan) }}" target="_blank"></a></center></td>
                                        <td class="dokumen_pelantikan"><center><a href="{{ asset('assets/DokumenPelantikan/' . $result_jabatan->dokumen_pelantikan) }}" target="_blank"></a></center></td>

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
        </div>
        <!-- /Page Content -->

        <!-- Tambah Riwayat Jabatan Modal -->
        <div id="add_riwayat_jabatan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Jabatan</h5>
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
                                        <select class="theSelect form-control" style="width: 100% !important" name="jenis_jabatan_riwayat" required>
                                            <option selected disabled>-- Pilih Jenis Jabatan --</option>
                                            @foreach ($jenisjabatanOptions as $key => $value)
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
                                        <input class="form-control" type="text" name="unit_organisasi_riwayat"
                                            required>
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
                                <div class="dropzone-box-1">
                                    <label>Dokumen SK Jabatan</label>
                                    <div class="dropzone-area-1">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_sk_jabatan" id="upload-file-form-1">
                                        <p class="info-draganddrop-1">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                                <div class="dropzone-box-2">
                                    <label>Dokumen Pelantikan</label>
                                    <div class="dropzone-area-2">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_pelantikan" id="upload-file-form-2">
                                        <p class="info-draganddrop-2">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" id="submit-button" class="btn btn-primary submit-btn">Simpan</button>
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
                        <h5 class="modal-title">Edit Riwayat Jabatan</h5>
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
                                        <label>Jenis Jabatan</label>
                                        <br>
                                        <select class="theSelect" style="width: 100% !important" name="jenis_jabatan_riwayat" id="e_jenis_jabatan_riwayat">
                                            <option selected disabled>-- Pilih Jenis Jabatan --</option>
                                            @foreach ($jenisjabatanOptions as $key => $value)
                                                @if (!empty($result_jabatan->jenis_jabatan_riwayat))
                                                    <option value="{{ $key }}" {{ $key == $result_jabatan->jenis_jabatan_riwayat ? 'selected' : '' }}>{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja</label>
                                        <input class="form-control" type="text" name="satuan_kerja" id="e_satuan_kerja" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Satuan Kerja Induk</label>
                                        <input class="form-control" type="text" name="satuan_kerja_induk" id="e_satuan_kerja_induk" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Organisasi</label>
                                        <input class="form-control" type="text" name="unit_organisasi_riwayat" id="e_unit_organisasi_riwayat" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <input class="form-control" type="text" name="no_sk" id="e_no_sk" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <input class="form-control" type="date" name="tanggal_sk" id="e_tanggal_sk" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Jabatan</label>
                                        <input class="form-control" type="date" name="tmt_jabatan" id="e_tmt_jabatan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TMT Pelantikan</label>
                                        <input class="form-control" type="date" name="tmt_pelantikan" id="e_tmt_pelantikan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="dropzone-box-3">
                                    <label>Dokumen SK Jabatan</label>
                                    <div class="dropzone-area-3">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" id="dokumen_sk_jabatan" name="dokumen_sk_jabatan">
                                        <input type="hidden" name="hidden_dokumen_sk_jabatan" id="e_dokumen_sk_jabatan" value="">
                                        <p class="info-draganddrop-3">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                                <div class="dropzone-box-4">
                                    <label>Dokumen Pelantikan</label>
                                    <div class="dropzone-area-4">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" id="dokumen_pelantikan" name="dokumen_pelantikan">
                                        <input type="hidden" name="hidden_dokumen_pelantikan" id="e_dokumen_pelantikan" value="">
                                        <p class="info-draganddrop-4">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" id="submit-button" class="btn btn-primary submit-btn">Simpan</button>
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
        <script src="{{ asset('assets/js/jabatan.js') }}"></script>
        <script src="{{ asset('assets/js/drag-drop-file.js') }}"></script>
        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                if (!$('.datatable').hasClass('dataTable')) {
                    $('.datatable').DataTable({
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "columnDefs": [
                            { "targets": [9, 10, 11], "orderable": false },
                            { "targets": [9, 10, 11], "searchable": false }
                        ]
                    });
                }
        
                $('.dokumen_sk_jabatan a').each(function() {
                    if ($(this).attr('href').toLowerCase().endsWith('.pdf')) {
                        $(this).prepend('<i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>');
                    }
                    @if (!empty($result_jabatan->dokumen_sk_jabatan))
                        $(this).closest('td').after('<td hidden class="dokumen_sk_jabatan">{{ $result_jabatan->dokumen_sk_jabatan }}</td>');
                    @endif
                });

                $('.dokumen_pelantikan a').each(function() {
                    if ($(this).attr('href').toLowerCase().endsWith('.pdf')) {
                        $(this).prepend('<i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>');
                    }
                    @if (!empty($result_jabatan->dokumen_pelantikan))
                        $(this).closest('td').after('<td hidden class="dokumen_pelantikan">{{ $result_jabatan->dokumen_pelantikan }}</td>');
                    @endif
                });

                $('.id').each(function() {
                    @if (!empty($result_jabatan->id_jab))
                        $(this).closest('td').after('<td hidden class="id_jab"><center>{{ $result_jabatan->id_jab }}</center></td>');
                    @endif
                });
            });
        </script>
        
        <script>
            $(".theSelect").select2();
        </script>
        
        <script>
            history.pushState({}, "", '/riwayat/jabatan');
        </script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Riwayat Jabatan | Aplikasi SILK';
        </script>

    @endsection
@endsection