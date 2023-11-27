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
                        <h3 class="page-title"> Riwayat Orang Tua</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Orang Tua</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_ortu"><i
                                class="fa fa-plus"></i> Tambah Riwayat Orang Tua</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            {{-- <form action="{{ route('riwayat/pmk/cari') }}" method="GET" id="search-form">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="jenis_pmk" name="jenis_pmk">
                                <option selected disabled>-- Pilih Jenis Peninjauan Masa Kerja --</option>
                                @foreach ($jenisPasanganOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Jenis Pasangan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nama_Pasangan" name="nama_Pasangan">
                            <label class="focus-label">Nama Pasangan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="institusi_penyelenggara" name="institusi_penyelenggara">
                            <label class="focus-label">Iinstitusi Penyelenggara</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form> --}}

            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="tableAngkaKredit">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status Hidup</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status Pernikahan</th>
                                    <th>Dokumen Kartu Keluarga</th>
                                    <th>Dokumen Akta Anak</th>
                                    <th>Pas Foto Ayah</th>
                                    <th>Pas Foto Ibu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatOrtu as $sqlOrtu => $result_Ortu)
                                    <tr>
                                        <td><center>{{ ++$sqlOrtu }}</center></td>
                                        <td hidden class="id"><center>{{ $result_Ortu->id }}</center></td>
                                        <td class="status_hidup"><center>{{ $result_Ortu->status_hidup }}</center></td>
                                        <td class="nama"><center>{{ $result_Ortu->nama }}</center></td>
                                        <td class="jenis_kelamin"><center>{{ $result_Ortu->jenis_kelamin }}</center></td>
                                        <td class="status_pernikahan"><center>{{ $result_Ortu->status_pernikahan }}</center></td>
                                        <td hidden class="alamat"><center>{{ $result_Ortu->alamat }}</center></td>
                                        <td class="dokumen_kk"><center>
                                            <a href="{{ asset('assets/DokumenKartuKeluarga/' . $result_Ortu->dokumen_kk) }}" target="_blank">
                                                @if (pathinfo($result_Ortu->dokumen_kk, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_kk">{{ $result_Ortu->dokumen_kk }}</td>
                                            </a></center></td>
                                        <td class="dokumen_akta_lahir_anak"><center>
                                            <a href="{{ asset('assets/DokumenAktaLahirAnak/' . $result_Ortu->dokumen_akta_lahir_anak) }}" target="_blank">
                                                @if (pathinfo($result_Ortu->dokumen_akta_lahir_anak, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_akta_lahir_anak">{{ $result_Ortu->dokumen_akta_lahir_anak }}</td>
                                            </a></center></td>
                                        <td class="pas_foto_ayah"><center>
                                            <a href="{{ asset('assets/DokumenPasFotoAyah/' . $result_Ortu->pas_foto_ayah) }}" target="_blank">
                                                @if (in_array(pathinfo($result_Ortu->pas_foto_ayah, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                <td hidden class="pas_foto_ayah">{{ $result_Ortu->pas_foto_ayah }}</td>
                                            </a>
                                        <td class="pas_foto_ibu"><center>
                                            <a href="{{ asset('assets/DokumenPasFotoIbu/' . $result_Ortu->pas_foto_ibu) }}" target="_blank">
                                                @if (in_array(pathinfo($result_Ortu->pas_foto_ibu, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                <td hidden class="pas_foto_ibu">{{ $result_Ortu->pas_foto_ibu }}</td>
                                            </a>
                                            <td hidden class="nip"><center>{{ $result_Ortu->nip }}</center></td>
                                            <td hidden class="tanggal_lahir"><center>{{ $result_Ortu->tanggal_lahir }}</center></td>
                                            <td hidden class="status_pekerjaan_ortu"><center>{{ $result_Ortu->status_pekerjaan_ortu }}</center></td>
                                            <td hidden class="tanggal_meninggal"><center>{{ $result_Ortu->tanggal_meninggal }}</center></td>
                                            <td hidden class="jenis_identitas"><center>{{ $result_Ortu->jenis_identitas }}</center></td>
                                            <td hidden class="no_hp"><center>{{ $result_Ortu->no_hp }}</center></td>
                                            <td hidden class="no_telepon"><center>{{ $result_Ortu->no_telepon }}</center></td>
                                            <td hidden class="agama"><center>{{ $result_Ortu->agama }}</center></td>
                                            <td hidden class="email"><center>{{ $result_Ortu->email }}</center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_ortu" href="#"
                                                        data-toggle="modal" data-target="#edit_ortu"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_ortu" href="#"
                                                        data-toggle="modal" data-target="#delete_ortu"><i
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

        <!-- Tambah Riwayat Orang Tua -->
        <div id="add_riwayat_ortu" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Orang Tua</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/orangtua/tambah-data') }}" method="POST"
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
                                        <label>Status Hidup</label><small class="text-danger">*</small>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pekerjaan Orang Tua</label><small class="text-danger">*</small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_ortu"
                                                value="Bukan PNS" required>
                                            <label class="form-check-label">
                                                Bukan PNS
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_ortu"
                                                value="PNS" required>
                                            <label class="form-check-label">
                                                PNS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="show_nip" style="display:none;">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control" type="text" name="nip"
                                            placeholder="Masukkan NIP">
                                    </div>
                                </div>
                                <div class="col-md-6" id="tanggal-meninggal" style="display:none;">
                                    <div class="form-group">
                                        <label>Tanggal Meninggal</label>
                                        <input class="form-control" type="date" name="tanggal_meninggal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama"
                                            placeholder="Masukkan nama orang tua" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label><small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_lahir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Identitas</label><small class="text-danger">*</small>
                                        <select class="form-control" name="jenis_identitas" required>
                                            <option disabled selected value="">-- Pilih Jenis Identitas --</option>
                                            <option value="KTP/KIA">KTP/KIA</option>
                                            <option value="Passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label><small class="text-danger">*</small>
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
                                        <label>Agama</label><small class="text-danger">*</small>
                                        <select class="form-control" name="agama" required>
                                            <option disabled selected value="">-- Pilih Agama --</option>
                                            @foreach ($agamaOptions as $agama)
                                                <option value="{{ $agama }}">{{ $agama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pernikahan</label><small class="text-danger">*</small>
                                        <select class="form-control" name="status_pernikahan" required>
                                            <option disabled selected value="">-- Pilih Status Pernikahan --</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Cerai Hidup">Cerai Hidup</option>
                                            <option value="Cerai Mati">Cerai Mati</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="alamat"
                                            placeholder="Masukkan alamat orang tua" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><small class="text-danger">*</small>
                                        <input class="form-control" type="email" name="email"
                                            placeholder="Masukkan email orang tua" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor HP</label><small class="text-danger">*</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input class="form-control" type="number" name="no_hp"
                                                placeholder="Masukkan nomor HP orang tua" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Telepon</label><small class="text-danger">*</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input class="form-control" type="number" name="no_telepon"
                                                placeholder="Masukkan nomor telepon orang tua" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Kartu Keluarga</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_kk">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Kartu Keluarga</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_akta_lahir_anak">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pas Foto Ayah</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="pas_foto_ayah">
                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pas Foto Ibu</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="pas_foto_ibu">
                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
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
        <!-- /Tambah Riwayat Orang Tua Modal -->

        <!-- Edit Riwayat Orang Tua Modal -->
        <div id="edit_ortu" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Orang Tua</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/orangtua/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Hidup</label><small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_hidup" value="Hidup" id="e_hidup" required>
                                                Hidup
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_hidup" value="Meninggal" id="e_meninggal" required>
                                                Meninggal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pekerjaan Orang Tua</label><small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_pekerjaan_ortu" value="Bukan PNS" id="bukan_pns" required>
                                                Bukan PNS
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_pekerjaan_ortu" value="PNS" id="e_pns" required>
                                                PNS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control" type="text" name="nip" id="e_nip"
                                            placeholder="Masukkan NIP">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Meninggal</label>
                                        <input class="form-control" type="date" name="tanggal_meninggal" id="e_tanggal_meninggal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama" id="e_nama"
                                            placeholder="Masukkan nama orang tua" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label><small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_lahir" id="e_tanggal_lahir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Identitas</label><small class="text-danger">*</small>
                                        <select class="form-control" name="jenis_identitas" id="e_jenis_identitas" required>
                                            <option disabled selected value="">-- Pilih Jenis Identitas --</option>
                                            <option value="KTP/KIA">KTP/KIA</option>
                                            <option value="Passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label><small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="Laki-Laki" id="e_laki_laki" required>
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="Perempuan" id="e_perempuan" required>
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agama</label><small class="text-danger">*</small>
                                        <select class="form-control" name="agama" id="e_agama" required>
                                            <option disabled selected value="">-- Pilih Agama --</option>
                                            @foreach ($agamaOptions as $agama)
                                                <option value="{{ $agama }}">{{ $agama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pernikahan</label><small class="text-danger">*</small>
                                        <select class="form-control" name="status_pernikahan" id="e_status_pernikahan" required>
                                            <option disabled selected value="">-- Pilih Status Pernikahan --</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Cerai Hidup">Cerai Hidup</option>
                                            <option value="Cerai Mati">Cerai Mati</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="alamat" id="e_alamat"
                                            placeholder="Masukkan alamat orang tua" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><small class="text-danger">*</small>
                                        <input class="form-control" type="email" name="email" id="e_email"
                                            placeholder="Masukkan email orang tua" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor HP</label><small class="text-danger">*</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input class="form-control" type="number" name="no_hp" id="e_no_hp"
                                                placeholder="Masukkan nomor HP orang tua" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Telepon</label><small class="text-danger">*</small>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input class="form-control" type="number" name="no_telepon" id="e_no_telepon"
                                            placeholder="Masukkan nomor telepon orang tua" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Kartu Keluarga</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_kk" id="dokumen_kk">
                                        <input type="hidden" name="hidden_dokumen_kk" id="e_dokumen_kk"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Kartu Keluarga</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_akta_lahir_anak" id="dokumen_akta_lahir_anak">
                                        <input type="hidden" name="hidden_dokumen_akta_lahir_anak" id="e_dokumen_akta_lahir_anak"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pas Foto Ayah</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="pas_foto_ayah" id="pas_foto_ayah">
                                        <input type="hidden" name="hidden_pas_foto_ayah" id="e_pas_foto_ayah"
                                            value="">
                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pas Foto Ibu</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="pas_foto_ibu" id="pas_foto_ibu">
                                        <input type="hidden" name="hidden_pas_foto_ibu" id="e_pas_foto_ibu"
                                            value="">
                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
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
        <!-- /Edit Riwayat Orang Tua Modal -->

        <!-- Delete Riwayat Orang Tua Modal -->
        <div class="modal custom-modal fade" id="delete_ortu" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Orang Tua</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/orangtua/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_kk" class="d_dokumen_kk" value="">
                                <input type="hidden" name="dokumen_akta_lahir_anak" class="d_dokumen_akta_lahir_anak" value="">
                                <input type="hidden" name="pas_foto_ayah" class="d_pas_foto_ayah" value="">
                                <input type="hidden" name="pas_foto_ibu" class="d_pas_foto_ibu" value="">
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
        <!-- End Delete Riwayat Orang Tua Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableAngkaKredit').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get-angkakredit-data') }}",
                        "data": function(d) {
                            d.keyword = $('#keyword').val();
                            d._token = "{{ csrf_token() }}";
                        }
                    },
                    "columns": [
                        {
                            "data": "id"
                        },
                        {
                            "data": "nama_jabatan"
                        },
                        {
                            "data": "nomor_sk"
                        },
                        {
                            "data": "tanggal_sk"
                        },
                        {
                            "data": "angka_kredit_pertama"
                        },
                        {
                            "data": "integrasi"
                        },
                        {
                            "data": "konversi"
                        },
                        {
                            "data": "bulan_mulai"
                        },
                        {
                            "data": "tahun_mulai"
                        },
                        {
                            "data": "bulan_selesai"
                        },
                        {
                            "data": "tahun_selesai"
                        },
                        {
                            "data": "angka_kredit_utama"
                        },
                        {
                            "data": "angka_kredit_penunjang"
                        },
                        {
                            "data": "total_angka_kredit"
                        },
                        {
                            "data": "action"
                        },
                    ],
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Tidak ada data",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "Cari:",
                        "paginate": {
                            "previous": "Previous",
                            "next": "Next",
                            "first": "<<",
                            "last": ">>",
                        }
                    },
                    "order": [
                        [0, "asc"]
                    ]
                });

                // Live search
                $('#search-form').on('submit', function(e) {
                    e.preventDefault();
                    table
                        .search($('#keyword').val())
                        .draw();
                })
            });
        </script> --}}
    {{-- update --}}
    <script>
    $(document).on('click', '.edit_ortu', function() {
    var _this = $(this).parents('tr');
 
    // Isi nilai `id` dari input hidden pada form dengan nilai `id` dari row yang dipilih
    $('#e_id').val(_this.find('.id').text());
    $('#e_nama').val(_this.find('.nama').text());
    $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
    $('#e_jenis_identitas').val(_this.find('.jenis_identitas').text());
 
    // Isi nilai radio button jenis kelamin berdasarkan nilai dari row yang dipilih
    var jenisKelamin = _this.find('.jenis_kelamin').text();
    if (jenisKelamin === 'Laki-Laki') {
        $('#e_laki_laki').prop('checked', true);
    } else if (jenisKelamin === 'Perempuan') {
        $('#e_perempuan').prop('checked', true);
    }
 
    $('#e_agama').val(_this.find('.agama').text());
    $('#e_status_pernikahan').val(_this.find('.status_pernikahan').text());
    $('#e_alamat').val(_this.find('.alamat').text());
    $('#e_email').val(_this.find('.email').text());
    $('#e_nip').val(_this.find('.nip').text());
    $('#e_tanggal_meninggal').val(_this.find('.tanggal_meninggal').text());
    $('#e_no_hp').val(_this.find('.no_hp').text());
    $('#e_no_telepon').val(_this.find('.no_telepon').text());
    var statusHidup = _this.find('.status_hidup').text();
    if (statusHidup === 'Hidup') {
        $('#e_hidup').prop('checked', true);
    } else if (statusHidup === 'Meninggal') {
        $('#e_meninggal').prop('checked', true);
    }

    var statusPekerjaan = _this.find('.status_pekerjaan_ortu').text();
if (statusPekerjaan === 'Bukan PNS') {
    $('#bukan_pns').prop('checked', true);
} else if (statusPekerjaan === 'PNS') {
    $('#e_pns').prop('checked', true);
}



    $('#e_dokumen_kk').val(_this.find('.dokumen_kk').text());
    $('#e_hidden_dokumen_kk').val(_this.find('.dokumen_kk').text());
 
    $('#e_dokumen_akta_lahir_anak').val(_this.find('.dokumen_akta_lahir_anak').text());
    $('#e_hidden_dokumen_akta_lahir_anak').val(_this.find('.dokumen_akta_lahir_anak').text());
 
    $('#e_pas_foto_ayah').val(_this.find('.pas_foto_ayah').text());
    $('#e_hidden_pas_foto_ayah').val(_this.find('.pas_foto_ayah').text());
 
    $('#e_pas_foto_ibu').val(_this.find('.pas_foto_ibu').text());
    $('#e_hidden_pas_foto_ibu').val(_this.find('.pas_foto_ibu').text());
});
    </script>


    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_ortu', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_kk').val(_this.find('.dokumen_kk').text());
            $('.d_dokumen_akta_lahir_anak').val(_this.find('.dokumen_akta_lahir_anak').text());
            $('.d_pas_foto_ayah').val(_this.find('.pas_foto_ayah').text());
            $('.d_pas_foto_ibu').val(_this.find('.pas_foto_ibu').text());
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(".theSelect").select2();
    </script>

    <script>
        history.pushState({}, "", '/riwayat/orangtua');
    </script>

    <script>
        $(document).ready(function() {
            $('input[name="status_hidup"]').click(function() {
                if ($(this).val() == 'Hidup') {
                    $('#tanggal-meninggal').hide();
                } else {
                    $('#tanggal-meninggal').show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('input[name="status_pekerjaan_ortu"]').click(function() {
                if ($(this).val() === "PNS") {
                    $('#show_nip').show();
                } else {
                    $('#show_nip').hide();
                }
            });
        });
    </script>
@endsection
@endsection
