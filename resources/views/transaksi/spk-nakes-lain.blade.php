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
                        <h3 class="page-title">SPK Nakes Lain</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">SPK Nakes Lain</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_spk_nakes_lain"><i class="fa fa-plus"></i> Tambah SPK Nakes Lain</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('spk-nakes-lain-cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="nomor_sip">
                            <label class="focus-label">Nomor SPK Nakes Lain</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <input type="date" class="form-control floating" name="tanggal_terbit">
                            <label class="focus-label">Tanggal Terbit</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <input type="date" class="form-control floating" name="tanggal_berlaku">
                            <label class="focus-label">Tanggal Berlaku</label>
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
                                @foreach ($data_spk_nakes_lain as $sqlspk_nakes => $result_spk_nakes)
                                    <tr>
                                        <td>{{ ++$sqlspk_nakes }}</td>
                                        <td hidden class="id">{{ $result_spk_nakes->id }}</td>
                                        <td class="name">{{ $result_spk_nakes->name }}</td>
                                        <td class="nip">{{ $result_spk_nakes->nip }}</td>
                                        <td class="unit_kerja">{{ $result_spk_nakes->unit_kerja }}</td>
                                        <td class="nomor_sip">{{ $result_spk_nakes->nomor_sip }}</td>
                                        <td class="tanggal_terbit">{{ $result_spk_nakes->tanggal_terbit }}</td>
                                        <td class="tanggal_berlaku">{{ $result_spk_nakes->tanggal_berlaku }}</td>
                                        <td class="sip_spk_jabatan">{{ $result_spk_nakes->sip_spk_jabatan }}</td>
                                        <td class="jenis_dokumen">{{ $result_spk_nakes->jenis_dokumen }}</td>
                                        <td class="ruangan">{{ $result_spk_nakes->ruangan }}</td>
                                        <td class="dokumen_sip">
                                            <a href="{{ asset('assets/DokumenSPKNakesLain/' . $result_spk_nakes->dokumen_sip) }}" target="_blank">
                                                @if (pathinfo($result_spk_nakes->dokumen_sip, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_sip">{{ $result_spk_nakes->dokumen_sip }}</td>
                                            </a>
                                        </td>

                                        {{-- Edit Layanan Nakes Lain --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_spk_nakes_lain" href="#" data-toggle="modal" data-target="#edit_spk_nakes_lain"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item delete_spk_nakes_lain" href="#" data-toggle="modal" data-target="#delete_spk_nakes_lain"><i class="fa fa-trash-o m-r-5"></i>Delete</a>
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

        <!-- Tambah Nakes Lain Modal -->
        <div id="daftar_spk_nakes_lain" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah SPK Nakes Lain</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi/spk-nakes-lain/tambah-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                            @foreach ($data_profil_sip as $result_profil_sip)
                                <div class="row">
                                    {{-- <label>Nama</label> --}}
                                    <input type="hidden" class="form-control" name="name" value="{{ $result_profil_sip->name }}" readonly>
                                    {{-- <label>NIP</label> --}}
                                    <input type="hidden" class="form-control" name="nip" value="{{ $result_profil_sip->nip }}" readonly>
                                </div>
                            @endforeach
                            <div class="row">
                                {{-- <label>Jabatan</label> --}}
                                <input type="hidden" class="form-control" name="sip_spk_jabatan" value="Nakes Lain" readonly>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <input type="text" class="form-control" name="unit_kerja" placeholder="Unit Kerja">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SPK</label>
                                        <input type="text" class="form-control" name="nomor_sip" placeholder="Nomor SPK">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" class="form-control" name="tanggal_terbit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Berlaku</label>
                                        <input type="date" class="form-control" name="tanggal_berlaku">
                                    </div>
                                </div>
                                {{-- <label>Jenis Dokumen</label> --}}
                                <input type="hidden" class="form-control" name="jenis_dokumen" value="SPK Nakes Lain" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <br>
                                        <select class="theSelect" style="width: 100% !important" name="ruangan">
                                            <option selected disabled>-- Pilih Ruangan --</option>
                                            @foreach($ruanganOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="dropzone-box-1">
                                    <label>Dokumen SPK</label>
                                    <div class="dropzone-area-1">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_sip" id="upload-file-form-1">
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
        <!-- /Tambah Nakes Lain Modal -->

        <!-- Edit Nakes Lain Modal -->
        <div id="edit_spk_nakes_lain" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit SPK Nakes Lain</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi/spk-nakes-lain/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <input type="text" class="form-control" name="unit_kerja" id="e_unit_kerja" placeholder="Unit Kerja">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SPK</label>
                                        <input type="text" class="form-control" name="nomor_sip" id="e_nomor_sip" placeholder="Nomor SIP">
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
                                        <select class="theSelect" style="width: 100% !important" name="ruangan" id="e_ruangan">
                                            <option selected disabled>-- Pilih Ruangan --</option>
                                            @foreach($ruanganOptions as $key => $value)
                                                @if (!empty($result_spk_nakes->ruangan))
                                                    <option value="{{ $key }}" {{ $key == $result_spk_nakes->ruangan ? 'selected' : '' }}>{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="dropzone-box-2">
                                    <label>Dokumen SPK</label>
                                    <div class="dropzone-area-2">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" id="dokumen_sip" name="dokumen_sip">
                                        <input type="hidden" name="hidden_dokumen_sip" id="e_dokumen_sip" value="">
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
        <!-- /Edit Nakes Lain Modal -->

        <!-- Delete Nakes Lain Modal -->
        <div class="modal custom-modal fade" id="delete_spk_nakes_lain" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus SPK Nakes Lain</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('transaksi/spk-nakes-lain/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_sip" class="d_dokumen_sip" value="">
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
        <!-- /Delete Nakes Lain Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/spknakeslain.js') }}"></script>
        <script src="{{ asset('assets/js/drag-drop-file.js') }}"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/transaksi/spk-nakes-lain');
        </script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Layanan SPK Nakes Lain | Aplikasi SILK';
        </script>

                
    @endsection
@endsection
