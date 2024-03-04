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
            <form action="{{ route('riwayat/diklat/cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="theSelect" style="width: 100% !important" id="jenis_diklat" name="jenis_diklat">
                                <option selected disabled>-- Pilih Jenis Diklat --</option>
                                @foreach($jenisdiklatOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Jenis Diklat</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nama_diklat" name="nama_diklat">
                            <label class="focus-label">Nama Diklat</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="institusi_penyelenggara" name="institusi_penyelenggara">
                            <label class="focus-label">Institusi Penyelenggara</label>
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
                                    <th class="jenis_diklat">Jenis Diklat</th>
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
                                        <td hidden class="id"><center>{{ $result_diklat->id }}</center></td>
                                        <td hidden class="id_dik"><center>{{ $result_diklat->id_dik }}</center></td>
                                        <td class="jenis_diklat"><center>{{ $result_diklat->jenis_diklat }}</center></td>
                                        <td class="nama_diklat"><center>{{ $result_diklat->nama_diklat }}</center></td>
                                        <td class="institusi_penyelenggara"><center>{{ $result_diklat->institusi_penyelenggara }}</center></td>
                                        <td class="no_sertifikat"><center>{{ $result_diklat->no_sertifikat }}</center></td>
                                        <td class="tanggal_mulai"><center>{{ $result_diklat->tanggal_mulai }}</center></td>
                                        <td class="tanggal_selesai"><center>{{ $result_diklat->tanggal_selesai }}</center></td>
                                        <td class="tahun_diklat"><center>{{ $result_diklat->tahun_diklat }}</center></td>
                                        <td class="durasi_jam"><center>{{ $result_diklat->durasi_jam }}</center></td>
                                        <td class="dokumen_diklat"><center>
                                            <a href="{{ asset('assets/DokumenDiklat/' . $result_diklat->dokumen_diklat) }}" target="_blank">
                                                @if (pathinfo($result_diklat->dokumen_diklat, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_diklat">{{ $result_diklat->dokumen_diklat }}</td>
                                            </a></center></td>

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
        </div>
        <!-- /Page Content -->

        <!-- Tambah Riwayat Diklat Modal -->
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
                                        <br>
                                        <select class="theSelect form-control" style="width: 100% !important" name="jenis_diklat" required>
                                            <option selected disabled>-- Pilih Jenis Diklat --</option>
                                            @foreach($jenisdiklatOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
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
                                <div class="dropzone-box-1">
                                    <label>Dokumen Diklat</label>
                                    <div class="dropzone-area-1">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_diklat" id="upload-file-form-1">
                                        <p class="info-draganddrop-1">Tidak ada file yang di pilih</p>
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
        <!-- /Tambah Riwayat Diklat Modal -->

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
                            <input type="hidden" name="id_dik" id="e_id_dik" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Diklat</label>
                                        <br>
                                        <select class="theSelect" style="width: 100% !important" name="jenis_diklat" id="e_jenis_diklat">
                                            <option selected disabled>-- Pilih Jenis Diklat --</option>
                                            @foreach($jenisdiklatOptions as $key => $value)
                                                @if (!empty($result_diklat->jenis_diklat))
                                                    <option value="{{ $key }}" {{ $key == $result_diklat->jenis_diklat ? 'selected' : '' }}>{{ $value }}</option>
                                                @endif
                                            @endforeach
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
                                <div class="dropzone-box-2">
                                    <label>Dokumen Diklat</label>
                                    <div class="dropzone-area-2">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_diklat" id="dokumen_diklat">
                                        <input type="hidden" name="hidden_dokumen_diklat" id="e_dokumen_diklat" value="">
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
        <script src="{{ asset('assets/js/diklat.js') }}"></script>
        <script src="{{ asset('assets/js/drag-drop-file.js') }}"></script>
        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/riwayat/diklat');
        </script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Riwayat Diklat/Kursus | Aplikasi SILK';
        </script>

    @endsection
@endsection