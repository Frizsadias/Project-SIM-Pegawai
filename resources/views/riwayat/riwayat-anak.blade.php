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
                        <h3 class="page-title"> Riwayat Anak</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Anak</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_anak"><i
                                class="fa fa-plus"></i> Tambah Riwayat Anak</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('riwayat/anak/cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="nama_anak" name="nama_anak">
                        <label class="focus-label">Nama Anak</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <input type="date" class="form-control floating" id="tanggal_lahir" name="tanggal_lahir">
                        <label class="focus-label">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="theSelect" style="width: 100% !important" id="agama" name="agama">
                            <option selected disabled>-- Pilih Agama --</option>
                            @foreach($agamaOptions as $agamaOption)
                                <option value="{{ $agamaOption }}">{{ $agamaOption }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Agama</label>
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
                                    <th>Nama Orang Tua</th>
                                    <th>Status Pekerjaan Anak</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status Anak</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Nomor Dokumen</th>
                                    <th>Agama</th>
                                    <th>Status Hidup</th>
                                    <th>Nomor Akta Kelahiran</th>
                                    <th>Dokumen Akta Kelahiran</th>
                                    <th>Pas Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatAnak as $sqlAnak => $result_anak)
                                    <tr>
                                        <td><center>{{ ++$sqlAnak }}</center></td>
                                        <td hidden class="id"><center>{{ $result_anak->id }}</center></td>
                                        <td class="orang_tua"><center>{{ $result_anak->orang_tua }}</center></td>
                                        <td class="status_pekerjaan_anak"><center>{{ $result_anak->status_pekerjaan_anak }}</center></td>
                                        <td class="nama_anak"><center>{{ $result_anak->nama_anak }}</center></td>
                                        <td class="jenis_kelamin"><center>{{ $result_anak->jenis_kelamin }}</center></td>
                                        <td class="tanggal_lahir"><center>{{ $result_anak->tanggal_lahir }}</center></td>
                                        <td class="status_anak"><center>{{ $result_anak->status_anak }}</center></td>
                                        <td class="jenis_dokumen"><center>{{ $result_anak->jenis_dokumen }}</center></td>
                                        <td class="no_dokumen"><center>{{ $result_anak->no_dokumen }}</center></td>
                                        <td class="agama"><center>{{ $result_anak->agama }}</center></td>
                                        <td class="status_hidup"><center>{{ $result_anak->status_hidup }}</center></td>
                                        <td class="no_akta_kelahiran"><center>{{ $result_anak->no_akta_kelahiran }}</center></td>
                                        <td class="dokumen_akta_kelahiran"><center>
                                            <a href="{{ asset('assets/DokumenAktaKelahiran/' . $result_anak->dokumen_akta_kelahiran) }}" target="_blank">
                                                @if (pathinfo($result_anak->dokumen_akta_kelahiran, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_akta_kelahiran">{{ $result_anak->dokumen_akta_kelahiran }}</td>
                                            </a>
                                        </center></td>
                                        <td class="pas_foto"><center>
                                            <a href="{{ asset('assets/DokumenPasFotoAnak/' . $result_anak->pas_foto) }}" target="_blank">
                                                @if (in_array(pathinfo($result_anak->pas_foto, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="pas_foto">{{ $result_anak->pas_foto }}</td>
                                            </a>
                                        </center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_anak" href="#"
                                                        data-toggle="modal" data-target="#edit_anak"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_anak" href="#"
                                                        data-toggle="modal" data-target="#delete_anak"><i
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

        <!-- Tambah Riwayat Anak -->
        <div id="add_riwayat_anak" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Anak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/anak/tambah-data') }}" method="POST" enctype="multipart/form-data">
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
                                        <label class="col-form-label">Orang Tua (Pasangan)</label>
                                        <small class="text-danger">*</small>
                                        <br>
                                        <select class="select form-control" name="orang_tua">
                                            <option disabled selected value="">-- Pilih Nama Orang Tua --</option>
                                            @foreach ($userList as $user)
                                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pekerjaan Anak</label>
                                        <small class="text-danger">*</small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_anak"
                                                value="Bukan PNS" required>
                                            <label class="form-check-label">
                                                Bukan PNS
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_anak"
                                                value="PNS" required>
                                            <label class="form-check-label">
                                                PNS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Anak</label>
                                        <input class="form-control" type="text" name="nama_anak"
                                            placeholder="Masukkan nama anak" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="Laki-Laki" required>
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="Perempuan" required>
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Anak</label>
                                        <small class="text-danger">*</small><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_anak"
                                                value="Kandung" required>
                                            <label class="form-check-label">Kandung</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_anak" value="Tiri" required>
                                            <label class="form-check-label">Tiri</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_anak"
                                                value="Angkat" required>
                                            <label class="form-check-label">Angkat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Dokumen</label>
                                        <small class="text-danger">*</small>
                                        <select class="select form-control" name="jenis_dokumen" required>
                                            <option disabled selected value="">-- Pilih Jenis Dokumen --</option>
                                            <option value="KTP/KIA">KTP/KIA</option>
                                            <option value="Passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Dokumen</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_dokumen"
                                            placeholder="Masukkan nomor dokumen " required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <small class="text-danger">*</small>
                                        <br>
                                        <select class="theSelect" style="width: 100% !important" name="agama" required>
                                            <option selected disabled>-- Pilih Agama --</option>
                                            @foreach ($agamaOptions as $key => $result_agama)
                                                <option value="{{ $key }}">{{ $result_agama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Hidup</label>
                                        <small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_hidup" value="Hidup" required>
                                                Hidup
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_hidup" value="Meninggal" required>
                                                Meninggal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Akta Kelahiran</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_akta_kelahiran"
                                            placeholder="Masukkan nomor akta kelahiran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="dropzone-box-1">
                                    <label>Dokumen Akta Kelahiran</label>
                                    <div class="dropzone-area-1">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_akta_kelahiran" id="upload-file-form-1">
                                        <p class="info-draganddrop-1">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                                <div class="dropzone-box-2">
                                    <label>Pas Foto</label>
                                    <div class="dropzone-area-2">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm152 32c5.3 0 10.2 2.6 13.2 6.9l88 128c3.4 4.9 3.7 11.3 1 16.5s-8.2 8.6-14.2 8.6H216 176 128 80c-5.8 0-11.1-3.1-13.9-8.1s-2.8-11.2 .2-16.1l48-80c2.9-4.8 8.1-7.8 13.7-7.8s10.8 2.9 13.7 7.8l12.8 21.4 48.3-70.2c3-4.3 7.9-6.9 13.2-6.9z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input class="form-control" type="file" name="pas_foto" id="upload-file-form-2">
                                        <p class="info-draganddrop-2">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
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
        <!-- /Tambah Riwayat Anak Modal -->

        <!-- Edit Riwayat Anak Modal -->
        <div id="edit_anak" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Anak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/anak/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Orang Tua (Pasangan)</label>
                                        <small class="text-danger">*</small>
                                        <br>
                                        <select class="form-control" name="orang_tua" id="e_orang_tua">
                                            <option disabled selected value="">-- Pilih Nama Orang Tua --</option>
                                            @foreach ($userList as $user)
                                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pekerjaan Anak</label>
                                        <small class="text-danger">*</small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_anak" id="bukan_pns"
                                                value="Bukan PNS" required>
                                            <label class="form-check-label">
                                                Bukan PNS
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_anak" id="pns"
                                                value="PNS" required>
                                            <label class="form-check-label">
                                                PNS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Anak</label>
                                        <input class="form-control" type="text" name="nama_anak" id="e_nama_anak"
                                            placeholder="Masukkan nama anak" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-Laki" required>
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_lahir" id="e_tanggal_lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Anak</label>
                                        <small class="text-danger">*</small><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_anak" id="kandung"
                                                value="Kandung" required>
                                            <label class="form-check-label" for="kandung">Kandung</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_anak"
                                                id="tiri" value="Tiri" required>
                                            <label class="form-check-label" for="tiri">Tiri</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_anak"
                                                id="angkat" value="Angkat" required>
                                            <label class="form-check-label" for="angkat">Angkat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Dokumen</label>
                                        <small class="text-danger">*</small>
                                        <select class="form-control" name="jenis_dokumen" id="e_jenis_dokumen" required>
                                            <option value="KTP/KIA">KTP/KIA</option>
                                            <option value="Passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Dokumen</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_dokumen" id="e_no_dokumen"
                                            placeholder="Masukkan nomor dokumen " required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <small class="text-danger">*</small>
                                        <br>
                                        <select class="theSelect" style="width: 100% !important" name="agama" id="e_agama" required>
                                            <option selected disabled>-- Pilih Agama --</option>
                                            @foreach ($agamaOptions as $id => $result_agama)
                                                @if (!empty($result_anak->agama))
                                                    <option value="{{ $id }}" {{ $id == $result_anak->agama ? 'selected' : '' }}>{{ $result_agama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Hidup</label>
                                        <small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_hidup" id="hidup" value="Hidup" required>
                                                Hidup
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_hidup" id="meninggal" value="Meninggal" required>
                                                Meninggal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Akta Kelahiran</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_akta_kelahiran" id="e_no_akta_kelahiran"
                                            placeholder="Masukkan nomor akta kelahiran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="dropzone-box-3">
                                    <label>Dokumen Akta Kelahiran</label>
                                    <div class="dropzone-area-3">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" name="dokumen_akta_kelahiran" id="dokumen_akta_kelahiran">
                                        <input type="hidden" name="hidden_dokumen_akta_kelahiran" id="e_dokumen_akta_kelahiran" value="">
                                        <p class="info-draganddrop-3">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                </div>
                                <div class="dropzone-box-4">
                                    <label>Pas Foto</label>
                                    <div class="dropzone-area-4">
                                        <div class="file-upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm152 32c5.3 0 10.2 2.6 13.2 6.9l88 128c3.4 4.9 3.7 11.3 1 16.5s-8.2 8.6-14.2 8.6H216 176 128 80c-5.8 0-11.1-3.1-13.9-8.1s-2.8-11.2 .2-16.1l48-80c2.9-4.8 8.1-7.8 13.7-7.8s10.8 2.9 13.7 7.8l12.8 21.4 48.3-70.2c3-4.3 7.9-6.9 13.2-6.9z"/></svg>
                                        </div>
                                        <p class="info-pesan-form">Klik untuk mengunggah atau seret dan lepas</p>
                                        <input type="file" id="pas_foto" name="pas_foto">
                                        <input type="hidden" name="hidden_pas_foto" id="e_pas_foto" value="">
                                        <p class="info-draganddrop-4">Tidak ada file yang di pilih</p>
                                    </div>
                                    <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
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
        <!-- /Edit Riwayat Anak Modal -->

        <!-- Delete Riwayat Anak Modal -->
        <div class="modal custom-modal fade" id="delete_anak" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Anak</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/anak/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_akta_kelahiran" class="d_dokumen_akta_kelahiran" value="">
                                <input type="hidden" name="pas_foto" class="d_pas_foto" value="">
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
        <!-- End Delete Riwayat Anak Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/anak.js') }}"></script>
        <script src="{{ asset('assets/js/drag-drop-file.js') }}"></script>
        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/riwayat/anak');
        </script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Riwayat Anak | Aplikasi SILK';
        </script>
        
    @endsection
@endsection
