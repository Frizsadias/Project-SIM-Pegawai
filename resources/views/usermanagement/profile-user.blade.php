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
                                            <img alt="" src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="pro-edit">
                                                <a data-target="#profile_info_avatar" data-toggle="modal" class="edit-icon-avatar" href="#">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ Session::get('name') }}</h3>
                                                <div class="staff-id">ID Pegawai : {{ Session::get('user_id') }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung : {{ \Carbon\Carbon::parse(Session::get('join_date'))->translatedFormat('l, j F Y || h:i A') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">E-mail :</div>
                                                    <div class="text"><a href="mailto:{{ Session::get('email') }}">{{ Session::get('email') }}</a></div>
                                                </li>
                                                @if (!empty($information))
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Tanggal Lahir :</div>
                                                        <div class="text">{{ date('d F Y', strtotime($information->tgl_lahir)) }}
                                                        </div>
                                                        @else
                                                        <div class="title">Tanggal Lahir :</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Alamat :</div>
                                                        <div class="text">{{ $information->alamat }}</div>
                                                        @else
                                                        <div class="title">Alamat :</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Jenis Kelamin :</div>
                                                        <div class="text">{{ $information->jk }}</div>
                                                        @else
                                                        <div class="title">Jenis Kelamin :</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    @else
                                                    <li>
                                                        <div class="title">Tanggal Lahir :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Alamat :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Jenis Kelamin :</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a>
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
                <!-- Profile Pegawai Tab -->
                <div id="profil_pegawai" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Profil Pegawai
                                        {{-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#profil_pegawai_modal_tambah"><i class="fa fa-plus"></i></a></h3> --}}
                                        <a href="#" class="edit-icon" data-toggle="modal" data-target="#profil_pegawai_modal_edit"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Nama</div>
                                            @if (!empty($result_profilpegawai->name))
                                                <div class="text">{{ $result_profilpegawai->name }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">NIP</div>
                                            @if (!empty($result_profilpegawai->nip))
                                                <div class="text">{{ $result_profilpegawai->nip }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gelar Depan</div>
                                            @if (!empty($result_profilpegawai->gelar_depan))
                                                <div class="text">{{ $result_profilpegawai->gelar_depan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gelar Belakang</div>
                                            @if (!empty($result_profilpegawai->gelar_belakang))
                                                <div class="text">{{ $result_profilpegawai->gelar_belakang }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tempat Lahir</div>
                                            @if (!empty($result_profilpegawai->tempat_lahir))
                                                <div class="text">{{ $result_profilpegawai->tempat_lahir }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal Lahir</div>
                                            @if (!empty($result_profilpegawai->tanggal_lahir))
                                                <div class="text">{{ $result_profilpegawai->tanggal_lahir }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Kelamin</div>
                                            @if (!empty($result_profilpegawai->jenis_kelamin))
                                                <div class="text">{{ $result_profilpegawai->jenis_kelamin }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                         <li>
                                            <div class="title">Agama</div>
                                            @if (!empty($result_profilpegawai->agama))
                                                <div class="text">{{ $result_profilpegawai->agama }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        @foreach ($sqluser as $sql_email)
                                        <li>
                                            <div class="title">E-mail</div>
                                            @if (!empty($sql_email->email))
                                                <div class="text">{{ $sql_email->email }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        @endforeach
                                        <li>
                                            <div class="title">Jenis Dokumen</div>
                                            @if (!empty($result_profilpegawai->jenis_dokumen))
                                                <div class="text">{{ $result_profilpegawai->jenis_dokumen }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Dokumen</div>
                                            @if (!empty($result_profilpegawai->no_dokumen))
                                                <div class="text">{{ $result_profilpegawai->no_dokumen }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kelurahan</div>
                                            @if (!empty($result_profilpegawai->kelurahan))
                                                <div class="text">{{ $result_profilpegawai->kelurahan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kecamatan</div>
                                            @if (!empty($result_profilpegawai->kecamatan))
                                                <div class="text">{{ $result_profilpegawai->kecamatan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kota</div>
                                            @if (!empty($result_profilpegawai->kota))
                                                <div class="text">{{ $result_profilpegawai->kota }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Provinsi</div>
                                            @if (!empty($result_profilpegawai->provinsi))
                                                <div class="text">{{ $result_profilpegawai->provinsi }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kode Pos</div>
                                            @if (!empty($result_profilpegawai->kode_pos))
                                                <div class="text">{{ $result_profilpegawai->kode_pos }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor HP</div>
                                            @if (!empty($result_profilpegawai->no_hp))
                                                <div class="text">{{ $result_profilpegawai->no_hp }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Telepon</div>
                                            @if (!empty($result_profilpegawai->no_telp))
                                                <div class="text">{{ $result_profilpegawai->no_telp }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Pegawai</div>
                                            @if (!empty($result_profilpegawai->jenis_pegawai))
                                                <div class="text">{{ $result_profilpegawai->jenis_pegawai }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kedudukan PNS</div>
                                            @if (!empty($result_profilpegawai->kedudukan_pns))
                                                <div class="text">{{ $result_profilpegawai->kedudukan_pns }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Status Pegawai</div>
                                            @if (!empty($result_profilpegawai->status_pegawai))
                                                <div class="text">{{ $result_profilpegawai->status_pegawai }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT PNS</div>
                                            @if (!empty($result_profilpegawai->tmt_pns))
                                                <div class="text">{{ $result_profilpegawai->tmt_pns }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No. Seri Kartu Pegawai</div>
                                            @if (!empty($result_profilpegawai->no_seri_karpeg))
                                                <div class="text">{{ $result_profilpegawai->no_seri_karpeg }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT CPNS</div>
                                            @if (!empty($result_profilpegawai->tmt_cpns))
                                                <div class="text">{{ $result_profilpegawai->tmt_cpns }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tingkat Pendidikan</div>
                                            @if (!empty($result_profilpegawai->tingkat_pendidikan))
                                                <div class="text">{{ $result_profilpegawai->tingkat_pendidikan }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Pendidikan Terakhir</div>
                                            @if (!empty($result_profilpegawai->pendidikan_terakhir))
                                                <div class="text">{{ $result_profilpegawai->pendidikan_terakhir }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Ruangan</div>
                                            @if (!empty($result_profilpegawai->ruangan))
                                                <div class="text">{{ $result_profilpegawai->ruangan }}</div>
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
                                    <h3 class="card-title">Posisi & Jabatan Pegawai
                                        {{-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#posisi_jabatan_modal_tambah"><i class="fa fa-plus"></i></a></h3> --}}
                                        <a href="#" class="edit-icon" data-toggle="modal" data-target="#posisi_jabatan_modal_edit"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Unit Organisasi</div>
                                            @if (!empty($result_posisijabatan->unit_organisasi))
                                            <div class="text">{{ $result_posisijabatan->unit_organisasi }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Unit Organisasi Induk</div>
                                            @if (!empty($result_posisijabatan->unit_organisasi_induk))
                                            <div class="text">{{ $result_posisijabatan->unit_organisasi_induk }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Jabatan </div>
                                            @if (!empty($result_posisijabatan->jenis_jabatan))
                                            <div class="text">{{ $result_posisijabatan->jenis_jabatan }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Eselon </div>
                                            @if (!empty($result_posisijabatan->eselon))
                                            <div class="text">{{ $result_posisijabatan->eselon }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jabatan </div>
                                            @if (!empty($result_posisijabatan->jabatan))
                                            <div class="text">{{ $result_posisijabatan->jabatan }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT </div>
                                            @if (!empty($result_posisijabatan->tmt))
                                            <div class="text">{{ $result_posisijabatan->tmt }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Lokasi Kerja </div>
                                            @if (!empty($result_posisijabatan->lokasi_kerja))
                                            <div class="text">{{ $result_posisijabatan->lokasi_kerja }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Golongan Ruang Awal </div>
                                            @if (!empty($result_posisijabatan->gol_ruang_awal))
                                            <div class="text">{{ $result_posisijabatan->gol_ruang_awal }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Golongan Ruang Akhir </div>
                                            @if (!empty($result_posisijabatan->gol_ruang_akhir))
                                            <div class="text">{{ $result_posisijabatan->gol_ruang_akhir }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT Golongan </div>
                                            @if (!empty($result_posisijabatan->tmt_golongan))
                                            <div class="text">{{ $result_posisijabatan->tmt_golongan }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gaji Pokok </div>
                                            @if (!empty($result_posisijabatan->gaji_pokok))
                                            <div class="text">{{ $result_posisijabatan->gaji_pokok }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Tahun) </div>
                                            @if (!empty($result_posisijabatan->masa_kerja_tahun))
                                            <div class="text">{{ $result_posisijabatan->masa_kerja_tahun }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Bulan) </div>
                                            @if (!empty($result_posisijabatan->masa_kerja_bulan))
                                            <div class="text">{{ $result_posisijabatan->masa_kerja_bulan }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No SPMT </div>
                                            @if (!empty($result_posisijabatan->no_spmt))
                                            <div class="text">{{ $result_posisijabatan->no_spmt }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal SPMT </div>
                                            @if (!empty($result_posisijabatan->tanggal_spmt))
                                            <div class="text">{{ $result_posisijabatan->tanggal_spmt }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">KPPN </div>
                                            @if (!empty($result_posisijabatan->kppn))
                                            <div class="text">{{ $result_posisijabatan->kppn }}</div>
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
                <!-- /Profile Pegawai Tab -->
                            
                            <!-- Riwayat Pendidikan Tab -->
                            <div class="tab-pane fade" id="riwayat_pendidikan">    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table mb-0 datatable">
                                                <thead>
                                                    <th>No</th>
                                                    <th class="ting_ped">Tingkat Pendidikan</th>
                                                    <th class="pendidikan">Pendidikan</th>
                                                    <th class="tahun_lulus">Tahun Lulus</th>
                                                    <th class="no_ijazah">Nomor Ijazah</th>
                                                    <th class="nama_sekolah">Nama Sekolah</th>
                                                    <th class="gelar_depan_pend">Gelar Depan</th>
                                                    <th class="gelar_belakang_pend">Gelar Belakang</th>
                                                    <th class="jenis_pendidikan">Jenis Pendidikan</th>
                                                    <th class="dokumen_transkrip">Dokumen Transkrip</th>
                                                    <th class="dokumen_ijazah">Dokumen Ijazah</th>
                                                    <th class="dokumen_gelar">Dokumen Gelar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($riwayatPendidikan as $sqlpendidikan => $result_pendidikan)
                                                        <tr>
                                                            <td><center>{{ ++$sqlpendidikan }}</center></td>
                                                            <td hidden class="id"><center>{{ $result_pendidikan->id }}</center></td>
                                                            <td class="ting_ped"><center>{{ $result_pendidikan->ting_ped }}</center></td>
                                                            <td class="pendidikan"><center>{{ $result_pendidikan->pendidikan }}</center></td>
                                                            <td class="tahun_lulus"><center>{{ $result_pendidikan->tahun_lulus }}</center></td>
                                                            <td class="no_ijazah"><center>{{ $result_pendidikan->no_ijazah }}</center></td>
                                                            <td class="nama_sekolah"><center>{{ $result_pendidikan->nama_sekolah }}</center></td>
                                                            <td class="gelar_depan_pend"><center>{{ $result_pendidikan->gelar_depan_pend }}</center></td>
                                                            <td class="gelar_belakang_pend"><center>{{ $result_pendidikan->gelar_belakang_pend }}</center></td>
                                                            <td class="jenis_pendidikan"><center>{{ $result_pendidikan->jenis_pendidikan }}</center></td>
                                                            <td class="dokumen_transkrip"><center>
                                                                <a href="{{ asset('assets/DokumenTranskrip/' . $result_pendidikan->dokumen_transkrip) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                            <td class="dokumen_ijazah"><center>
                                                                <a href="{{ asset('assets/DokumenIjazah/' . $result_pendidikan->dokumen_ijazah) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                            <td class="dokumen_gelar"><center>
                                                                <a href="{{ asset('assets/DokumenGelar/' . $result_pendidikan->dokumen_gelar) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Riwayat Pendidikan Tab -->

                            <!-- Riwayat Golongan Tab -->
                            <div class="tab-pane fade" id="riwayat_golongan">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table mb-0 datatable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th class="golongan">Golongan</th>
                                                        <th class="jenis_kenaikan_pangkat">Jenis Kenaikan Pangkat (KP)</th>
                                                        <th class="jenis_kerja_golongan_tahun">Masa Kerja Golongan (Tahun)</th>
                                                        <th class="jenis_kerja_golongan_bulan">Masa Kerja Golongan (Bulan)</th>
                                                        <th class="tmt_golongan_riwayat">TMT Golongan</th>
                                                        <th class="no_teknis_bkn">No Teknis BKN</th>
                                                        <th class="tanggal_teknis_bkn">Tanggal Teknis BKN</th>
                                                        <th class="no_sk_golongan">No SK</th>
                                                        <th class="tanggal_sk_golongan">Tanggal SK</th>
                                                        <th class="dokumen_skkp">Dokumen SK KP</th>
                                                        <th class="dokumen_teknis_kp">Dokumen Teknis KP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($riwayatGolongan as $sqlgolongan => $result_golongan)
                                                        <tr>
                                                            <td><center>{{ ++$sqlgolongan }}</center></td>
                                                            <td hidden class="id"><center>{{ $result_golongan->id }}</center></td>
                                                            <td class="golongan"><center>{{ $result_golongan->golongan }}</center></td>
                                                            <td class="jenis_kenaikan_pangkat"><center>{{ $result_golongan->jenis_kenaikan_pangkat }}</center></td>
                                                            <td class="masa_kerja_golongan_tahun"><center>{{ $result_golongan->masa_kerja_golongan_tahun }}</center></td>
                                                            <td class="masa_kerja_golongan_bulan"><center>{{ $result_golongan->masa_kerja_golongan_bulan }}</center></td>
                                                            <td class="tmt_golongan_riwayat"><center>{{ \Carbon\Carbon::parse($result_golongan->tmt_golongan_riwayat)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="no_teknis_bkn"><center>{{ $result_golongan->no_teknis_bkn }}</center></td>
                                                            <td class="tanggal_teknis_bkn"><center>{{ \Carbon\Carbon::parse($result_golongan->tanggal_teknis_bkn)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="no_sk_golongan"><center>{{ $result_golongan->no_sk_golongan }}</center></td>
                                                            <td class="tanggal_sk_golongan"><center>{{ \Carbon\Carbon::parse($result_golongan->tanggal_sk_golongan)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="dokumen_skkp"><center>
                                                                <a href="{{ asset('assets/DokumenSKKP/' . $result_golongan->dokumen_skkp) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                            <td class="dokumen_teknis_kp"><center>
                                                                <a href="{{ asset('assets/DokumenTeknisKP/' . $result_golongan->dokumen_teknis_kp) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Riwayat Golongan Tab -->
                            
                            <!-- Riwayat Jabatan Tab -->
                            <div class="tab-pane fade" id="riwayat_jabatan">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table mb-0 datatable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th class="jenis_jabatan_riwayat"> Jenis Jabatan</th>
                                                        <th class="satuan_kerja">Satuan Kerja</th>
                                                        <th class="satuan_kerja_induk">Satuan Kerja Induk</th>
                                                        <th class="unit_organisasi_riwayat">Unit Organisasi</th>
                                                        <th class="no_sk">No SK</th>
                                                        <th class="tanggal_sk">Tanggal SK</th>
                                                        <th class="tmt_jabatan">TMT Jabatan</th>
                                                        <th class="tmt_pelantikan">TMT Pelantikan</th>
                                                        <th class="dokumen_sk_jabatan">Dokumen SK Jabatan</th>
                                                        <th class="dokumen_pelantikan">Dokumen Pelantikan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($riwayatJabatan as $sqljabatan => $result_jabatan)
                                                        <tr>
                                                            <td><center>{{ ++$sqljabatan }}</center></td>
                                                            <td hidden class="id"><center>{{ $result_jabatan->id }}</center></td>
                                                            <td class="jenis_jabatan_riwayat"><center>{{ $result_jabatan->jenis_jabatan_riwayat }}</center></td>
                                                            <td class="satuan_kerja"><center>{{ $result_jabatan->satuan_kerja }}</center></td>
                                                            <td class="satuan_kerja_induk"><center>{{ $result_jabatan->satuan_kerja_induk }}</center></td>
                                                            <td class="unit_organisasi_riwayat"><center>{{ $result_jabatan->unit_organisasi_riwayat }}</center></td>
                                                            <td class="no_sk"><center>{{ $result_jabatan->no_sk }}</center></td>
                                                            <td class="tanggal_sk"><center>{{ \Carbon\Carbon::parse($result_jabatan->tanggal_sk)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="tmt_jabatan"><center>{{ \Carbon\Carbon::parse($result_jabatan->tmt_jabatan)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="tmt_pelantikan"><center>{{ \Carbon\Carbon::parse($result_jabatan->tmt_pelantikan)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="dokumen_sk_jabatan"><center>
                                                                <a href="{{ asset('assets/DokumenSKJabatan/' . $result_jabatan->dokumen_sk_jabatan) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                            <td class="dokumen_pelantikan"><center>
                                                                <a href="{{ asset('assets/DokumenPelantikan/' . $result_jabatan->dokumen_pelantikan) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a></center></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Riwayat Jabatan Tab -->

                            <!-- Riwayat Diklat Tab -->
                            <div class="tab-pane fade" id="riwayat_diklat">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($riwayatDiklat as $sqldiklat => $result_diklat)
                                                <tr>
                                                    <td><center>{{ ++$sqldiklat }}</center></td>
                                                    <td hidden class="id"><center>{{ $result_diklat->id }}</center></td>
                                                    <td class="jenis_diklat"><center>{{ $result_diklat->jenis_diklat }}</center></td>
                                                    <td class="nama_diklat"><center>{{ $result_diklat->nama_diklat }}</center></td>
                                                    <td class="institusi_penyelenggara"><center>{{ $result_diklat->institusi_penyelenggara }}</center></td>
                                                    <td class="no_sertifikat"><center>{{ $result_diklat->no_sertifikat }}</center></td>
                                                    <td class="tanggal_mulai"><center>{{ \Carbon\Carbon::parse($result_diklat->tanggal_mulai)->formatLocalized('%d %B %Y') }}</center></td>
                                                    <td class="tanggal_selesai"><center>{{ \Carbon\Carbon::parse($result_diklat->tanggal_selesai)->formatLocalized('%d %B %Y') }}</center></td>
                                                    <td class="tahun_diklat"><center>{{ $result_diklat->tahun_diklat }}</center></td>
                                                    <td class="durasi_jam"><center>{{ $result_diklat->durasi_jam }}</center></td>
                                                    <td class="dokumen_diklat"><center>
                                                        <a href="{{ asset('assets/DokumenDiklat/' . $result_diklat->dokumen_diklat) }}" target="_blank">
                                                            <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                        </a></center></td>
                                                </tr>
                                            @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Riwayat Diklat Tab -->
            </div>
        </div>
        <!-- /Page Content -->

        @if (!empty($information))
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" value="{{ $information->tgl_lahir }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $information->alamat }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select" id="jk" name="jk">
                                                        <option value="Laki-Laki" {{ $information->jk === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                        <option value="Perempuan" {{ $information->jk === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
        @else
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select form-control" id="jk" name="jk">
                                                        <option selected disabled> --Pilih Jenis Kelamin --</option>
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
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
        @endif

        @if (!empty($information))
            <!-- Profile Modal -->
            <div id="profile_info_avatar" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Foto Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/information/foto/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                <input type="hidden" name="hidden_image" id="e_image" value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
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
        @else
            <!-- Profile Modal -->
            <div id="profile_info_avatar" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Foto Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/information/foto/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                <input type="hidden" name="hidden_image" id="e_image" value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
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
        @endif



                {{-- <!-- Profil Pegawai Modal Tambah -->
                <div id="profil_pegawai_modal_tambah" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Profil Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user/profile/pegawai/add') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="user_id" value="{{ $result_profilpegawai->user_id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $result_profilpegawai->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NIP <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $result_profilpegawai->nip }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gelar Depan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('gelar_depan') is-invalid @enderror" name="gelar_depan" value="{{ $result_profilpegawai->gelar_depan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gelar Belakang <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('gelar_belakang') is-invalid @enderror" name="gelar_belakang" value="{{ $result_profilpegawai->gelar_belakang }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $result_profilpegawai->tempat_lahir }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $result_profilpegawai->tanggal_lahir }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="{{ $result_profilpegawai->jenis_kelamin }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Agama</label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ $result_profilpegawai->agama }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <span class="text-danger">*</span></label>
                                                <label>Jenis Dokumen </label>
                                                <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" value="{{ $result_profilpegawai->jenis_dokumen }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <span class="text-danger">*</span></label>
                                                <label>Nomor Dokumen </label>
                                                <input type="number" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" value="{{ $result_profilpegawai->no_dokumen }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <span class="text-danger">*</span></label>
                                                <label>Kelurahan </label>
                                                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $result_profilpegawai->kelurahan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <span class="text-danger">*</span></label>
                                                <label>Kecamatan </label>
                                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ $result_profilpegawai->kecamatan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kota </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ $result_profilpegawai->kota }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Provinsi </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ $result_profilpegawai->provinsi }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Pos </label> <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $result_profilpegawai->kode_pos }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor HP </label> <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $result_profilpegawai->no_hp }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Telepon </label> <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $result_profilpegawai->no_telp }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Pegawai </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('jenis_pegawai') is-invalid @enderror" name="jenis_pegawai" value="{{ $result_profilpegawai->jenis_pegawai }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kedudukan PNS </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('kedudukan_pns') is-invalid @enderror" name="kedudukan_pns" value="{{ $result_profilpegawai->kedudukan_pns }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status Pegawai </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('status_pegawai') is-invalid @enderror" name="status_pegawai" value="{{ $result_profilpegawai->status_pegawai }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TMT PNS </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('tmt_pns') is-invalid @enderror" name="tmt_pns" value="{{ $result_profilpegawai->tmt_pns }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Seri Kartu Pegawai </label> <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('no_seri_karpeg') is-invalid @enderror" name="no_seri_karpeg" value="{{ $result_profilpegawai->no_seri_karpeg }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TMT CPNS </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('tmt_cpns') is-invalid @enderror" name="tmt_cpns" value="{{ $result_profilpegawai->tmt_cpns }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tingkat Pendidikan </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('tingkat_pendidikan') is-invalid @enderror" name="tingkat_pendidikan" value="{{ $result_profilpegawai->tingkat_pendidikan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="{{ $result_profilpegawai->pendidikan_terakhir }}">
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
                    <!-- /Profil Pegawai Modal Tambah --> --}}

                    <!-- Profil Pegawai Modal Edit -->
                    <div id="profil_pegawai_modal_edit" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Profil Pegawai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user/profile/pegawai/edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" class="form-control" name="user_id" value="{{ $result_profilpegawai->user_id }}" readonly>
                                        <div class="row">
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $result_profilpegawai->nama }}">
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIP <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $result_profilpegawai->nip }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gelar Depan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('gelar_depan') is-invalid @enderror" name="gelar_depan" value="{{ $result_profilpegawai->gelar_depan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gelar Belakang <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('gelar_belakang') is-invalid @enderror" name="gelar_belakang" value="{{ $result_profilpegawai->gelar_belakang }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $result_profilpegawai->tempat_lahir }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $result_profilpegawai->tanggal_lahir }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                                        <option value="" disabled selected>--- Pilih jenis kelamin ---</option>
                                                        <option value="Laki-Laki" @if ($result_profilpegawai->jenis_kelamin === 'Laki-Laki') selected @endif>Laki-Laki</option>
                                                        <option value="Perempuan" @if ($result_profilpegawai->jenis_kelamin === 'Perempuan') selected @endif>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agama <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect form-control @error('agama') is-invalid @enderror" name="agama">
                                                        <option value="" disabled selected>--- Pilih agama ---</option>
                                                        @foreach ($agamaOptions as $optionValue => $optionLabel)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->agama) selected @endif>
                                                                {{ $optionLabel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Dokumen <span class="text-danger">*</span></label>
                                                    <select class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen">
                                                        <option value="" disabled selected>--- Pilih jenis dokumen ---</option>
                                                        <option value="Passport" @if ($result_profilpegawai->jenis_dokumen === 'Passport') selected @endif>Passport</option>
                                                        <option value="KTP" @if ($result_profilpegawai->jenis_dokumen === 'KTP') selected @endif>KTP</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <span class="text-danger">*</span></label>
                                                    <label>Nomor Dokumen </label>
                                                    <input type="number" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" value="{{ $result_profilpegawai->no_dokumen }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <span class="text-danger">*</span></label>
                                                    <label>Kelurahan </label>
                                                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $result_profilpegawai->kelurahan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"> <span class="text-danger">*</span></label>
                                                    <label>Kecamatan </label>
                                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ $result_profilpegawai->kecamatan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kota </label> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ $result_profilpegawai->kota }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Provinsi <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ $result_profilpegawai->provinsi }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kode Pos </label> <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $result_profilpegawai->kode_pos }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor HP </label> <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $result_profilpegawai->no_hp }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Telepon </label> <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $result_profilpegawai->no_telp }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Pegawai <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect form-control @error('jenis_pegawai') is-invalid @enderror" name="jenis_pegawai">
                                                        <option value="" disabled selected>--- Pilih jenis pegawai ---</option>
                                                        @foreach ($jenispegawaiOptions as $optionValue => $optionLabel)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->jenis_pegawai) selected @endif>
                                                                {{ $optionLabel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kedudukan PNS <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect form-control @error('kedudukan_pns') is-invalid @enderror" name="kedudukan_pns">
                                                        <option value="" disabled selected>--- Pilih kedudukan ---</option>
                                                        @foreach ($kedudukanOptions as $optionValue => $optionLabel)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->kedudukan_pns) selected @endif>
                                                                {{ $optionLabel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status Pegawai <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect form-control @error('status_pegawai') is-invalid @enderror" name="status_pegawai">
                                                        <option value="" disabled selected>--- Pilih status pegawai ---</option>
                                                        <option value="Aktif" @if ($result_profilpegawai->status_pegawai === 'Aktif') selected @endif>Aktif</option>
                                                        <option value="Tidak Aktif" @if ($result_profilpegawai->status_pegawai === 'Tidak Aktif') selected @endif>Tidak Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT PNS </label> <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('tmt_pns') is-invalid @enderror" name="tmt_pns" value="{{ $result_profilpegawai->tmt_pns }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Seri Kartu Pegawai </label> <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('no_seri_karpeg') is-invalid @enderror" name="no_seri_karpeg" value="{{ $result_profilpegawai->no_seri_karpeg }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT CPNS </label> <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('tmt_cpns') is-invalid @enderror" name="tmt_cpns" value="{{ $result_profilpegawai->tmt_cpns }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tingkat Pendidikan <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect form-control @error('tingkat_pendidikan') is-invalid @enderror" name="tingkat_pendidikan">
                                                        <option value="" disabled selected>--- Pilih tingkat pendidikan ---</option>
                                                        @foreach ($tingkatpendidikanOptions as $optionValue => $optionLabel)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->tingkat_pendidikan) selected @endif>
                                                                {{ $optionLabel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pendidikan Terakhir </label> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="{{ $result_profilpegawai->pendidikan_terakhir }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ruangan <span class="text-danger">*</span></label>
                                                <br>
                                                <select class="theSelect form-control @error('ruangan') is-invalid @enderror" name="ruangan">
                                                    <option value="" disabled selected>--- Pilih ruangan ---</option>
                                                    @foreach ($ruanganOptions as $optionValue => $optionLabel)
                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->ruangan) selected @endif>
                                                            {{ $optionLabel }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                        <!-- /Profil Pegawai Modal Edit -->

                        {{-- <!-- Posisi Jabatan Modal Tambah -->
                        <div id="posisi_jabatan_modal_tambah" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Posisi & Jabatan Pegawai</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="validation" action="{{ route('user/profile/posisi/jabatan/add') }}" method="POST">
                                            @csrf
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $result_posisijabatan->user_id }}" readonly>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Unit Organisasi <span class="text-danger">*</span></label>
                                                                @if (!empty($result_posisijabatan->unit_organisasi))
                                                                <input type="text" class="form-control" name="unit_organisasi" value="{{ $result_posisijabatan->unit_organisasi }}">
                                                                @else
                                                                <input type="text" class="form-control" name="unit_organisasi">
                                                                @endif
                                                            </li>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Unit Organisasi Induk <span class="text-danger">*</span></label>
                                                                @if (!empty($result_posisijabatan->unit_organisasi_induk))
                                                                <input type="text" class="form-control" name="unit_organisasi_induk" value="{{ $result_posisijabatan->unit_organisasi_induk }}">
                                                                @else
                                                                <input type="text" class="form-control" name="unit_organisasi_induk">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Jenis Jabatan <span class="text-danger">*</span></label>
                                                                @if (!empty($result_posisijabatan->jenis_jabatan))
                                                                <input type="text" class="form-control" name="jenis_jabatan" value="{{ $result_posisijabatan->jenis_jabatan }}">
                                                                @else
                                                                <input type="text" class="form-control" name="jenis_jabatan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Eselon</label>
                                                                @if (!empty($result_posisijabatan->eselon))
                                                                <input type="text" class="form-control" name="eselon" value="{{ $result_posisijabatan->eselon }}">
                                                                @else
                                                                <input type="text" class="form-control" name="eselon">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Jabatan</label>
                                                                @if (!empty($result_posisijabatan->jabatan))
                                                                <input type="text" class="form-control" name="jabatan" value="{{ $result_posisijabatan->jabatan }}">
                                                                @else
                                                                <input type="text" class="form-control" name="jabatan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>TMT</label>
                                                                @if (!empty($result_posisijabatan->tmt))
                                                                <input type="text" class="form-control" name="tmt" value="{{ $result_posisijabatan->tmt }}">
                                                                @else
                                                                <input type="text" class="form-control" name="tmt">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Lokasi Kerja</label>
                                                                @if (!empty($result_posisijabatan->lokasi_kerja))
                                                                <input type="text" class="form-control" name="lokasi_kerja" value="{{ $result_posisijabatan->lokasi_kerja }}">
                                                                @else
                                                                <input type="text" class="form-control" name="lokasi_kerja">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Golongan Ruang Awal</label>
                                                                @if (!empty($result_posisijabatan->gol_ruang_awal))
                                                                <input type="text" class="form-control" name="gol_ruang_awal" value="{{ $result_posisijabatan->gol_ruang_awal }}">
                                                                @else
                                                                <input type="text" class="form-control" name="gol_ruang_awal">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Golongan Ruang Akhir</label>
                                                                @if (!empty($result_posisijabatan->gol_ruang_akhir))
                                                                <input type="text" class="form-control" name="gol_ruang_akhir" value="{{ $result_posisijabatan->gol_ruang_akhir }}">
                                                                @else
                                                                <input type="text" class="form-control" name="gol_ruang_akhir">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>TMT Golongan</label>
                                                                @if (!empty($result_posisijabatan->tmt_golongan))
                                                                <input type="text" class="form-control" name="tmt_golongan" value="{{ $result_posisijabatan->tmt_golongan }}">
                                                                @else
                                                                <input type="text" class="form-control" name="tmt_golongan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Gaji Pokok</label>
                                                                @if (!empty($result_posisijabatan->gaji_pokok))
                                                                <input type="text" class="form-control" name="gaji_pokok" value="{{ $result_posisijabatan->gaji_pokok }}">
                                                                @else
                                                                <input type="text" class="form-control" name="gaji_pokok">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Masa Kerja (Tahun)</label>
                                                                @if (!empty($result_posisijabatan->masa_kerja_tahun))
                                                                <input type="text" class="form-control" name="masa_kerja_tahun" value="{{ $result_posisijabatan->masa_kerja_tahun }}">
                                                                @else
                                                                <input type="text" class="form-control" name="masa_kerja_tahun">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Masa Kerja (Bulan)</label>
                                                                @if (!empty($result_posisijabatan->masa_kerja_bulan))
                                                                <input type="text" class="form-control" name="masa_kerja_bulan" value="{{ $result_posisijabatan->masa_kerja_bulan }}">
                                                                @else
                                                                <input type="text" class="form-control" name="masa_kerja_bulan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nomor SPMT</label>
                                                                @if (!empty($result_posisijabatan->no_spmt))
                                                                <input type="text" class="form-control" name="no_spmt" value="{{ $result_posisijabatan->no_spmt }}">
                                                                @else
                                                                <input type="text" class="form-control" name="no_spmt">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tanggal SPMT</label>
                                                                @if (!empty($result_posisijabatan->tanggal_spmt))
                                                                <input type="text" class="form-control" name="tanggal_spmt" value="{{ $result_posisijabatan->tanggal_spmt }}">
                                                                @else
                                                                <input type="text" class="form-control" name="tanggal_spmt">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>KPPN</label>
                                                                @if (!empty($result_posisijabatan->kppn))
                                                                <input type="text" class="form-control" name="kppn" value="{{ $result_posisijabatan->kppn }}">
                                                                @else
                                                                <input type="text" class="form-control" name="kppn">
                                                                @endif
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
                        <!-- /Posisi Jabatan Modal Tambah --> --}}

                        <!-- Posisi Jabatan Modal Edit -->
                        <div id="posisi_jabatan_modal_edit" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Posisi & Jabatan Pegawai</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="validation" action="{{ route('user/profile/posisi/jabatan/edit') }}" method="POST">
                                            @csrf
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $result_posisijabatan->user_id }}" readonly>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Unit Organisasi <span class="text-danger">*</span></label>
                                                                @if (!empty($result_posisijabatan->unit_organisasi))
                                                                <input type="text" class="form-control" name="unit_organisasi" value="{{ $result_posisijabatan->unit_organisasi }}">
                                                                @else
                                                                <input type="text" class="form-control" name="unit_organisasi">
                                                                @endif
                                                            </li>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Unit Organisasi Induk <span class="text-danger">*</span></label>
                                                                @if (!empty($result_posisijabatan->unit_organisasi_induk))
                                                                <input type="text" class="form-control" name="unit_organisasi_induk" value="{{ $result_posisijabatan->unit_organisasi_induk }}">
                                                                @else
                                                                <input type="text" class="form-control" name="unit_organisasi_induk">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Jenis Jabatan <span class="text-danger">*</span></label>
                                                                <br>
                                                                <select class="theSelect form-control @error('jenis_jabatan') is-invalid @enderror" name="jenis_jabatan">
                                                                    <option value="" disabled selected>--- Pilih jenis jabatan ---</option>
                                                                    @foreach ($jenisjabatanOptions as $optionValue => $optionLabel)
                                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_posisijabatan->jenis_jabatan) selected @endif>
                                                                            {{ $optionLabel }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Eselon</label>
                                                                @if (!empty($result_posisijabatan->eselon))
                                                                <input type="text" class="form-control" name="eselon" value="{{ $result_posisijabatan->eselon }}">
                                                                @else
                                                                <input type="text" class="form-control" name="eselon">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Jabatan</label>
                                                                @if (!empty($result_posisijabatan->jabatan))
                                                                <input type="text" class="form-control" name="jabatan" value="{{ $result_posisijabatan->jabatan }}">
                                                                @else
                                                                <input type="text" class="form-control" name="jabatan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>TMT</label>
                                                                @if (!empty($result_posisijabatan->tmt))
                                                                <input type="date" class="form-control" name="tmt" value="{{ $result_posisijabatan->tmt }}">
                                                                @else
                                                                <input type="date" class="form-control" name="tmt">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Lokasi Kerja</label>
                                                                @if (!empty($result_posisijabatan->lokasi_kerja))
                                                                <input type="text" class="form-control" name="lokasi_kerja" value="{{ $result_posisijabatan->lokasi_kerja }}">
                                                                @else
                                                                <input type="text" class="form-control" name="lokasi_kerja">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Golongan Ruang Awal</label>
                                                                <br>
                                                                <select class="theSelect form-control @error('gol_ruang_awal') is-invalid @enderror" name="gol_ruang_awal">
                                                                    <option value="" disabled selected>--- Pilih golongan ruang awal ---</option>
                                                                    @foreach ($golonganOptions as $optionValue => $optionLabel)
                                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_posisijabatan->gol_ruang_awal) selected @endif>
                                                                            {{ $optionLabel }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Golongan Ruang Akhir</label>
                                                                <br>
                                                                <select class="theSelect form-control @error('gol_ruang_akhir') is-invalid @enderror" name="gol_ruang_akhir">
                                                                    <option value="" disabled selected>--- Pilih golongan ruang akhir ---</option>
                                                                    @foreach ($golonganOptions as $optionValue => $optionLabel)
                                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_posisijabatan->gol_ruang_akhir) selected @endif>
                                                                            {{ $optionLabel }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>TMT Golongan</label>
                                                                @if (!empty($result_posisijabatan->tmt_golongan))
                                                                <input type="date" class="form-control" name="tmt_golongan" value="{{ $result_posisijabatan->tmt_golongan }}">
                                                                @else
                                                                <input type="date" class="form-control" name="tmt_golongan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Gaji Pokok</label>
                                                                @if (!empty($result_posisijabatan->gaji_pokok))
                                                                <input type="number" class="form-control" name="gaji_pokok" value="{{ $result_posisijabatan->gaji_pokok }}">
                                                                @else
                                                                <input type="number" class="form-control" name="gaji_pokok">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Masa Kerja (Tahun)</label>
                                                                @if (!empty($result_posisijabatan->masa_kerja_tahun))
                                                                <input type="number" class="form-control" name="masa_kerja_tahun" value="{{ $result_posisijabatan->masa_kerja_tahun }}">
                                                                @else
                                                                <input type="number" class="form-control" name="masa_kerja_tahun">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Masa Kerja (Bulan)</label>
                                                                @if (!empty($result_posisijabatan->masa_kerja_bulan))
                                                                <input type="number" class="form-control" name="masa_kerja_bulan" value="{{ $result_posisijabatan->masa_kerja_bulan }}">
                                                                @else
                                                                <input type="number" class="form-control" name="masa_kerja_bulan">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nomor SPMT</label>
                                                                @if (!empty($result_posisijabatan->no_spmt))
                                                                <input type="number" class="form-control" name="no_spmt" value="{{ $result_posisijabatan->no_spmt }}">
                                                                @else
                                                                <input type="number" class="form-control" name="no_spmt">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tanggal SPMT</label>
                                                                @if (!empty($result_posisijabatan->tanggal_spmt))
                                                                <input type="date" class="form-control" name="tanggal_spmt" value="{{ $result_posisijabatan->tanggal_spmt }}">
                                                                @else
                                                                <input type="date" class="form-control" name="tanggal_spmt">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>KPPN</label>
                                                                @if (!empty($result_posisijabatan->kppn))
                                                                <input type="text" class="form-control" name="kppn" value="{{ $result_posisijabatan->kppn }}">
                                                                @else
                                                                <input type="text" class="form-control" name="kppn">
                                                                @endif
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
                        <!-- /Posisi Jabatan Modal Edit -->



        <!-- /Page Content -->
    </div>

    @section('script')
        <script>
            $('#validation').validate({  
                rules: {  
                    unit_organisasi: 'required',
                    unit_organisasi_induk: 'required',
                    jenis_jabatan: 'required',
                    eselon: 'required',
                    jabatan: 'required',
                    tmt: 'required',
                    lokasi_kerja: 'required',
                    gol_ruang_awal: 'required',
                    gol_ruang_akhir: 'required',
                    tmt_golongan: 'required',
                    gaji_pokok: 'required',
                    masa_kerja_tahun: 'required',
                    masa_kerja_bulan: 'required',
                    no_spmt: 'required',
                    tanggal_spmt: 'required',
                    kppn: 'required',
                },  
                messages: {
                    unit_organisasi: 'Masukkan unit organisasi',
                    unit_organisasi_induk: 'Masukkan unit organisasi induk',
                    jenis_jabatan: 'Masukkan jenis jabatan',
                    eselon: 'Masukkan eselon',
                    jabatan: 'Masukkan jabatan',
                    tmt: 'Masukkan tmt',
                    lokasi_kerja: 'Masukkan lokasi kerja',
                    gol_ruang_awal: 'Masukkan golongan ruang awal',
                    gol_ruang_akhir: 'Masukkan golongan ruang akhir',
                    tmt_golongan: 'Masukkan tmt golongan',
                    gaji_pokok: 'Masukkan gaji pokok',
                    masa_kerja_tahun: 'Masukkan masa kerja tahun',
                    masa_kerja_bulan: 'Masukkan masa kerja bulan',
                    no_spmt: 'Masukkan nomor spmt',
                    tanggal_spmt: 'Masukkan tanggal spmt',
                    kppn: 'Masukkan kppn',
                },  
                submitHandler: function(form) {  
                    form.submit();
                }  
            });  
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
		$(".theSelect").select2();
	    </script>
        @endsection
@endsection