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
                        <h3 class="page-title">SPK Perawat</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">SPK Perawat</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_spk_perawat"><i class="fa fa-plus"></i> Tambah SPK Perawat</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            {{-- Export Excel --}}
            <form action="{{ route('export-spk-perawat') }}" method="GET">
                <button type="submit" name="export" value="true" class="btn btn-success">
                    <i class="fa fa-file-excel"></i> Export Excel
                </button>
            </form><br>

            <!-- Search Filter -->
            <form action="{{ route('spk-perawat-admin-cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name">
                            <label class="focus-label">Nama Pegawai</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="nip">
                            <label class="focus-label">NIP</label>
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Unit Kerja</th>
                                    <th>Nomor SPK</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Tanggal Berlaku</th>
                                    <th>SPK Jabatan</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Ruangan</th>
                                    <th>Dokumen SPK</th>
                                    <th class="text-right no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_spk_perawat as $sql_spk_perawat => $result_spk_perawat)
                                    <tr>
                                        <td>{{ ++$sql_spk_perawat }}</td>
                                        <td hidden class="id">{{ $result_spk_perawat->id }}</td>
                                        <td class="name">{{ $result_spk_perawat->name }}</td>
                                        <td class="nip">{{ $result_spk_perawat->nip }}</td>
                                        <td class="unit_kerja">{{ $result_spk_perawat->unit_kerja }}</td>
                                        <td class="nomor_sip">{{ $result_spk_perawat->nomor_sip }}</td>
                                        <td class="tanggal_terbit">{{ $result_spk_perawat->tanggal_terbit }}</td>
                                        <td class="tanggal_berlaku">{{ $result_spk_perawat->tanggal_berlaku }}</td>
                                        <td class="sip_spk_jabatan">{{ $result_spk_perawat->sip_spk_jabatan }}</td>
                                        <td class="jenis_dokumen">{{ $result_spk_perawat->jenis_dokumen }}</td>
                                        <td class="ruangan">{{ $result_spk_perawat->ruangan }}</td>
                                        <td class="dokumen_sip">
                                            <a href="{{ asset('assets/DokumenSPKPerawat/' . $result_spk_perawat->dokumen_sip) }}"
                                                target="_blank">
                                                @if (pathinfo($result_spk_perawat->dokumen_sip, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;"
                                                        aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;"
                                                        aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_sip">{{ $result_spk_perawat->dokumen_sip }}</td>
                                            </a>
                                        </td>

                                        {{-- Edit Layanan SPK Perawat --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_spk_perawat" href="#" data-toggle="modal" data-target="#edit_spk_perawat"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item delete_spk_perawat" href="#" data-toggle="modal" data-target="#delete_spk_perawat"><i class="fa fa-trash-o m-r-5"></i>Delete</a>
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

        <!-- Tambah SPK Perawat Modal -->
        <div id="daftar_spk_perawat" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah SPK Perawat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi/spk-perawat/tambah-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nama Pegawai</label>
                                        <select class="select" id="name" name="name">
                                            <option selected disabled>-- Pilih Nama Pegawai --</option>
                                            @foreach ($userList as $key => $user)
                                                <option value="{{ $user->name }}" data-user_id={{ $user->user_id }} data-nip={{ $user->nip }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">ID Pengguna <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="ID pengguna otomatis terisi" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NIP <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="nip" name="nip" placeholder="NIP otomatis terisi" readonly>
                                    </div>
                                </div>
                                {{-- <label>Jabatan</label> --}}
                                <input type="hidden" class="form-control" name="sip_spk_jabatan" value="Perawat" readonly>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <input type="text" class="form-control" name="unit_kerja" placeholder="Unit Kerja">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SPK</label>
                                        <input type="text" class="form-control" name="nomor_sip" placeholder="Nomor SPK">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" class="form-control" name="tanggal_terbit">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Berlaku</label>
                                        <input type="date" class="form-control" name="tanggal_berlaku">
                                    </div>
                                </div>
                                {{-- <label>Jenis Dokumen</label> --}}
                                <input type="hidden" class="form-control" name="jenis_dokumen" value="SPK Perawat" readonly>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <br>
                                        <select class="theSelect" name="ruangan" style="width: 100% !important">
                                            <option selected disabled>-- Pilih Ruangan --</option>
                                            @foreach($ruanganOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SPK</label>
                                        <input type="file" class="form-control" name="dokumen_sip">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Tambah SPK Perawat Modal -->

        <!-- Edit SPK Perawat Modal -->
        <div id="edit_spk_perawat" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit SPK Perawat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi/spk-perawat/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <input type="text" class="form-control" name="unit_kerja" id="e_unit_kerja" placeholder="Unit Kerja" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SPK</label>
                                        <input type="text" class="form-control" name="nomor_sip" id="e_nomor_sip" placeholder="Nomor SPK" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" class="form-control" name="tanggal_terbit" id="e_tanggal_terbit" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Berlaku</label>
                                        <input type="date" class="form-control" name="tanggal_berlaku" id="e_tanggal_berlaku" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <br>
                                        <select class="theSelect" name="ruangan" id="e_ruangan" style="width: 100% !important">
                                            <option selected disabled>-- Pilih Ruangan --</option>
                                            @foreach($ruanganOptions as $key => $value)
                                                @if (!empty($result_spk_perawat->ruangan))
                                                    <option value="{{ $key }}" {{ $key == $result_spk_perawat->ruangan ? 'selected' : '' }}>{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SPK</label>
                                        <input type="file" class="form-control" id="dokumen_sip" name="dokumen_sip">
                                        <input type="hidden" name="hidden_dokumen_sip" id="e_dokumen_sip" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit SPK Perawat Modal -->

        <!-- Delete SPK Perawat Modal -->
        <div class="modal custom-modal fade" id="delete_spk_perawat" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus SPK Perawat</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('transaksi/spk-perawat/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_sip" class="d_dokumen_spk_perawat" value="">
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
        <!-- /Delete SPK Perawat Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/spkperawat.js') }}"></script>
        
        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/transaksi/spk-perawat-admin');
        </script>
    
    @endsection
@endsection
