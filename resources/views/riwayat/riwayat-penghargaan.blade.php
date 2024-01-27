@extends('layouts.master')
@extends('layouts.judulpenghargaan')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"> Riwayat Penghargaan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Penghargaan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_penghargaan"><i
                                class="fa fa-plus"></i> Tambah Riwayat Penghargaan</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <form action="{{ route('riwayat/penghargaan/cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="jenis_penghargaan" name="jenis_penghargaan">
                                <option value="">Pilih Jenis Penghargaan</option>
                                <option value="Bintang">Bintang</option>
                                <option value="R.I Adipurna">R.I Adipurna</option>
                                <option value="R.I Adipradana">R.I Adipradana</option>
                                <option value="R.I Utama">R.I Utama</option>
                                <option value="R.I Pratama">R.I Pratama</option>
                                <option value="R.I Naraya">R.I Naraya</option>
                            </select>
                            <label class="focus-label">Jenis Penghargaan</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="number" class="form-control floating" id="tahun_perolehan" name="tahun_perolehan">
                        <label class="focus-label">Tahun Perolehan</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="no_surat" name="no_surat">
                        <label class="focus-label">Nomor Surat</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                </div>
                </div>
            </form>

            {{-- message --}}
            {!! Toastr::message() !!}
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Jenis Penghargaan</center></th>
                                    <th><center>Tahun Perolehan</center></th>
                                    <th><center>Nomor Surat</center></th>
                                    <th><center>Tanggal SK</center></th>
                                    <th><center>Dokumen Penghargaan</center></th>
                                    <th><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPenghargaan as $sqlPenghargaan => $result_penghargaan)
                                    <tr>
                                        <td><center>{{ ++$sqlPenghargaan }}</center></td>
                                        <td hidden class="id"><center>{{ $result_penghargaan->id }}</center></td>
                                        <td class="jenis_penghargaan"><center>{{ $result_penghargaan->jenis_penghargaan }}</center></td>
                                        <td class="tahun_perolehan"><center>{{ $result_penghargaan->tahun_perolehan }}</center></td>
                                        <td class="no_surat"><center>{{ $result_penghargaan->no_surat }}</center></td>
                                        <td class="tanggal_keputusan"><center>{{ $result_penghargaan->tanggal_keputusan }}</center></td>
                                        <td class="dokumen_penghargaan"><center>
                                            <a href="{{ asset('assets/DokumenPenghargaan/' . $result_penghargaan->dokumen_penghargaan) }}" target="_blank">
                                                @if (pathinfo($result_penghargaan->dokumen_penghargaan, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_penghargaan">{{ $result_penghargaan->dokumen_penghargaan }}</td>
                                            </a>
                                        </center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_penghargaan" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_penghargaan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_penghargaan" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_penghargaan"><i
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

        <!-- Tambah Riwayat Penghargaan Modal -->
        <div id="add_riwayat_penghargaan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Penghargaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/penghargaan/tambah-data') }}" method="POST"
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
                                        <label>Jenis Penghargaan</label>
                                        <small class="text-danger">*</small>
                                        <select class="select form-control" name="jenis_penghargaan" required>
                                            <option disabled selected value="">-- Pilih Jenis Penghargaan --</option>
                                            <option value="Bintang">Bintang</option>
                                            <option value="R.I Adipurna">R.I Adipurna</option>
                                            <option value="R.I Adipradana">R.I Adipradana</option>
                                            <option value="R.I Utama">R.I Utama</option>
                                            <option value="R.I Pratama">R.I Pratama</option>
                                            <option value="R.I Naraya">R.I Naraya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Perolehan</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="number" name="tahun_perolehan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Surat</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_surat" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_keputusan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="dropzone-box">
                                    <label>Dokumen Penghargaan</label>
                                    <div class="dropzone-area">
                                        <div class="file-upload-icon"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg></div>
                                        <p class="message-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_penghargaan" id="upload-file-form1">
                                        <p class="message-preview1">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
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
        <!-- /Tambah Riwayat Penghargaan Modal -->

        <!-- Edit Riwayat Penghargaan Modal -->
        <div id="edit_riwayat_penghargaan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Penghargaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/penghargaan/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Penghargaan</label>
                                        <small class="text-danger">*</small>
                                        <select class="form-control" name="jenis_penghargaan" id="e_jenis_penghargaan" required>
                                            <option value="Bintang">Bintang</option>
                                            <option value="R.I Adipurna">R.I Adipurna</option>
                                            <option value="R.I Adipradana">R.I Adipradana</option>
                                            <option value="R.I Utama">R.I Utama</option>
                                            <option value="R.I Pratama">R.I Pratama</option>
                                            <option value="R.I Naraya">R.I Naraya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Perolehan</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="number" name="tahun_perolehan" id="e_tahun_perolehan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Surat</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_surat" id="e_no_surat" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_keputusan" id="e_tanggal_keputusan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="dropzone-box">
                                    <label>Dokumen Penghargaan</label>
                                    <div class="dropzone-area">
                                        <div class="file-upload-icon"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg></div>
                                        <p class="message-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" class="form-control" id="dokumen_penghargaan" name="dokumen_penghargaan">
                                        <input type="hidden" name="hidden_dokumen_penghargaan" id="e_dokumen_penghargaan" value="">
                                        <p class="message-preview1">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
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
        <!-- /Edit Riwayat Penghargaan Modal -->

        <!-- Delete Riwayat Penghargaan Modal -->
        <div class="modal custom-modal fade" id="delete_riwayat_penghargaan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Penghargaan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/penghargaan/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_penghargaan" class="d_dokumen_penghargaan" value="">
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
        <!-- End Delete Riwayat Penghargaan Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/penghargaan.js') }}"></script>
        <script src="{{ asset('assets/js/draganddropRiwayatPenghargaan.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            history.pushState({}, "", '/riwayat/penghargaan');
        </script>

    @endsection
@endsection
