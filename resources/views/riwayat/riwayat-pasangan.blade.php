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
                        <h3 class="page-title"> Riwayat Pasangan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Pasangan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_pasangan"><i
                                class="fa fa-plus"></i> Tambah Riwayat Pasangan</a>
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
                                    <th>Nama Pasangan</th>
                                    <th>Status Pekerjaan Pasangan</th>
                                    <th>Status Pernikahan</th>
                                    <th>Status Hidup</th>
                                    <th>Dokumen Nikah</th>
                                    <th>Pas Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPasangan as $sqlPasangan => $result_pasangan)
                                    <tr>
                                        <td><center>{{ ++$sqlPasangan }}</center></td>
                                        <td hidden class="id"><center>{{ $result_pasangan->id }}</center></td>
                                        <td class="nama"><center>{{ $result_pasangan->nama }}</center></td>
                                        <td class="status_pekerjaan_pasangan"><center>{{ $result_pasangan->status_pekerjaan_pasangan }}</center></td>
                                        <td class="status_pernikahan"><center>{{ $result_pasangan->status_pernikahan }}</center></td>
                                        <td class="status_hidup"><center>{{ $result_pasangan->status_hidup }}</center></td>
                                        <td class="dokumen_nikah"><center>
                                            <a href="{{ asset('assets/DokumenNikah/' . $result_pasangan->dokumen_nikah) }}" target="_blank">
                                                @if (pathinfo($result_pasangan->dokumen_nikah, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_nikah">{{ $result_pasangan->dokumen_nikah }}</td>
                                            </a></center></td>
                                            <td class="pas_foto"><center>
                                            <a href="{{ asset('assets/DokumenPasFotoPasangan/' . $result_pasangan->pas_foto) }}" target="_blank">
                                                @if (in_array(pathinfo($result_pasangan->pas_foto, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                <td hidden class="pas_foto">{{ $result_pasangan->pas_foto }}</td>
                                            </a>
                                            <td hidden class="suami_istri_ke"><center>{{ $result_pasangan->suami_istri_ke }}</center></td>
                                            <td hidden class="nip"><center>{{ $result_pasangan->nip }}</center></td>
                                            <td hidden class="tanggal_lahir"><center>{{ $result_pasangan->tanggal_lahir }}</center></td>
                                            <td hidden class="jenis_kelamin"><center>{{ $result_pasangan->jenis_kelamin }}</center></td>
                                            <td hidden class="jenis_identitas"><center>{{ $result_pasangan->jenis_identitas }}</center></td>
                                            <td hidden class="no_hp"><center>{{ $result_pasangan->no_hp }}</center></td>
                                            <td hidden class="no_telepon"><center>{{ $result_pasangan->no_telepon }}</center></td>
                                            <td hidden class="agama"><center>{{ $result_pasangan->agama }}</center></td>
                                            <td hidden class="email"><center>{{ $result_pasangan->email }}</center></td>
                                            <td hidden class="no_karis_karsu"><center>{{ $result_pasangan->no_karis_karsu }}</center></td>
                                            <td hidden class="alamat"><center>{{ $result_pasangan->alamat }}</center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_pasangan" href="#"
                                                        data-toggle="modal" data-target="#edit_pasangan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_pasangan" href="#"
                                                        data-toggle="modal" data-target="#delete_pasangan"><i
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

        <!-- Tambah Riwayat Pasangan -->
        <div id="add_riwayat_pasangan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Pasangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/pasangan/tambah-data') }}" method="POST"
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
                                        <label>Suami/Istri ke</label><small class="text-danger">*</small>
                                        <select class="form-control" name="suami_istri_ke" required>
                                            <option disabled selected value="">-- Pilih Suami/Istri ke --</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pekerjaan Pasangan</label><small class="text-danger">*</small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_pasangan"
                                             value="Bukan PNS" required>
                                            <label class="form-check-label">
                                                Bukan PNS
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_pekerjaan_pasangan"
                                             value="PNS" required>
                                            <label class="form-check-label">
                                                PNS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control" type="text" name="nip"
                                            placeholder="Jika status pasangan bukan PNS isi dengan -" required>
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
                                        <label>Nama</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama"
                                            placeholder="Masukkan nama pasangan" required>
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
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Karsu/Karis</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_karis_karsu"
                                            placeholder="Masukkan nomor karsu/karis" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="alamat"
                                            placeholder="Masukkan alamat pasangan" required>
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
                                            <input class="form-control" type="text" name="no_hp"
                                                placeholder="Masukkan nomor HP pasangan" required>
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
                                            <input class="form-control" type="text" name="no_telepon"
                                                placeholder="Masukkan nomor telepon pasangan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><small class="text-danger">*</small>
                                        <input class="form-control" type="email" name="email" placeholder="Masukkan email pasangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Nikah</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="dokumen_nikah">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pas Foto</label><small class="text-danger">*</small>
                                        <input class="form-control" type="file" name="pas_foto">
                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG,   PNG.</small>
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
        <!-- /Tambah Riwayat Pasangan Modal -->

        <!-- Edit Riwayat Pasangan Modal -->
        <div id="edit_pasangan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Pasangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/pasangan/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Suami/Istri ke</label><small class="text-danger">*</small>
                                        <select class="form-control" name="suami_istri_ke" id="e_suami_istri_ke" required>
                                            <option disabled selected value="">-- Pilih Suami/Istri ke --</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pekerjaan Pasangan</label><small class="text-danger">*</small>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_pekerjaan_pasangan" id="bukan_pns" value="Bukan PNS" required>
                                                Bukan PNS
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="status_pekerjaan_pasangan" id="pns" value="PNS" required>
                                                PNS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control" type="text" name="nip" id="e_nip"
                                            placeholder="Jika status pasangan bukan PNS isi dengan -" required>
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
                                        <label>Nama</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama" id="e_nama"
                                            placeholder="Masukkan nama pasangan" required>
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
                                        <label>Status Hidup</label><small class="text-danger">*</small>
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
                                        <label>Nomor Karsu/Karis</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_karis_karsu" id="e_no_karis_karsu"
                                            placeholder="Masukkan nomor karsu/karis" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="alamat" id="e_alamat"
                                            placeholder="Masukkan alamat pasangan" required>
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
                                            <input class="form-control" type="text" name="no_hp" id="e_no_hp"
                                                placeholder="Masukkan nomor HP pasangan" required>
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
                                            <input class="form-control" type="text" name="no_telepon" id="e_no_telepon"
                                                placeholder="Masukkan nomor telepon pasangan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><small class="text-danger">*</small>
                                        <input class="form-control" type="email" name="email" id="e_email" placeholder="Masukkan email pasangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen Nikah</label><small class="text-danger">*</small>
                                        <input type="file" class="form-control" id="dokumen_nikah"
                                            name="dokumen_nikah">
                                        <input type="hidden" name="hidden_dokumen_nikah" id="e_dokumen_nikah"
                                            value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pas Foto</label><small class="text-danger">*</small>
                                        <input type="file" class="form-control" id="pas_foto"
                                            name="pas_foto">
                                        <input type="hidden" name="hidden_pas_foto" id="e_pas_foto"
                                            value="">
                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG,   PNG.</small>
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
        <!-- /Edit Riwayat Pasangan Modal -->

        <!-- Delete Riwayat Pasangan Modal -->
        <div class="modal custom-modal fade" id="delete_pasangan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Pasangan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/pasangan/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_nikah" class="d_dokumen_nikah" value="">
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
        <!-- End Delete Riwayat Pasangan Modal -->

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
    $(document).on('click', '.edit_pasangan', function() {
        var _this = $(this).parents('tr');
        $('#e_id').val(_this.find('.id').text());
        $('#e_suami_istri_ke').val(_this.find('.suami_istri_ke').text());
        var statusPekerjaan = _this.find('.status_pekerjaan_pasangan').text();
        if (statusPekerjaan === 'Bukan PNS') {
            $('#bukan_pns').prop('checked', true);
        } else if (statusPekerjaan === 'PNS') {
            $('#pns').prop('checked', true);
        }
        $('#e_nip').val(_this.find('.nip').text());
        $('#e_status_pernikahan').val(_this.find('.status_pernikahan').text());
        $('#e_nama').val(_this.find('.nama').text());
        $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
        $('#e_jenis_identitas').val(_this.find('.jenis_identitas').text());
        var jenisKelamin = _this.find('.jenis_kelamin').text();
        if (jenisKelamin === 'Laki-Laki') {
            $('#laki_laki').prop('checked', true);
        } else if (jenisKelamin === 'Perempuan') {
            $('#perempuan').prop('checked', true);
        }
        $('#e_agama').val(_this.find('.agama').text());
        var statusHidup = _this.find('.status_hidup').text();
        if (statusHidup === 'Hidup') {
            $('#hidup').prop('checked', true);
        } else if (statusHidup === 'Meninggal') {
            $('#meninggal').prop('checked', true);
        }
        $('#e_no_karis_karsu').val(_this.find('.no_karis_karsu').text());
        $('#e_alamat').val(_this.find('.alamat').text());
        $('#e_no_hp').val(_this.find('.no_hp').text());
        $('#e_no_telepon').val(_this.find('.no_telepon').text());
        $('#e_email').val(_this.find('.email').text());
        // Assuming the dokumen_nikah and pas_foto are stored in hidden fields as file names
        $('#e_dokumen_nikah').val(_this.find('.dokumen_nikah').text());
        $('#e_pas_foto').val(_this.find('.pas_foto').text());

        // Your existing code for the other fields...
    });
</script>


    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_pasangan', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.d_dokumen_nikah').val(_this.find('.dokumen_nikah').text());
            $('.d_pas_foto').val(_this.find('.pas_foto').text());
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(".theSelect").select2();
    </script>

    <script>
        history.pushState({}, "", '/riwayat/pasangan');
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.exclusive').change(function() {
                if ($(this).prop('checked')) {
                    $('.exclusive').not(this).prop('disabled', true);
                } else {
                    $('.exclusive').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
@endsection
