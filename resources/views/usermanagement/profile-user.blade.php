@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    {{-- <div class="profile-img">
                                        <a href="#"><img alt=""
                                                src="{{ URL::to('/assets/images/' . $users->avatar) }}"
                                                alt="{{ $users->name }}"></a>
                                    </div> --}}
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    {{-- <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $users->name }}</h3>
                                                <h6 class="text-muted"> {{ $users->department }}</h6>
                                                <small class="text-muted">{{ $users->position }}</small>
                                                <div class="staff-id">ID Pegawai : {{ $users->user_id }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung : {{ $users->join_date }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Nomor Telepon:</div>
                                                    <div class="text">
                                                        @if (!empty($users->phone_number))
                                                            <a>{{ $users->phone_number }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        @if (!empty($users->email))
                                                            <a>{{ $users->email }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Tanggal Lahir:</div>
                                                    <div class="text">
                                                        @if (!empty($users->birth_date))
                                                            <a>{{ $users->birth_date }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Alamat:</div>
                                                    <div class="text">
                                                        @if (!empty($users->address))
                                                            <a>{{ $users->address }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Jenis Kelamin:</div>
                                                    <div class="text">
                                                        @if (!empty($users->gender))
                                                            <a>{{ $users->gender }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon"
                                        href="#"><i class="fa fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#profil_pegawai" data-toggle="tab" class="nav-link active">Profil</a></li>
                            <li class="nav-item"><a href="#riwayat_pendidikan" data-toggle="tab" class="nav-link">Riwayat Pendidikan</a></li>
                            <li class="nav-item"><a href="#riwayat_golongan" data-toggle="tab" class="nav-link">Riwayat Golongan</a></li>
                            <li class="nav-item"><a href="#riwayat_jabatan" data-toggle="tab" class="nav-link">Riwayat Jabatan</a></li>
                            <li class="nav-item"><a href="#riwayat_diklat" data-toggle="tab" class="nav-link">Riwayat Diklat</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <!-- Profile Info Tab -->
                <div id="profil_pegawai" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Profil Pegawai <a href="#" class="edit-icon"
                                            data-toggle="modal" data-target="#profil_pegawai_modal"><i
                                                class="fa fa-pencil"></i></a></h3>
                                    {{-- <ul class="personal-info">
                                        <li>
                                            <div class="title">NIP</div>
                                            @if (!empty($users->nip))
                                                <div class="text">{{ $users->nip }}</div>
                                            @else
                                                <div class="text">NIP</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nama</div>
                                            @if (!empty($users->name))
                                                <div class="text">{{ $users->name }}</div>
                                            @else
                                                <div class="text">Nama</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gelar Depan</div>
                                            @if (!empty($users->gelar_depan))
                                                <div class="text">{{ $users->gelar_depan }}</div>
                                            @else
                                                <div class="text">Gelar Belakang</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gelar Belakang</div>
                                            @if (!empty($users->gelar_belakang))
                                                <div class="text">{{ $users->gelar_belakang }}</div>
                                            @else
                                                <div class="text">Gelar Belakang</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tempat Lahir</div>
                                            @if (!empty($users->tempat_lahir))
                                                <div class="text">{{ $users->tempat_lahir }}</div>
                                            @else
                                                <div class="text">Tempat Lahir</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal Lahir</div>
                                            @if (!empty($users->birth_date))
                                                <div class="text">{{ $users->birth_date }}</div>
                                            @else
                                                <div class="text">Tanggal Lahir</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Kelamin</div>
                                            @if (!empty($users->gender))
                                                <div class="text">{{ $users->gender }}</div>
                                            @else
                                                <div class="text">Jenis Kelamin</div>
                                            @endif
                                        </li>
                                         <li>
                                            <div class="title">Agama</div>
                                            @if (!empty($users->agama))
                                                <div class="text">{{ $users->agama }}</div>
                                            @else
                                                <div class="text">Agama</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">E-mail</div>
                                            @if (!empty($users->email))
                                                <div class="text">{{ $users->email }}</div>
                                            @else
                                                <div class="text">E-mail</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Dokumen</div>
                                            @if (!empty($users->jenis_kelamin))
                                                <div class="text">{{ $users->jenis_dokumen }}</div>
                                            @else
                                                <div class="text">Jenis Dokumen</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Dokumen</div>
                                            @if (!empty($users->no_dokumen))
                                                <div class="text">{{ $users->no_dokumen }}</div>
                                            @else
                                                <div class="text">Nomor Dokumen</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kelurahan</div>
                                            @if (!empty($users->kelurahan))
                                                <div class="text">{{ $users->kelurahan }}</div>
                                            @else
                                                <div class="text">Kelurahan</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kecamatan</div>
                                            @if (!empty($users->kecamatan))
                                                <div class="text">{{ $users->kecamatan }}</div>
                                            @else
                                                <div class="text">Kecamatan</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kota</div>
                                            @if (!empty($users->kota))
                                                <div class="text">{{ $users->kota }}</div>
                                            @else
                                                <div class="text">Kota</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Provinsi</div>
                                            @if (!empty($users->provinsi))
                                                <div class="text">{{ $users->provinsi }}</div>
                                            @else
                                                <div class="text">Provinsi</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kode Pos</div>
                                            @if (!empty($users->kode_pos))
                                                <div class="text">{{ $users->kode_pos }}</div>
                                            @else
                                                <div class="text">Kode Pos</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor HP</div>
                                            @if (!empty($users->no_hp))
                                                <div class="text">{{ $users->no_hp }}</div>
                                            @else
                                                <div class="text">Nomor HP</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Telepon</div>
                                            @if (!empty($users->no_telp))
                                                <div class="text">{{ $users->no_telp }}</div>
                                            @else
                                                <div class="text">Nomor Telepon</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Pegawai</div>
                                            @if (!empty($users->jenis_pegawai))
                                                <div class="text">{{ $users->jenis_pegawai }}</div>
                                            @else
                                                <div class="text">Jenis Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kedudukan PNS</div>
                                            @if (!empty($users->kedudukan_pns))
                                                <div class="text">{{ $users->kedudukan_pns }}</div>
                                            @else
                                                <div class="text">Kedudukan PNS</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Status Pegawai</div>
                                            @if (!empty($users->status_pegawai))
                                                <div class="text">{{ $users->status_pegawai }}</div>
                                            @else
                                                <div class="text">Status Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT PNS</div>
                                            @if (!empty($users->tmt_pns))
                                                <div class="text">{{ $users->tmt_pns }}</div>
                                            @else
                                                <div class="text">TMT PNS</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No. Seri Kartu Pegawai</div>
                                            @if (!empty($users->no_seri_karpeg))
                                                <div class="text">{{ $users->no_seri_karpeg }}</div>
                                            @else
                                                <div class="text">No. Seri Kartu Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT CPNS</div>
                                            @if (!empty($users->tmt_cpns))
                                                <div class="text">{{ $users->tmt_cpns }}</div>
                                            @else
                                                <div class="text">TMT CPNS</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tingkat Pendidikan</div>
                                            @if (!empty($users->tingkat_pendidikan))
                                                <div class="text">{{ $users->tingkat_pegawai }}</div>
                                            @else
                                                <div class="text">Tingkat Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Pendidikan Terakhir</div>
                                            @if (!empty($users->pendidikan_terakhir))
                                                <div class="text">{{ $users->pendidikan_terakhir }}</div>
                                            @else
                                                <div class="text">Pendidikan Terakhir</div>
                                            @endif
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Posisi & Jabatan Pegawai <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                                    {{-- <ul class="personal-info">
                                        <li>
                                            <div class="title">Unit Organisasi</div>
                                            @if (!empty($users->name_primary))
                                            <div class="text">{{ $users->name_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Unit Organisasi Induk</div>
                                            @if (!empty($users->relationship_primary))
                                            <div class="text">{{ $users->relationship_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Jabatan </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Eselon </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jabatan </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Lokasi Kerja </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Golongan Ruang Awal </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Golongan Ruang Akhir </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT Golongan </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gaji Pokok </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Tahun) </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Bulan) </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No SPMT </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal SPMT </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">KPPN </div>
                                            @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                            <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Profile Info Tab -->







                

                <!-- Informasi Riwayat Pendidikan Tab -->
                <div id="riwayat_pendidikan" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" pro-overview tab-pane fade show active float-left">
                                <a href="#" class="btn add-btn" data-toggle="modal"
                                    data-target="#add_riwayat_pendidikan"><i class="fa fa-plus"></i> Tambah Riwayat
                                    Pendidikan</a>
                            </div>
                            <div class="table-responsive" style="position: relative; top: 25px;">
                                <table class="table table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
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

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Informasi Riwayat Pendidikan Tab -->

                <!-- Informasi Riwayat Golongan Tab -->
                <div id="riwayat_golongan" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" pro-overview tab-pane fade show active float-left">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_expense"><i
                                        class="fa fa-plus"></i> Tambah Riwayat Golongan</a>
                            </div>
                            <div class="table-responsive" style="position: relative; top: 25px;">
                                <table class="table table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="golongan">Golongan</th>
                                            <th class="jenis_kenaikan_pangkat">Jenis Kenaikan Pangkat (KP)</th>
                                            <th class="jenis_kerja_golongan_tahun">Masa Kerja Golongan (Tahun)</th>
                                            <th class="jenis_kerja_golongan_bulan">Masa Kerja Golongan (Bulan)</th>
                                            <th class="tmt_golongan">TMT Golongan</th>
                                            <th class="no_teknis_bkn">No Teknis BKN</th>
                                            <th class="tanggal_teknis_bkn">Tanggal Teknis BKN</th>
                                            <th class="no_sk">No SK</th>
                                            <th class="tanggal_sk">Tanggal SK</th>
                                            <th class="dokumen_skkp">Dokumen SK KP</th>
                                            <th class="dokumen_teknis_kp">Dokumen Teknis KP</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Informasi Riwayat Golongan Tab -->

                <!-- Informasi Riwayat Jabatan Tab -->
                <div id="riwayat_jabatan" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" pro-overview tab-pane fade show active float-left">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#"><i
                                        class="fa fa-plus"></i> Tambah Riwayat Jabatan</a>
                            </div>
                            <div class="table-responsive" style="position: relative; top: 25px;">
                                <table class="table table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="jenis_jabatan"> Jenis Jabatan</th>
                                            <th class="satuan_kerja">Satuan Kerja</th>
                                            <th class="satuan_kerja_induk">Satuan Kerja Induk</th>
                                            <th class="unit_organisasi">Unit Organisasi</th>
                                            <th class="no_sk">No SK</th>
                                            <th class="tanggal_sk">Tanggal SK</th>
                                            <th class="tmt_jabatan">TMT Jabatan</th>
                                            <th class="tmt_pelantikan">TMT Pelantikan</th>
                                            <th class="dokumen_sk_jabatan">Dokumen SK Jabatan</th>
                                            <th class="dokumen_pelantikan">Dokumen Pelantikan</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Informasi Riwayat Jabatan Tab -->

                <!-- Informasi Riwayat Diklat Tab -->
                <div id="riwayat_diklat" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" pro-overview tab-pane fade show active float-left">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#"><i
                                        class="fa fa-plus"></i> Tambah Riwayat Diklat</a>
                            </div>
                            <div class="table-responsive" style="position: relative; top: 25px;">
                                <table class="table table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="jenis_diklat"> Jenis Diklat</th>
                                            <th class="nama_diklat">Nama Diklat</th>
                                            <th class="Institusi Penyelenggara">Institusi Penyelenggara</th>
                                            <th class="no_sertifikat">No Sertifikat</th>
                                            <th class="tanggal_mulai">Tanggal Mulai</th>
                                            <th class="tanggal_selesai">Tanggal Selesai</th>
                                            <th class="tahun_diklat">Tahun Diklat</th>
                                            <th class="durasi_jam">Durasi Jam</th>
                                            <th class="dokumen_diklat">Dokumen Diklat</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- /Informasi Riwayat Diklat Tab -->

                </div>
            </div>
            <!-- /Page Content -->

            <!-- Profile Modal -->
            <div id="profile_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profile Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/information/save') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block"
                                                src="{{ URL::to('/assets/images/' . $users->avatar) }}"
                                                alt="{{ $users->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                @if (!empty($users))
                                                    <input type="hidden" name="hidden_image" id="e_image"
                                                        value="{{ $users->avatar }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $users->name }}">
                                                    <input type="hidden" class="form-control" id="user_id"
                                                        name="user_id" value="{{ $users->user_id }}">
                                                    <input type="hidden" class="form-control" id="email"
                                                        name="email" value="{{ $users->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Birth Date</label>
                                                    <div class="cal-icon">
                                                        @if (!empty($users))
                                                            <input class="form-control datetimepicker" type="text"
                                                                id="birthDate" name="birthDate"
                                                                value="{{ $users->birth_date }}">
                                                        @else
                                                            <input class="form-control datetimepicker" type="text"
                                                                id="birthDate" name="birthDate">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="select form-control" id="gender" name="gender">
                                                        @if (!empty($users))
                                                            <option value="{{ $users->gender }}"
                                                                {{ $users->gender == $users->gender ? 'selected' : '' }}>
                                                                {{ $users->gender }} </option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        @else
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            @if (!empty($users))
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ $users->address }}">
                                            @else
                                                <input type="text" class="form-control" id="address"
                                                    name="address">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            @if (!empty($users))
                                                <input type="text" class="form-control" id="state" name="state"
                                                    value="{{ $users->state }}">
                                            @else
                                                <input type="text" class="form-control" id="state"
                                                    name="state">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            @if (!empty($users))
                                                <input type="text" class="form-control" id="" name="country"
                                                    value="{{ $users->country }}">
                                            @else
                                                <input type="text" class="form-control" id=""
                                                    name="country">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pin Code</label>
                                            @if (!empty($users))
                                                <input type="text" class="form-control" id="pin_code"
                                                    name="pin_code" value="{{ $users->pin_code }}">
                                            @else
                                                <input type="text" class="form-control" id="pin_code"
                                                    name="pin_code">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            @if (!empty($users))
                                                <input type="text" class="form-control" id="phoneNumber"
                                                    name="phone_number" value="{{ $users->phone_number }}">
                                            @else
                                                <input type="text" class="form-control" id="phoneNumber"
                                                    name="phone_number">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">*</span></label>
                                            <select class="select" id="department" name="department">
                                                @if (!empty($users))
                                                    <option value="{{ $users->department }}"
                                                        {{ $users->department == $users->department ? 'selected' : '' }}>
                                                        {{ $users->department }} </option>
                                                    <option value="Web Development">Web Development</option>
                                                    <option value="IT Management">IT Management</option>
                                                    <option value="Marketing">Marketing</option>
                                                @else
                                                    <option value="Web Development">Web Development</option>
                                                    <option value="IT Management">IT Management</option>
                                                    <option value="Marketing">Marketing</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation <span class="text-danger">*</span></label>
                                            <select class="select" id="designation" name="designation">
                                                @if (!empty($users))
                                                    <option value="{{ $users->designation }}"
                                                        {{ $users->designation == $users->designation ? 'selected' : '' }}>
                                                        {{ $users->designation }} </option>
                                                    <option value="Web Designer">Web Designer</option>
                                                    <option value="Web Developer">Web Developer</option>
                                                    <option value="Android Developer">Android Developer</option>
                                                @else
                                                    <option value="Web Designer">Web Designer</option>
                                                    <option value="Web Developer">Web Developer</option>
                                                    <option value="Android Developer">Android Developer</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Reports To <span class="text-danger">*</span></label>
                                            <select class="select" id="" name="reports_to">
                                                @if (!empty($users))
                                                    <option value="{{ $users->reports_to }}"
                                                        {{ $users->reports_to == $users->reports_to ? 'selected' : '' }}>
                                                        {{ $users->reports_to }} </option>
                                                    @foreach ($user as $users)
                                                        <option value="{{ $users->name }}">{{ $users->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($user as $users)
                                                        <option value="{{ $users->name }}">{{ $users->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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
            <!-- /Profile Modal -->

            <!-- Profil Pegawai Modal -->
            <div id="profil_pegawai_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profil Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user/information/save') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}"
                                    readonly>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIP <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('nip') is-invalid @enderror"
                                                    type="text" name="nip" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama <span class="text-danger">*</span></label>
                                            <input class="form-control @error('nama') is-invalid @enderror" type="text"
                                                name="nama" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gelar Depan <span class="text-danger">*</span></label>
                                            <input class="form-control @error('gelar_depan') is-invalid @enderror"
                                                type="text" name="gelar_depan" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gelar Belakang <span class="text-danger">*</span></label>
                                            <input class="form-control @error('gelar_belakang') is-invalid @enderror"
                                                type="text" name="gelar_belakang" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tempat Lahir <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    type="text" name="tempat_lahir" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    type="text" name="tanggal_lahir" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <input class="form-control @error('agama') is-invalid @enderror"
                                                type="text" name="agama" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail </label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="email" name="email" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Dokumen </label>
                                            <input class="form-control @error('jenis_dokumen') is-invalid @enderror"
                                                type="text" name="jenis_dokumen" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Dokumen </label>
                                            <input class="form-control @error('no_dokumen') is-invalid @enderror"
                                                type="number" name="no_dokumen" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kelurahan </label>
                                            <input class="form-control @error('kelurahan') is-invalid @enderror"
                                                type="text" name="kelurahan" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kecamatan </label>
                                            <input class="form-control @error('kecamatan') is-invalid @enderror"
                                                type="text" name="kecamatan" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kota </label>
                                            <input class="form-control @error('kota') is-invalid @enderror"
                                                type="text" name="kota" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Provinsi </label>
                                            <input class="form-control @error('provinsi') is-invalid @enderror"
                                                type="text" name="provinsi" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Pos </label>
                                            <input class="form-control @error('kode_pos') is-invalid @enderror"
                                                type="kode_pos" name="kecamatan" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor HP </label>
                                            <input class="form-control @error('no_hp') is-invalid @enderror"
                                                type="number" name="no_hp" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Telepon </label>
                                            <input class="form-control @error('no_telp') is-invalid @enderror"
                                                type="number" name="no_telp" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Pegawai </label>
                                            <input class="form-control @error('jenis_pegawai') is-invalid @enderror"
                                                type="text" name="jenis_pegawai" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kedudukan PNS </label>
                                            <input class="form-control @error('kedudukan_pns') is-invalid @enderror"
                                                type="text" name="kedudukan_pns" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Pegawai </label>
                                            <input class="form-control @error('status_pegawai') is-invalid @enderror"
                                                type="text" name="status_pegawai" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TMT PNS </label>
                                            <input class="form-control @error('tmt_pns') is-invalid @enderror"
                                                type="text" name="tmt_pns" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Seri Kartu Pegawai </label>
                                            <input class="form-control @error('no_seri_karpeg') is-invalid @enderror"
                                                type="number" name="no_seri_karpeg" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TMT CPNS </label>
                                            <input class="form-control @error('tmt_cpns') is-invalid @enderror"
                                                type="text" name="tmt_cpns" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tingkat Pendidikan </label>
                                            <input class="form-control @error('tingkat_pendidikan') is-invalid @enderror"
                                                type="text" name="tingkat_pendidikan" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir </label>
                                            <input class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                                type="text" name="pendidikan_terakhir" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Riwayat Pendidikan Modal -->

            <!-- Edit Riwayat Golongan Modal -->
            <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Riwayat Golongan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="validation" action="{{ route('user/profile/emergency/contact/save') }}"
                                method="POST">
                                @csrf
                                <input type="text" class="form-control" name="user_id"
                                    value="{{ $users->user_id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Golongan <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kenaikan Pangkat (KP) <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Masa Kerja Golongan (Tahun) <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Masa Kerja Golongan (Bulan) <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT Golongan <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Pertimbangan Teknis BKN <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Pertimbangan Teknis BKN <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor SK <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal SK <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen SK KP <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="file" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="file" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen Pertimbangan Teknis KP <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="file" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="file" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
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
            <!-- /Edit Riwayat Golongan Modal -->

            <!-- Edit Riwayat Jabatan Modal -->
            <div id="riwayat_jabatan" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Riwayat Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="validation" action="{{ route('user/profile/emergency/contact/save') }}"
                                method="POST">
                                @csrf
                                <input type="text" class="form-control" name="user_id"
                                    value="{{ $users->user_id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Jabatan <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Satuan Kerja <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Satuan Kerja Induk <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Unit Organisasi <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor SK <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal SK <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT Jabatan <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT Pelantikan <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen SK Jabatan <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="file" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="file" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen Surat Pelantikan <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="file" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="file" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
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
            <!-- /Edit Riwayat Jabatan Modal -->

            <!-- Edit Riwayat Diklat Modal -->
            <div id="riwayat_diklat" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Riwayat Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="validation" action="{{ route('user/profile/emergency/contact/save') }}"
                                method="POST">
                                @csrf
                                <input type="text" class="form-control" name="user_id"
                                    value="{{ $users->user_id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Diklat <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Diklat <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Institusi Penyelenggara <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Sertifikat <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Selesai <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tahun Diklat <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Durasi Jam <span class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="text" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="text" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen Sertifikat Diklat <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($users->name_primary))
                                                        <input type="file" class="form-control" name="name_primary"
                                                            value="{{ $users->name_primary }}">
                                                    @else
                                                        <input type="file" class="form-control" name="name_primary">
                                                    @endif
                                                    </li>
                                                </div>
                                            </div>
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

            <!-- Family Info Modal -->
            <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Family Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Family Member <a href="javascript:void(0);"
                                                    class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Relationship <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date of birth <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                    class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Relationship <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date of birth <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Family Info Modal -->

            <!-- Education Modal -->
            <div id="education_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Education Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                    class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Oxford University"
                                                            class="form-control floating">
                                                        <label class="focus-label">Institution</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Computer Science"
                                                            class="form-control floating">
                                                        <label class="focus-label">Subject</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="01/06/2002"
                                                                class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Starting Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="31/05/2006"
                                                                class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Complete Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="BE Computer Science"
                                                            class="form-control floating">
                                                        <label class="focus-label">Degree</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Grade A"
                                                            class="form-control floating">
                                                        <label class="focus-label">Grade</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                    class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Oxford University"
                                                            class="form-control floating">
                                                        <label class="focus-label">Institution</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Computer Science"
                                                            class="form-control floating">
                                                        <label class="focus-label">Subject</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="01/06/2002"
                                                                class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Starting Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="31/05/2006"
                                                                class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Complete Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="BE Computer Science"
                                                            class="form-control floating">
                                                        <label class="focus-label">Degree</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Grade A"
                                                            class="form-control floating">
                                                        <label class="focus-label">Grade</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Education Modal -->

            <!-- Experience Modal -->
            <div id="experience_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Experience Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                    class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating"
                                                            value="Digital Devlopment Inc">
                                                        <label class="focus-label">Company Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating"
                                                            value="United States">
                                                        <label class="focus-label">Location</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating"
                                                            value="Web Developer">
                                                        <label class="focus-label">Job Position</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text"
                                                                class="form-control floating datetimepicker"
                                                                value="01/07/2007">
                                                        </div>
                                                        <label class="focus-label">Period From</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text"
                                                                class="form-control floating datetimepicker"
                                                                value="08/06/2018">
                                                        </div>
                                                        <label class="focus-label">Period To</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                    class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating"
                                                            value="Digital Devlopment Inc">
                                                        <label class="focus-label">Company Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating"
                                                            value="United States">
                                                        <label class="focus-label">Location</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating"
                                                            value="Web Developer">
                                                        <label class="focus-label">Job Position</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text"
                                                                class="form-control floating datetimepicker"
                                                                value="01/07/2007">
                                                        </div>
                                                        <label class="focus-label">Period From</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text"
                                                                class="form-control floating datetimepicker"
                                                                value="08/06/2018">
                                                        </div>
                                                        <label class="focus-label">Period To</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Experience Modal -->
            <!-- /Page Content -->
        </div>
    @section('script')
        <script>
            $('#validation').validate({
                rules: {
                    name_primary: 'required',
                    relationship_primary: 'required',
                    phone_primary: 'required',
                    phone_2_primary: 'required',
                    name_secondary: 'required',
                    relationship_secondary: 'required',
                    phone_secondary: 'required',
                    phone_2_secondary: 'required',
                },
                messages: {
                    name_primary: 'Please input name primary',
                    relationship_primary: 'Please input relationship primary',
                    phone_primary: 'Please input phone primary',
                    phone_2_primary: 'Please input phone 2 primary',
                    name_secondary: 'Please input name secondary',
                    relationship_secondary: 'Please input relationship secondary',
                    phone_secondaryr: 'Please input phone secondary',
                    phone_2_secondary: 'Please input phone 2 secondary',
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        </script>
    @endsection
@endsection
