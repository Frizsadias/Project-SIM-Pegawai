@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profil</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profil</li>
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
                                    <div class="profile-img">
                                        <a href="#">
                                            <img alt="" src="{{ URL::to('/assets/images/' . $users->avatar) }}" alt="{{ $users->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $users->name }}</h3>
                                                <h6 class="text-muted">{{ $users->department }}</h6>
                                                <small class="text-muted">{{ $users->position }}</small>
                                                <div class="staff-id">ID Pegawai : {{ $users->user_id }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung :
                                                    {{ \Carbon\Carbon::parse($users->join_date)->locale('id')->format('d F Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">E-mail:</div>
                                                    <div class="text">
                                                        @if (!empty($users->email))
                                                            <a href="mailto:{{ $users->email }}">{{ $users->email }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Tanggal Lahir :</div>
                                                    <div class="text">
                                                        @if (!empty($users->tgl_lahir))
                                                            <a>{{ date('d F Y', strtotime($users->tgl_lahir)) }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Alamat :</div>
                                                    <div class="text">
                                                        @if (!empty($users->alamat))
                                                            <a>{{ $users->alamat }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Jenis Kelamin :</div>
                                                    <div class="text">
                                                        @if (!empty($users->jk))
                                                            <a>{{ $users->jk }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    <a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
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
                                    <h3 class="card-title">Profil Pegawai <a href="#" class="edit-icon" data-toggle="modal" data-target="#profil_pegawai_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">NIP</div>
                                            @if (!empty($users->nip))
                                                <div class="text">{{ $users->nip }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        {{-- <li>
                                            <div class="title">Nama</div>
                                            @if (!empty($users->name))
                                                <div class="text">{{ $users->name }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li> --}}
                                        <li>
                                            <div class="title">Gelar Depan</div>
                                            @if (!empty($users->gelar_depan))
                                                <div class="text">{{ $users->gelar_depan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gelar Belakang</div>
                                            @if (!empty($users->gelar_belakang))
                                                <div class="text">{{ $users->gelar_belakang }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tempat Lahir</div>
                                            @if (!empty($users->tempat_lahir))
                                                <div class="text">{{ $users->tempat_lahir }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal Lahir</div>
                                            @if (!empty($users->tanggal_lahir))
                                                <div class="text">{{ $users->tanggal_lahir }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Kelamin</div>
                                            @if (!empty($users->jenis_kelamin))
                                                <div class="text">{{ $users->jenis_kelamin }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                         <li>
                                            <div class="title">Agama</div>
                                            @if (!empty($users->agama))
                                                <div class="text">{{ $users->agama }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">E-mail</div>
                                            @if (!empty($users->email))
                                                <div class="text">{{ $users->email }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Dokumen</div>
                                            @if (!empty($users->jenis_dokumen))
                                                <div class="text">{{ $users->jenis_dokumen }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Dokumen</div>
                                            @if (!empty($users->no_dokumen))
                                                <div class="text">{{ $users->no_dokumen }}</div>
                                            @else
                                                <div class="text">N/An</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kelurahan</div>
                                            @if (!empty($users->kelurahan))
                                                <div class="text">{{ $users->kelurahan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kecamatan</div>
                                            @if (!empty($users->kecamatan))
                                                <div class="text">{{ $users->kecamatan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kota</div>
                                            @if (!empty($users->kota))
                                                <div class="text">{{ $users->kota }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Provinsi</div>
                                            @if (!empty($users->provinsi))
                                                <div class="text">{{ $users->provinsi }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kode Pos</div>
                                            @if (!empty($users->kode_pos))
                                                <div class="text">{{ $users->kode_pos }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor HP</div>
                                            @if (!empty($users->no_hp))
                                                <div class="text">{{ $users->no_hp }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Telepon</div>
                                            @if (!empty($users->no_telp))
                                                <div class="text">{{ $users->no_telp }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Pegawai</div>
                                            @if (!empty($users->jenis_pegawai))
                                                <div class="text">{{ $users->jenis_pegawai }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kedudukan PNS</div>
                                            @if (!empty($users->kedudukan_pns))
                                                <div class="text">{{ $users->kedudukan_pns }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Status Pegawai</div>
                                            @if (!empty($users->status_pegawai))
                                                <div class="text">{{ $users->status_pegawai }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT PNS</div>
                                            @if (!empty($users->tmt_pns))
                                                <div class="text">{{ $users->tmt_pns }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No. Seri Kartu Pegawai</div>
                                            @if (!empty($users->no_seri_karpeg))
                                                <div class="text">{{ $users->no_seri_karpeg }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT CPNS</div>
                                            @if (!empty($users->tmt_cpns))
                                                <div class="text">{{ $users->tmt_cpns }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tingkat Pendidikan</div>
                                            @if (!empty($users->tingkat_pendidikan))
                                                <div class="text">{{ $users->tingkat_pendidikan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Pendidikan Terakhir</div>
                                            @if (!empty($users->pendidikan_terakhir))
                                                <div class="text">{{ $users->pendidikan_terakhir }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Posisi & Jabatan Pegawai <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
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
                                    </ul>
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
                                   <tbody>
                                    <td hidden class="user_id"><center>{{ $users->user_id }}</center></td>
                                    <td hidden class="id"><center>{{ $users->id }}</center></td>
                                    <td class="tingkat_pendidikan"><center>{{ $users->tingkat_pendidikan }}</center></td>
                                        <td class="pendidikan"><center>{{ $users->pendidikan }}</center></td>
                                        <td class="tahun_lulus"><center>{{ $users->tahun_lulus }}</center></td>
                                        <td class="no_ijazah"><center>{{ $users->no_ijazah }}</center></td>
                                        <td class="nama_sekolah"><center>{{ $users->nama_sekolah }}</center></td>
                                        <td class="gelar_depan"><center>{{ $users->gelar_depan }}</center></td>
                                        <td class="gelar_belakang"><center>{{ $users->gelar_belakang }}</center></td>
                                        <td class="jenis_pendidikan"><center>{{ $users->jenis_pendidikan }}</center></td>
                                        <td class="dokumen_transkrip">
                                            <center><a href="{{ asset('assets/DokumenTranskrip/' . $users->dokumen_transkrip) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_ijazah">
                                            <center><a href="{{ asset('assets/DokumenIjazah/' . $users->dokumen_ijazah) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_gelar">
                                            <center><a href="{{ asset('assets/DokumenGelar/' . $users->dokumen_gelar) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                   </tbody>

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
                                    <tbody>
                                        <td hidden class="user_id"><center>{{ $users->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $users->id }}</center></td>
                                        <td class="golongan"><center>{{ $users->golongan }}</center></td>
                                        <td class="jenis_kenaikan_pangkat"><center>{{ $users->jenis_kenaikan_pangkat }}</center></td>
                                        <td class="masa_kerja_golongan_tahun"><center>{{ $users->masa_kerja_golongan_tahun }}</center></td>
                                        <td class="masa_kerja_golongan_bulan"><center>{{ $users->masa_kerja_golongan_bulan }}</center></td>
                                        <td class="tmt_golongan"><center>{{ $users->tmt_golongan }}</center></td>
                                        <td class="no_teknis_bkn"><center>{{ $users->no_teknis_bkn }}</center></td>
                                        <td class="tanggal_teknis_bkn"><center>{{ $users->tanggal_teknis_bkn }}</center></td>
                                        <td class="no_sk"><center>{{ $users->no_sk }}</center></td>
                                        <td class="tanggal_sk"><center>{{ $users->tanggal_sk }}</center></td>
                                        <td class="dokumen_skkp">
                                            <center><a href="{{ asset('assets/DokumenSKKP/' . $users->dokumen_skkp) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_teknis_kp">
                                            <center><a href="{{ asset('assets/DokumenTeknisKP/' . $users->dokumen_teknis_kp) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                    </tbody>

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
                                    <tbody>
                                        <td hidden class="user_id"><center>{{ $users->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $users->id }}</center></td>
                                        <td class="jenis_jabatan"><center>{{ $users->jenis_jabatan }}</center></td>
                                        <td class="satuan_kerja"><center>{{ $users->satuan_kerja }}</center></td>
                                        <td class="satuan_kerja_induk"><center>{{ $users->satuan_kerja_induk }}</center></td>
                                        <td class="unit_organisasi"><center>{{ $users->unit_organisasi }}</center></td>
                                        <td class="no_sk"><center>{{ $users->no_sk }}</center></td>
                                        <td class="tanggal_sk"><center>{{ $users->tanggal_sk }}</center></td>
                                        <td class="tmt_jabatan"><center>{{ $users->tmt_jabatan }}</center></td>
                                        <td class="tmt_pelantikan"><center>{{ $users->tmt_pelantikan }}</center></td>
                                        <td class="dokumen_sk_jabatan">
                                            <center><a href="{{ asset('assets/DokumenSKJabatan/' . $users->dokumen_sk_jabatan) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_pelantikan">
                                            <center><a href="{{ asset('assets/DokumenPelantikan/' . $users->dokumen_pelantikan) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                    </tbody>

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
                                    <tbody>
                                        <td hidden class="user_id"><center>{{ $users->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $users->id }}</center></td>
                                        <td class="jenis_diklat"><center>{{ $users->jenis_diklat }}</center></td>
                                        <td class="nama_diklat"><center>{{ $users->nama_diklat }}</center></td>
                                        <td class="institusi_penyelenggara"><center>{{ $users->institusi_penyelenggara }}</center></td>
                                        <td class="no_sertifikat"><center>{{ $users->no_sertifikat }}</center></td>
                                        <td class="tanggal_mulai"><center>{{ $users->tanggal_mulai }}</center></td>
                                        <td class="tanggal_selesai"><center>{{ $users->tanggal_selesai }}</center></td>
                                        <td class="tahun_diklat"><center>{{ $users->tahun_diklat }}</center></td>
                                        <td class="durasi_jam"><center>{{ $users->durasi_jam }}</center></td>
                                        <td class="dokumen_diklat">
                                            <center><a href="{{ asset('assets/DokumenDiklat/' . $users->dokumen_diklat) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                    </tbody>
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
                            <h5 class="modal-title">Profil Informasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/information/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . $users->avatar) }}" alt="{{ $users->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                @if (!empty($users))
                                                    <input type="hidden" name="hidden_image" id="e_image" value="{{ $users->avatar }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ $users->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $users->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        @if (!empty($users))
                                                            <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" value="{{ $users->tgl_lahir }}">
                                                        @else
                                                            <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    @if (!empty($users))
                                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $users->alamat }}">
                                                    @else
                                                        <input type="text" class="form-control" id="alamat" name="alamat">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select form-control" id="jk" name="jk">
                                                        @if (!empty($users))
                                                            <option value="{{ $users->jk }}"
                                                                {{ $users->jk == $users->jk ? 'selected' : '' }}>
                                                                {{ $users->jk }} </option>
                                                            <option selected disabled> --Pilih Jenis Kelamin --</option>
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        @else
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
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
                            <form action="{{ route('user/propeg/save') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}" readonly>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIP <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $users->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $users->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gelar Depan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('gelar_depan') is-invalid @enderror" name="gelar_depan" value="{{ $users->gelar_depan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gelar Belakang <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('gelar_belakang') is-invalid @enderror" name="gelar_belakang" value="{{ $users->gelar_belakang }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tempat Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $users->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $users->tanggal_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="{{ $users->jenis_kelamin }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Agama</label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ $users->agama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <span class="text-danger">*</span></label>
                                            <label>Jenis Dokumen </label>
                                            <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" value="{{ $users->jenis_dokumen }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <span class="text-danger">*</span></label>
                                            <label>Nomor Dokumen </label>
                                            <input type="number" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" value="{{ $users->no_dokumen }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <span class="text-danger">*</span></label>
                                            <label>Kelurahan </label>
                                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $users->kelurahan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <span class="text-danger">*</span></label>
                                            <label>Kecamatan </label>
                                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ $users->kecamatan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kota </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ $users->kota }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Provinsi </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ $users->provinsi }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Pos </label> <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $users->kode_pos }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor HP </label> <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $users->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Telepon </label> <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $users->no_telp }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Pegawai </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('jenis_pegawai') is-invalid @enderror" name="jenis_pegawai" value="{{ $users->jenis_pegawai }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kedudukan PNS </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kedudukan_pns') is-invalid @enderror" name="kedudukan_pns" value="{{ $users->kedudukan_pns }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Pegawai </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('status_pegawai') is-invalid @enderror" name="status_pegawai" value="{{ $users->status_pegawai }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TMT PNS </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tmt_pns') is-invalid @enderror" name="tmt_pns" value="{{ $users->tmt_pns }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Seri Kartu Pegawai </label> <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('no_seri_karpeg') is-invalid @enderror" name="no_seri_karpeg" value="{{ $users->no_seri_karpeg }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TMT CPNS </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tmt_cpns') is-invalid @enderror" name="tmt_cpns" value="{{ $users->tmt_cpns }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tingkat Pendidikan </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tingkat_pendidikan') is-invalid @enderror" name="tingkat_pendidikan" value="{{ $users->tingkat_pendidikan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir </label> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="{{ $users->pendidikan_terakhir }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profil Pegawai Modal -->

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
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
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
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
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
                                    <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Riwayat Diklat Modal -->

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
