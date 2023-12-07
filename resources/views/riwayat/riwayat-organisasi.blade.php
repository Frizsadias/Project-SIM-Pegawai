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
                        <h3 class="page-title"> Riwayat Organisasi</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Organisasi</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_organisasi"><i
                                class="fa fa-plus"></i> Tambah Riwayat Organisasi</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('riwayat/organisasi/cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nama_organisasi" name="nama_organisasi">
                            <label class="focus-label">Nama Organisasi</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="jabatan_organisasi" name="jabatan_organisasi">
                            <label class="focus-label">Jabatan Organisasi</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="no_anggota" name="no_anggota">
                            <label class="focus-label">Nomor Anggota</label>
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
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Nama Organisasi</center></th>
                                    <th><center>Jabatan Organisasi</center></th>
                                    <th><center>Tanggal Gabung</center></th>
                                    <th><center>Tanggal Selesai</center></th>
                                    <th><center>Nomor Anggota</center></th>
                                    <th><center>Dokumen Organisasi</center></th>
                                    <th><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatOrganisasi as $sqlOrganisasi => $result_organisasi)
                                    <tr>
                                        <td><center>{{ ++$sqlOrganisasi }}</center></td>
                                        <td hidden class="id"><center>{{ $result_organisasi->id }}</center></td>
                                        <td class="nama_organisasi"><center>{{ $result_organisasi->nama_organisasi }}</center></td>
                                        <td class="jabatan_organisasi"><center>{{ $result_organisasi->jabatan_organisasi }}</center></td>
                                        <td class="tanggal_gabung"><center>{{ $result_organisasi->tanggal_gabung }}</center></td>
                                        <td class="tanggal_selesai"><center>{{ $result_organisasi->tanggal_selesai }}</center></td>
                                        <td class="no_anggota"><center>{{ $result_organisasi->no_anggota }}</center></td>
                                        <td class="dokumen_organisasi"><center>
                                            <a href="{{ asset('assets/DokumenOrganisasi/' . $result_organisasi->dokumen_organisasi) }}" target="_blank">
                                                @if (pathinfo($result_organisasi->dokumen_organisasi, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_organisasi">{{ $result_organisasi->dokumen_organisasi }}</td>
                                            </a></center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_organisasi" href="#"
                                                        data-toggle="modal" data-target="#edit_organisasi"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_organisasi" href="#"
                                                        data-toggle="modal" data-target="#delete_organisasi"><i
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

        <!-- Tambah Riwayat PMK Modal -->
        <div id="add_organisasi" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Organisasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/organisasi/tambah-data') }}" method="POST"
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
                                        <label>Nama Organisasi</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama_organisasi" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan di Organisasi</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="jabatan_organisasi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Bergabung</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_gabung" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_selesai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Anggota</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_anggota" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Organisasi</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_organisasi">
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
        <!-- /Tambah Riwayat Diklat Modal -->

        <!-- Edit Riwayat Diklat Modal -->
        <div id="edit_organisasi" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Organisasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/organisasi/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Organisasi</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama_organisasi" id="e_nama_organisasi" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan di Organisasi</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="jabatan_organisasi" id="e_jabatan_organisasi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Bergabung</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_gabung" id="e_tanggal_gabung" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_selesai" id="e_tanggal_selesai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Anggota</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_anggota" id="e_no_anggota" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Organisasi</label>
                                        <small class="text-danger">*</small>
                                        <input type="file" class="form-control" id="dokumen_organisasi" name="dokumen_organisasi">
                                        <input type="hidden" name="hidden_dokumen_organisasi" id="e_dokumen_organisasi" value="">
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
        <!-- /Edit Riwayat Diklat Modal -->

        <!-- Delete Riwayat Diklat Modal -->
        <div class="modal custom-modal fade" id="delete_organisasi" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Organisasi</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/organisasi/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_organisasi" class="d_dokumen_organisasi" value="">
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
        <!-- End Delete Riwayat Diklat Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/organisasi.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/riwayat/organisasi');
        </script>

    @endsection
@endsection
