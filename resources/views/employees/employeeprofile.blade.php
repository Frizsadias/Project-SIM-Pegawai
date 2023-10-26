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
                                            <div class="pro-edit">
                                                <a data-target="#profile_info_avatar" data-toggle="modal" class="edit-icon-avatar" href="#">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $users->name }}</h3>
                                                <div class="staff-id">ID Pegawai : {{ $users->user_id }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung : {{ \Carbon\Carbon::parse(Session::get('join_date'))->translatedFormat('l, j F Y || h:i A') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">E-mail :</div>
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
                                                        @if (!empty($users->tgl_lahir))<a>{{ date('d F Y', strtotime($users->tgl_lahir)) }}</a>
                                                        @else
                                                            <a>N/A</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Tempat Lahir :</div>
                                                    <div class="text">
                                                        @if (!empty($users->tmpt_lahir))
                                                            <a>{{ $users->tmpt_lahir }}</a>
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
                                                @if (!empty($users->name))
                                                    <div class="text">{{ $users->name }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">NIP</div>
                                                @if (!empty($users->nip))
                                                    <div class="text">{{ $users->nip }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
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
                                                    <div class="text">N/A</div>
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
                                            <li>
                                                <div class="title">Ruangan</div>
                                                @if (!empty($users->ruangan))
                                                    <div class="text">{{ $users->ruangan }}</div>
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
                                                @if (!empty($users->unit_organisasi))
                                                <div class="text">{{ $users->unit_organisasi }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Unit Organisasi Induk</div>
                                                @if (!empty($users->unit_organisasi_induk))
                                                <div class="text">{{ $users->unit_organisasi_induk }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Jenis Jabatan </div>
                                                @if (!empty($users->jenis_jabatan))
                                                <div class="text">{{ $users->jenis_jabatan }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Eselon </div>
                                                @if (!empty($users->eselon))
                                                <div class="text">{{ $users->eselon }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Jabatan </div>
                                                @if (!empty($users->jabatan))
                                                <div class="text">{{ $users->jabatan }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">TMT </div>
                                                @if (!empty($users->tmt))
                                                <div class="text">{{ $users->tmt }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Lokasi Kerja </div>
                                                @if (!empty($users->lokasi_kerja))
                                                <div class="text">{{ $users->lokasi_kerja }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Golongan Ruang Awal </div>
                                                @if (!empty($users->gol_ruang_awal))
                                                <div class="text">{{ $users->gol_ruang_awal }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Golongan Ruang Akhir </div>
                                                @if (!empty($users->gol_ruang_akhir))
                                                <div class="text">{{ $users->gol_ruang_akhir }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">TMT Golongan </div>
                                                @if (!empty($users->tmt_golongan))
                                                <div class="text">{{ $users->tmt_golongan }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Gaji Pokok </div>
                                                @if (!empty($users->gaji_pokok))
                                                <div class="text">{{ $users->gaji_pokok }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Masa Kerja (Tahun) </div>
                                                @if (!empty($users->masa_kerja_tahun))
                                                <div class="text">{{ $users->masa_kerja_tahun }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Masa Kerja (Bulan) </div>
                                                @if (!empty($users->masa_kerja_bulan))
                                                <div class="text">{{ $users->masa_kerja_bulan }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">No SPMT </div>
                                                @if (!empty($users->no_spmt))
                                                <div class="text">{{ $users->no_spmt }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Tanggal SPMT </div>
                                                @if (!empty($users->tanggal_spmt))
                                                <div class="text">{{ $users->tanggal_spmt }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">KPPN </div>
                                                @if (!empty($users->kppn))
                                                <div class="text">{{ $users->kppn }}</div>
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
                            <div class="col-auto float-right ml-auto"><a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_pendidikan"><i class="fa fa-plus"></i> Tambah Riwayat Pendidikan</a></div>
                            <br><br>
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
                                            <th class="aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatPendidikan as $sqlpend => $result_pendidikan)
                                                <tr>
                                                    <td><center>{{ ++$sqlpend }}</center></td>
                                                    <td hidden class="id"><center>{{ $result_pendidikan->id }}</center></td>
                                                    <td hidden class="id_pend"><center>{{ $result_pendidikan->id_pend }}</center></td>
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
                                                            @if (pathinfo($result_pendidikan->dokumen_transkrip, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_transkrip">{{ $result_pendidikan->dokumen_transkrip }}</td>
                                                        </a></center></td>
                                                    <td class="dokumen_ijazah"><center>
                                                        <a href="{{ asset('assets/DokumenIjazah/' . $result_pendidikan->dokumen_ijazah) }}" target="_blank">
                                                            @if (pathinfo($result_pendidikan->dokumen_ijazah, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_ijazah">{{ $result_pendidikan->dokumen_ijazah }}</td>
                                                        </a></center></td>
                                                    <td class="dokumen_gelar"><center>
                                                        <a href="{{ asset('assets/DokumenGelar/' . $result_pendidikan->dokumen_gelar) }}" target="_blank">
                                                            @if (pathinfo($result_pendidikan->dokumen_gelar, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_gelar">{{ $result_pendidikan->dokumen_gelar }}</td>
                                                        </a></center></td>

                                                    {{-- Edit dan Hapus data  --}}
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit_riwayat_pendidikan" href="#"
                                                                    data-toggle="modal" data-target="#edit_riwayat_pendidikan"><i
                                                                        class="fa fa-pencil m-r-5"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item delete_riwayat_pendidikan" href="#"
                                                                    data-toggle="modal" data-target="#delete_riwayat_pendidikan"><i
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
                        <!-- Tambah Riwayat Modal -->
                        <div id="add_riwayat_pendidikan" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Riwayat Pendidikan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/pendidikan/tambah-data') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tingkat Pendidikan</label>
                                                    <br>
                                                    <select class="theSelect form-control" name="ting_ped" id="ting_ped">
                                                        <option value="" disabled selected>--- Pilih tingkat pendidikan ---</option>
                                                        @foreach($tingkatpendidikanOptions as $id => $namaTingkatPendidikan)
                                                            <option value="{{ $id }}" {{ $id == $users->tingkat_pendidikan ? 'selected' : '' }}>{{ $namaTingkatPendidikan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pendidikan</label>
                                                        <input type="text" class="form-control" name="pendidikan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Lulus</label>
                                                        <input type="number" class="form-control" name="tahun_lulus" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Ijazah</label>
                                                        <input type="text" class="form-control" name="no_ijazah" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Sekolah</label>
                                                        <input type="text" class="form-control" name="nama_sekolah" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gelar Depan</label>
                                                        <input type="text" class="form-control" name="gelar_depan_pend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gelar Belakang</label>
                                                        <input type="text" class="form-control" name="gelar_belakang_pend">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Pendidikan</label>
                                                        <br>
                                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Pertama">
                                                        Pendidikan Pertama
                                                        <br>
                                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Kedua">
                                                        Pendidikan Kedua
                                                        <br>
                                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Ketiga">
                                                        Pendidikan Ketiga
                                                        <br>
                                                        <input type="checkbox" name="jenis_pendidikan" value="Pendidikan Keempat">
                                                        Pendidikan Keempat
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Transkrip Nilai</label>
                                                        <input type="file" class="form-control" name="dokumen_transkrip">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Ijazah</label>
                                                        <input type="file" class="form-control" name="dokumen_ijazah">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Pencantuman Gelar </label>
                                                        <input type="file" class="form-control" name="dokumen_gelar">
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
                        <!-- /Tambah Riwayat Modal -->
                        <!-- Edit Riwayat Pendidikan Modal -->
                        <div id="edit_riwayat_pendidikan" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Pendidikan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/pendidikan/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id_pend" id="e_id_pend" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tingkat Pendidikan </label>
                                                <br>
                                                <select class="theSelect" name="ting_ped" id="e_ting_ped">
                                                    <option value="" disabled selected>--- Pilih tingkat pendidikan ---</option>
                                                    @foreach($tingkatpendidikanOptions as $id => $namaTingkatPendidikan)
                                                        <option value="{{ $id }}" {{ $id == $users->tingkat_pendidikan ? 'selected' : '' }}>{{ $namaTingkatPendidikan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pendidikan</label>
                                                        <input type="text" class="form-control" name="pendidikan" id="e_pendidikan" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Lulus</label>
                                                        <input type="number" class="form-control" name="tahun_lulus" id="e_tahun_lulus" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Ijazah</label>
                                                        <input type="text" class="form-control" name="no_ijazah" id="e_no_ijazah" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Sekolah</label>
                                                        <input type="text" class="form-control" name="nama_sekolah" id="e_nama_sekolah" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gelar Depan</label>
                                                        <input type="text" class="form-control" name="gelar_depan_pend" id="e_gelar_depan_pend" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gelar Belakang</label>
                                                        <input type="text" class="form-control" name="gelar_belakang_pend" id="e_gelar_belakang_pend" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Pendidikan</label>
                                                        <input type="text" class="form-control" name="jenis_pendidikan" id="e_jenis_pendidikan" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Transkrip</label>
                                                        <input type="file" class="form-control" id="dokumen_transkrip" name="dokumen_transkrip">
                                                        <input type="hidden" name="hidden_dokumen_transkrip" id="e_dokumen_transkrip" value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Ijazah</label>
                                                        <input type="file" class="form-control" id="dokumen_ijazah" name="dokumen_ijazah">
                                                        <input type="hidden" name="hidden_dokumen_ijazah" id="e_dokumen_ijazah" value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Gelar</label>
                                                        <input type="file" class="form-control" id="dokumen_gelar" name="dokumen_gelar">
                                                        <input type="hidden" name="hidden_dokumen_gelar" id="e_dokumen_gelar" value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section">
                                                <button class="btn btn-primary submit-btn">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Riwayat Pendidikan Modal -->

                        <!-- Delete Riwayat Pendidikan Modal -->
                        <div class="modal custom-modal fade" id="delete_riwayat_pendidikan" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Riwayat Pendidikan</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('riwayat/pendidikan/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id" value="{{ $result_pendidikan->id }}">
                                                <input type="hidden" name="dokumen_transkrip" class="d_dokumen_transkrip" value="{{ $result_pendidikan->dokumen_transkrip }}">
                                                <input type="hidden" name="dokumen_ijazah" class="d_dokumen_ijazah" value="{{ $result_pendidikan->dokumen_ijazah }}">
                                                <input type="hidden" name="dokumen_gelar" class="d_dokumen_gelar" value="{{ $result_pendidikan->dokumen_gelar }}">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit"
                                                            class="btn btn-danger continue-btn submit-btn">Hapus</button>
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
                        <!-- End Delete Riwayat Pendidikan Modal -->
                    </div>
                    <!-- /Riwayat Pendidikan Tab -->

                    <!-- Riwayat Golongan Tab -->
                    <div class="tab-pane fade" id="riwayat_golongan">
                        <div class="row">
                            <div class="col-auto float-right ml-auto"><a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_golongan"><i class="fa fa-plus"></i> Tambah Riwayat Golongan</a></div>
                            <br><br>
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
                                                <th class="aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatGolongan as $sqlgol => $result_golongan)
                                                <tr>
                                                    <td><center>{{ ++$sqlgol }}</center></td>
                                                    <td hidden class="id"><center>{{ $result_golongan->id }}</center></td>
                                                    <td hidden class="id_gol"><center>{{ $result_golongan->id_gol }}</center></td>
                                                    <td class="golongan"><center>{{ $result_golongan->golongan }}</center></td>
                                                    <td class="jenis_kenaikan_pangkat"><center>{{ $result_golongan->jenis_kenaikan_pangkat }}</center></td>
                                                    <td class="masa_kerja_golongan_tahun"><center>{{ $result_golongan->masa_kerja_golongan_tahun }}</center></td>
                                                    <td class="masa_kerja_golongan_bulan"><center>{{ $result_golongan->masa_kerja_golongan_bulan }}</center></td>
                                                    <td class="tmt_golongan_riwayat"><center>{{ $result_golongan->tmt_golongan_riwayat }}</center></td>
                                                    <td class="no_teknis_bkn"><center>{{ $result_golongan->no_teknis_bkn }}</center></td>
                                                    <td class="tanggal_teknis_bkn"><center>{{ $result_golongan->tanggal_teknis_bkn }}</center></td>
                                                    <td class="no_sk_golongan"><center>{{ $result_golongan->no_sk_golongan }}</center></td>
                                                    <td class="tanggal_sk_golongan"><center>{{ $result_golongan->tanggal_sk_golongan }}</center></td>
                                                    <td class="dokumen_skkp"><center>
                                                        <a href="{{ asset('assets/DokumenSKKP/' . $result_golongan->dokumen_skkp) }}" target="_blank">
                                                            @if (pathinfo($result_golongan->dokumen_skkp, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_skkp">{{ $result_golongan->dokumen_skkp }}</td>
                                                        </a></center></td>
                                                    <td class="dokumen_teknis_kp"><center>
                                                        <a href="{{ asset('assets/DokumenTeknisKP/' . $result_golongan->dokumen_teknis_kp) }}" target="_blank">
                                                            @if (pathinfo($result_golongan->dokumen_teknis_kp, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_teknis_kp">{{ $result_golongan->dokumen_teknis_kp }}</td>
                                                        </a></center></td>

                                                    {{-- Edit dan Hapus data  --}}
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit_riwayat_golongan" href="#" data-toggle="modal" data-target="#edit_riwayat_golongan"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item delete_riwayat_golongan" href="#" data-toggle="modal" data-target="#delete_riwayat_golongan"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                            <!-- Tambah Riwayat Golongan Modal -->
                            <div id="add_riwayat_golongan" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Riwayat Golongan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat/golongan/tambah-data') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan</label>
                                                            <input type="text" class="form-control" name="golongan" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Kenaikan Pangkat (KP)</label>
                                                            <input type="text" class="form-control" name="jenis_kenaikan_pangkat"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja Golongan (Tahun)</label>
                                                            <input type="number" class="form-control" name="masa_kerja_golongan_tahun"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja Golongan (Bulan)</label>
                                                            <input type="number" class="form-control" name="masa_kerja_golongan_bulan"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Golongan</label>
                                                            <input type="date" class="form-control" name="tmt_golongan_riwayat" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor Pertimbangan Teknis BKN</label>
                                                            <input type="number" class="form-control" name="no_teknis_bkn" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Pertimbangan Teknis BKN</label>
                                                            <input type="date" class="form-control" name="tanggal_teknis_bkn" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor SK</label>
                                                            <input type="text" class="form-control" name="no_sk_golongan" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SK</label>
                                                            <input type="date" class="form-control" name="tanggal_sk_golongan" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen SK KP</label>
                                                            <input type="file" class="form-control" name="dokumen_skkp">
                                                            <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen Pertimbangan Teknis KP</label>
                                                            <input type="file" class="form-control" name="dokumen_teknis_kp">
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
                            <!-- /Tambah Riwayat Golongan Modal -->
                            <!-- Edit Riwayat Golongan Modal -->
                            <div id="edit_riwayat_golongan" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Riwayat Golongan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat/golongan/edit-data') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_gol" id="e_id_gol" value="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan</label>
                                                            <input type="text" class="form-control" name="golongan" id="e_golongan" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Kenaikan Pangkat</label>
                                                            <input type="text" class="form-control" name="jenis_kenaikan_pangkat" id="e_jenis_kenaikan_pangkat" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja Golongan (Tahun)</label>
                                                            <input type="number" class="form-control" name="masa_kerja_golongan_tahun" id="e_masa_kerja_golongan_tahun" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja golongan (Bulan)</label>
                                                            <input type="number" class="form-control" name="masa_kerja_golongan_bulan" id="e_masa_kerja_golongan_bulan" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Golongan</label>
                                                            <input type="date" class="form-control" name="tmt_golongan_riwayat" id="e_tmt_golongan_riwayat" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor Teknis BKN</label>
                                                            <input type="number" class="form-control" name="no_teknis_bkn" id="e_no_teknis_bkn" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Teknis BKN</label>
                                                            <input type="date" class="form-control" name="tanggal_teknis_bkn" id="e_tanggal_teknis_bkn" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor SK</label>
                                                            <input type="text" class="form-control" name="no_sk_golongan" id="e_no_sk_golongan" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SK</label>
                                                            <input type="date" class="form-control" name="tanggal_sk_golongan" id="e_tanggal_sk_golongan" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen SK KP</label>
                                                            <input type="file" class="form-control" id="dokumen_skkp" name="dokumen_skkp">
                                                            <input type="hidden" name="hidden_dokumen_skkp" id="e_dokumen_skkp" value="">
                                                            <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen Teknis KP</label>
                                                            <input type="file" class="form-control" id="dokumen_teknis_kp" name="dokumen_teknis_kp">
                                                            <input type="hidden" name="hidden_dokumen_teknis_kp" id="e_dokumen_teknis_kp" value="">
                                                            <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Riwayat Golongan Modal -->

                            <!-- Delete Riwayat Golongan Modal -->
                            <div class="modal custom-modal fade" id="delete_riwayat_golongan" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Hapus Riwayat Golongan</h3>
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <form action="{{ route('riwayat/golongan/hapus-data') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" class="e_id" value="{{ $result_golongan->id }}">
                                                    <input type="hidden" name="dokumen_skkp" class="d_dokumen_skkp" value="{{ $result_golongan->dokumen_skkp }}">
                                                    <input type="hidden" name="dokumen_teknis_kp" class="d_dokumen_teknis_kp" value="{{ $result_golongan->dokumen_teknis_kp }}">
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
                            <!-- End Delete Riwayat Golongan Modal -->
                    </div>
                    <!-- /Riwayat Golongan Tab -->
                    
                    <!-- Riwayat Jabatan Tab -->
                    <div class="tab-pane fade" id="riwayat_jabatan">
                        <div class="row">
                            <div class="col-auto float-right ml-auto"><a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_jabatan"><i class="fa fa-plus"></i> Tambah Riwayat Jabatan</a></div>
                            <br><br>
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
                                                <th class="aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($riwayatJabatan as $sqljab => $result_jabatan)
                                                <tr>
                                                    <td><center>{{ ++$sqljab }}</center></td>
                                                    <td hidden class="id"><center>{{ $result_jabatan->id }}</center></td>
                                                    <td hidden class="id_jab"><center>{{ $result_jabatan->id_jab }}</center></td>
                                                    <td class="jenis_jabatan_riwayat"><center>{{ $result_jabatan->jenis_jabatan_riwayat }}</center></td>
                                                    <td class="satuan_kerja"><center>{{ $result_jabatan->satuan_kerja }}</center></td>
                                                    <td class="satuan_kerja_induk"><center>{{ $result_jabatan->satuan_kerja_induk }}</center></td>
                                                    <td class="unit_organisasi_riwayat"><center>{{ $result_jabatan->unit_organisasi_riwayat }}</center></td>
                                                    <td class="no_sk"><center>{{ $result_jabatan->no_sk }}</center></td>
                                                    <td class="tanggal_sk"><center>{{ $result_jabatan->tanggal_sk }}</center></td>
                                                    <td class="tmt_jabatan"><center>{{ $result_jabatan->tmt_jabatan }}</center></td>
                                                    <td class="tmt_pelantikan"><center>{{ $result_jabatan->tmt_pelantikan }}</center></td>
                                                    <td class="dokumen_sk_jabatan"><center>
                                                        <a href="{{ asset('assets/DokumenSKJabatan/' . $result_jabatan->dokumen_sk_jabatan) }}" target="_blank">
                                                            @if (pathinfo($result_jabatan->dokumen_sk_jabatan, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_sk_jabatan">{{ $result_jabatan->dokumen_sk_jabatan }}</td>
                                                        </a></center></td>
                                                    <td class="dokumen_pelantikan"><center>
                                                        <a href="{{ asset('assets/DokumenPelantikan/' . $result_jabatan->dokumen_pelantikan) }}" target="_blank">
                                                            @if (pathinfo($result_jabatan->dokumen_pelantikan, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_pelantikan">{{ $result_jabatan->dokumen_pelantikan }}</td>
                                                        </a></center></td>

                                                    {{-- Edit dan Hapus data  --}}
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit_riwayat_jabatan" href="#"
                                                                    data-toggle="modal" data-target="#edit_riwayat_jabatan"><i
                                                                        class="fa fa-pencil m-r-5"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item delete_riwayat_jabatan" href="#"
                                                                    data-toggle="modal" data-target="#delete_riwayat_jabatan"><i
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
                            <!-- Tambah Riwayat Jabatan Modal -->
                            <div id="add_riwayat_jabatan" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Riwayat Jabatan
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat/jabatan/tambah-data') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Jabatan</label>
                                                            <br>
                                                            <select class="theSelect form-control" name="jenis_jabatan_riwayat">
                                                                <option value="" disabled selected>--- Pilih jenis jabatan ---</option>
                                                                @foreach ($jenisjabatanOptions as $optionValue => $optionLabel)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->jenis_jabatan) selected @endif>
                                                                        {{ $optionLabel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Satuan Kerja</label>
                                                            <input class="form-control" type="text" name="satuan_kerja" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Satuan Kerja Induk</label>
                                                            <input class="form-control" type="text" name="satuan_kerja_induk" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Unit Organisasi</label>
                                                            <input class="form-control" type="text" name="unit_organisasi_riwayat" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor SK</label>
                                                            <input class="form-control" type="text" name="no_sk" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SK</label>
                                                            <input class="form-control" type="date" name="tanggal_sk" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Jabatan</label>
                                                            <input class="form-control" type="date" name="tmt_jabatan" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Pelantikan</label>
                                                            <input class="form-control" type="date" name="tmt_pelantikan" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen SK Jabatan</label>
                                                            <input class="form-control" type="file" name="dokumen_sk_jabatan">
                                                            <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen Pelantikan</label>
                                                            <input class="form-control" type="file" name="dokumen_pelantikan">
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
                            <!-- /Tambah Riwayat Jabatan Modal -->
                            <!-- Edit Riwayat Jabatan Modal -->
                            <div id="edit_riwayat_jabatan" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Riwayat Jabatan
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat/jabatan/edit-data') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_jab" id="e_id_jab" value="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Jabatan
                                                            </label>
                                                            <select name="jenis_jabatan_riwayat" class="select" id="e_jenis_jabatan_riwayat">
                                                                <option selected disabled> --Pilih Jenis Jabatan --</option>
                                                                <option>Jabatan Struktural</option>
                                                                <option>Jabatan Fungsional Tertentu</option>
                                                                <option>Jabatan Fungsional Umum</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Satuan Kerja</label>
                                                            <input type="text" class="form-control" name="satuan_kerja" id="e_satuan_kerja" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Satuan Kerja Induk</label>
                                                            <input type="text" class="form-control" name="satuan_kerja_induk" id="e_satuan_kerja_induk" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Unit Organisasi</label>
                                                            <input type="text" class="form-control" name="unit_organisasi_riwayat" id="e_unit_organisasi_riwayat" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor SK</label>
                                                            <input type="text" class="form-control" name="no_sk" id="e_no_sk" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SK</label>
                                                            <input type="date" class="form-control" name="tanggal_sk" id="e_tanggal_sk" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Jabatan</label>
                                                            <input type="date" class="form-control" name="tmt_jabatan" id="e_tmt_jabatan" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Pelantikan</label>
                                                            <input type="date" class="form-control" name="tmt_pelantikan" id="e_tmt_pelantikan" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen SK Jabatan</label>
                                                            <input type="file" class="form-control" id="dokumen_sk_jabatan" name="dokumen_sk_jabatan">
                                                            <input type="hidden" name="hidden_dokumen_sk_jabatan" id="e_dokumen_sk_jabatan" value="">
                                                            <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dokumen Pelantikan</label>
                                                            <input type="file" class="form-control" id="dokumen_pelantikan" name="dokumen_pelantikan">
                                                            <input type="hidden" name="hidden_dokumen_pelantikan" id="e_dokumen_pelantikan" value="">
                                                            <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Riwayat Jabatan Modal -->

                            <!-- Delete Riwayat Jabatan Modal -->
                            <div class="modal custom-modal fade" id="delete_riwayat_jabatan" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Hapus Riwayat Jabatan</h3>
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <form action="{{ route('riwayat/jabatan/hapus-data') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" class="e_id" value="{{ $result_jabatan->id }}">
                                                    <input type="hidden" name="dokumen_sk_jabatan" class="d_dokumen_sk_jabatan" value="{{ $result_jabatan->dokumen_sk_jabatan }}">
                                                    <input type="hidden" name="dokumen_pelantikan" class="d_dokumen_pelantikan" value="{{ $result_jabatan->dokumen_pelantikan }}">
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
                            <!-- End Delete Riwayat Jabatan Modal -->
                    </div>
                    <!-- /Riwayat Jabatan Tab -->

                    <!-- Riwayat Diklat Tab -->
                    <div class="tab-pane fade" id="riwayat_diklat">
                        <div class="row">
                            <div class="col-auto float-right ml-auto"><a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_diklat"><i class="fa fa-plus"></i> Tambah Riwayat Diklat</a></div>
                            <br><br>
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
                                                <th class="aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($riwayatDiklat as $sqldik => $result_diklat)
                                        <tr>
                                            <td><center>{{ ++$sqldik }}</center></td>
                                            <td hidden class="id"><center>{{ $result_diklat->id }}</center></td>
                                            <td hidden class="id_dik"><center>{{ $result_diklat->id_dik }}</center></td>
                                            <td class="jenis_diklat"><center>{{ $result_diklat->jenis_diklat }}</center></td>
                                            <td class="nama_diklat"><center>{{ $result_diklat->nama_diklat }}</center></td>
                                            <td class="institusi_penyelenggara"><center>{{ $result_diklat->institusi_penyelenggara }}</center></td>
                                            <td class="no_sertifikat"><center>{{ $result_diklat->no_sertifikat }}</center></td>
                                            <td class="tanggal_mulai"><center>{{ $result_diklat->tanggal_mulai }}</center></td>
                                            <td class="tanggal_selesai"><center>{{ $result_diklat->tanggal_selesai }}</center></td>
                                            <td class="tahun_diklat"><center>{{ $result_diklat->tahun_diklat }}</center></td>
                                            <td class="durasi_jam"><center>{{ $result_diklat->durasi_jam }}</center></td>
                                            <td class="dokumen_diklat"><center>
                                                <a href="{{ asset('assets/DokumenDiklat/' . $result_diklat->dokumen_diklat) }}" target="_blank">
                                                    @if (pathinfo($result_diklat->dokumen_diklat, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                    @endif
                                                        <td hidden class="dokumen_diklat">{{ $result_diklat->dokumen_diklat }}</td>
                                                </a></center></td>
                                            
                                            {{-- Edit dan Hapus data  --}}
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit_riwayat_diklat" href="#"
                                                            data-toggle="modal" data-target="#edit_riwayat_diklat"><i
                                                                class="fa fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item delete_riwayat_diklat" href="#"
                                                            data-toggle="modal" data-target="#delete_riwayat_diklat"><i
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
                        <!-- Tambah Riwayat Diklat Modal -->
                        <div id="add_riwayat_diklat" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Riwayat Diklat</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/diklat/tambah-data') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Diklat</label>
                                                        <br>
                                                        <select class="theSelect form-control" name="jenis_diklat" required>
                                                            <option selected disabled> --Pilih Jenis Diklat --</option>
                                                            @foreach($jenisdiklatOptions as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Diklat</label>
                                                        <input class="form-control" type="text" name="nama_diklat" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Institusi Penyelenggara</label>
                                                        <input class="form-control" type="text" name="institusi_penyelenggara"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Sertifikat</label>
                                                        <input class="form-control" type="text" name="no_sertifikat" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Mulai</label>
                                                        <input class="form-control" type="date" name="tanggal_mulai" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai</label>
                                                        <input class="form-control" type="date" name="tanggal_selesai" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Diklat</label>
                                                        <input class="form-control" type="number" name="tahun_diklat" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Durasi (Jam)</label>
                                                        <input class="form-control" type="number" name="durasi_jam" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Diklat</label>
                                                        <input class="form-control" type="file" name="dokumen_diklat" required>
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
                        <div id="edit_riwayat_diklat" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Diklat</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/diklat/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id_dik" id="e_id_dik" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Diklat</label>
                                                        <select name="jenis_diklat" class="select" id="e_jenis_diklat">
                                                            <option selected disabled> --Pilih Jenis Diklat --</option>
                                                            <option>Diklat Struktural</option>
                                                            <option>Diklat Fungsional</option>
                                                            <option>Diklat Teknis</option>
                                                            <option>Workshop</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Diklat</label>
                                                        <input type="text" class="form-control" name="nama_diklat" id="e_nama_diklat" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Institusi Penyelenggara</label>
                                                        <input type="text" class="form-control" name="institusi_penyelenggara" id="e_institusi_penyelenggara" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>No Sertifikat</label>
                                                        <input type="text" class="form-control" name="no_sertifikat" id="e_no_sertifikat" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Mulai</label>
                                                        <input type="date" class="form-control" name="tanggal_mulai" id="e_tanggal_mulai" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai</label>
                                                        <input type="date" class="form-control" name="tanggal_selesai" id="e_tanggal_selesai" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Diklat</label>
                                                        <input type="number" class="form-control" name="tahun_diklat" id="e_tahun_diklat" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Durasi (Jam)</label>
                                                        <input type="number" class="form-control" name="durasi_jam" id="e_durasi_jam" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Diklat</label>
                                                        <input type="file" class="form-control" name="dokumen_diklat"
                                                            id="dokumen_diklat">
                                                        <input type="hidden" name="hidden_dokumen_diklat" id="e_dokumen_diklat" value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section">
                                                <button class="btn btn-primary submit-btn">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Riwayat Diklat Modal -->

                        <!-- Delete Riwayat Diklat Modal -->
                        <div class="modal custom-modal fade" id="delete_riwayat_diklat" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Riwayat Diklat</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('riwayat/diklat/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id" value="{{ $result_diklat->id }}">
                                                <input type="hidden" name="dokumen_diklat" class="d_dokumen_diklat" value="{{ $result_diklat->dokumen_diklat }}">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit"
                                                            class="btn btn-primary continue-btn submit-btn">Hapus</button>
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
                        <!-- End Delete Riwayat Diklat Modal -->
                    </div>
                    <!-- /Riwayat Diklat Tab -->

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
                                                            <small class="text-danger">Example : 10-10-2013</small>
                                                        @else
                                                            <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    @if (!empty($users))
                                                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" value="{{ $users->tmpt_lahir }}">
                                                    @else
                                                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir">
                                                    @endif
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
                                                    <select class="select" id="jk" name="jk">
                                                        @if (!empty($users))
                                                            <option value="Laki-Laki" {{ $users->jk === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                            <option value="Perempuan" {{ $users->jk === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                        @else
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @if (!empty($users))
                                                        <input type="hidden" class="form-control" id="avatar" name="avatar" value="{{ $users->avatar }}">
                                                    @else
                                                        <input type="hidden" class="form-control" id="avatar" name="avatar">
                                                    @endif
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
                                <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}" readonly>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $users->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIP <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $users->nip }}">
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
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}" readonly>
                                    <div class="row">
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="nama" value="{{ $users->nama }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NIP <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $users->nip }}">
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
                                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $users->tanggal_lahir }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                                <select class="select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                                    <option value="" disabled selected>--- Pilih jenis kelamin ---</option>
                                                    <option value="Laki-Laki" {{ $users->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                    <option value="Perempuan" {{ $users->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Agama</label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ $users->agama }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="agama">Agama</label>
                                                <span class="text-danger">*</span>
                                                <br>
                                                <select class="theSelect form-control @error('agama') is-invalid @enderror" name="agama">
                                                    <option value="" disabled selected>--- Pilih agama ---</option>
                                                    @foreach($agamaOptions as $id => $namaAgama)
                                                        <option value="{{ $id }}" {{ $id == $users->agama ? 'selected' : '' }}>{{ $namaAgama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Dokumen</label><span class="text-danger">*</span>
                                                <br>
                                                <select class="theSelect @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen">
                                                    <option value="" disabled selected>--- Pilih jenis dokumen ---</option>
                                                    <option value="Passport" {{ $users->jenis_dokumen === 'Passport' ? 'selected' : '' }}>Passport</option>
                                                    <option value="KTP" {{ $users->jenis_dokumen === 'KTP' ? 'selected' : '' }}>KTP</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"></label> 
                                                <label>Nomor Dokumen </label><span class="text-danger">*</span>
                                                <input type="number" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" value="{{ $users->no_dokumen }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"></label>
                                                <label>Kelurahan </label><span class="text-danger">*</span>
                                                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $users->kelurahan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"></label>
                                                <label>Kecamatan </label><span class="text-danger">*</span>
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
                                                <br>
                                                <select class="theSelect @error('jenis_pegawai') is-invalid @enderror" name="jenis_pegawai">
                                                    <option value="" disabled selected>--- Pilih jenis pegawai ---</option>
                                                    @foreach($jenispegawaiOptions as $id => $namaJenisPegawai)
                                                        <option value="{{ $id }}" {{ $id == $users->jenis_pegawai ? 'selected' : '' }}>{{ $namaJenisPegawai }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kedudukan PNS </label> <span class="text-danger">*</span></label>
                                                <br>
                                                <select class="theSelect @error('kedudukan_pns') is-invalid @enderror" name="kedudukan_pns">
                                                    <option value="" disabled selected>--- Pilih kedudukan ---</option>
                                                    @foreach($kedudukanOptions as $id => $namaKedudukan)
                                                        <option value="{{ $id }}" {{ $id == $users->kedudukan_pns ? 'selected' : '' }}>{{ $namaKedudukan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status Pegawai </label> <span class="text-danger">*</span></label>
                                                <br>
                                                    <select class="theSelect @error('status_pegawai') is-invalid @enderror" name="status_pegawai">
                                                        <option value="" disabled selected>--- Pilih status pegawai ---</option>
                                                        <option value="Aktif" {{ $users->status_pegawai === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="Tidak Aktif" {{ $users->status_pegawai === 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
                                                {{-- <select class="select @error('status_pegawai') is-invalid @enderror" name="status_pegawai">
                                                    @foreach($statusOptions as $id => $namaStatus)
                                                        <option value="{{ $id }}" {{ $id == $users->status_pegawai ? 'selected' : '' }}>{{ $namaStatus }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TMT PNS </label> <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('tmt_pns') is-invalid @enderror" name="tmt_pns" value="{{ $users->tmt_pns }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Seri Kartu Pegawai </label> <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('no_seri_karpeg') is-invalid @enderror" name="no_seri_karpeg" value="{{ $users->no_seri_karpeg }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TMT CPNS </label> <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('tmt_cpns') is-invalid @enderror" name="tmt_cpns" value="{{ $users->tmt_cpns }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tingkat Pendidikan </label> <span class="text-danger">*</span></label>
                                                <br>
                                                <select class="theSelect @error('tingkat_pendidikan') is-invalid @enderror" name="tingkat_pendidikan">
                                                    <option selected disabled> --Pilih Tingkat Pendidikan --</option>
                                                    @foreach($tingkatpendidikanOptions as $id => $namaTingkatPendidikan)
                                                        <option value="{{ $id }}" {{ $id == $users->tingkat_pendidikan ? 'selected' : '' }}>{{ $namaTingkatPendidikan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label> <span class="text-danger">*</span></label>
                                                <br>
                                                <select class="theSelect @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir">
                                                    <option selected disabled> --Pilih Pendidikan Terakhir --</option>
                                                    @foreach($pendidikanterakhirOptions as $id => $namaPendidikanTerakhir)
                                                        <option value="{{ $id }}" {{ $id == $users->pendidikan_terakhir ? 'selected' : '' }}>{{ $namaPendidikanTerakhir }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ruangan </label> <span class="text-danger">*</span></label>
                                                <br>
                                                <select class="theSelect  @error('ruangan') is-invalid @enderror" name="ruangan">
                                                    <option value="" disabled selected>--- Pilih ruangan ---</option>
                                                    @foreach($ruanganOptions as $id => $namaRuangan)
                                                        <option value="{{ $id }}" {{ $id == $users->ruangan ? 'selected' : '' }}>{{ $namaRuangan }}</option>
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
                                                    <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}" readonly>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Unit Organisasi <span class="text-danger">*</span></label>
                                                            @if (!empty($users->unit_organisasi))
                                                            <input type="text" class="form-control" name="unit_organisasi" value="{{ $users->unit_organisasi }}">
                                                            @else
                                                            <input type="text" class="form-control" name="unit_organisasi">
                                                            @endif
                                                        </li>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Unit Organisasi Induk <span class="text-danger">*</span></label>
                                                            @if (!empty($users->unit_organisasi_induk))
                                                            <input type="text" class="form-control" name="unit_organisasi_induk" value="{{ $users->unit_organisasi_induk }}">
                                                            @else
                                                            <input type="text" class="form-control" name="unit_organisasi_induk">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Jabatan <span class="text-danger">*</span></label>
                                                            @if (!empty($users->jenis_jabatan))
                                                            <input type="text" class="form-control" name="jenis_jabatan" value="{{ $users->jenis_jabatan }}">
                                                            @else
                                                            <input type="text" class="form-control" name="jenis_jabatan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Eselon</label>
                                                            @if (!empty($users->eselon))
                                                            <input type="text" class="form-control" name="eselon" value="{{ $users->eselon }}">
                                                            @else
                                                            <input type="text" class="form-control" name="eselon">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jabatan</label>
                                                            @if (!empty($users->jabatan))
                                                            <input type="text" class="form-control" name="jabatan" value="{{ $users->jabatan }}">
                                                            @else
                                                            <input type="text" class="form-control" name="jabatan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT</label>
                                                            @if (!empty($users->tmt))
                                                            <input type="text" class="form-control" name="tmt" value="{{ $users->tmt }}">
                                                            @else
                                                            <input type="text" class="form-control" name="tmt">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Lokasi Kerja</label>
                                                            @if (!empty($users->lokasi_kerja))
                                                            <input type="text" class="form-control" name="lokasi_kerja" value="{{ $users->lokasi_kerja }}">
                                                            @else
                                                            <input type="text" class="form-control" name="lokasi_kerja">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan Ruang Awal</label>
                                                            @if (!empty($users->gol_ruang_awal))
                                                            <input type="text" class="form-control" name="gol_ruang_awal" value="{{ $users->gol_ruang_awal }}">
                                                            @else
                                                            <input type="text" class="form-control" name="gol_ruang_awal">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan Ruang Akhir</label>
                                                            @if (!empty($users->gol_ruang_akhir))
                                                            <input type="text" class="form-control" name="gol_ruang_akhir" value="{{ $users->gol_ruang_akhir }}">
                                                            @else
                                                            <input type="text" class="form-control" name="gol_ruang_akhir">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Golongan</label>
                                                            @if (!empty($users->tmt_golongan))
                                                            <input type="text" class="form-control" name="tmt_golongan" value="{{ $users->tmt_golongan }}">
                                                            @else
                                                            <input type="text" class="form-control" name="tmt_golongan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Gaji Pokok</label>
                                                            @if (!empty($users->gaji_pokok))
                                                            <input type="text" class="form-control" name="gaji_pokok" value="{{ $users->gaji_pokok }}">
                                                            @else
                                                            <input type="text" class="form-control" name="gaji_pokok">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja (Tahun)</label>
                                                            @if (!empty($users->masa_kerja_tahun))
                                                            <input type="text" class="form-control" name="masa_kerja_tahun" value="{{ $users->masa_kerja_tahun }}">
                                                            @else
                                                            <input type="text" class="form-control" name="masa_kerja_tahun">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja (Bulan)</label>
                                                            @if (!empty($users->masa_kerja_bulan))
                                                            <input type="text" class="form-control" name="masa_kerja_bulan" value="{{ $users->masa_kerja_bulan }}">
                                                            @else
                                                            <input type="text" class="form-control" name="masa_kerja_bulan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor SPMT</label>
                                                            @if (!empty($users->no_spmt))
                                                            <input type="text" class="form-control" name="no_spmt" value="{{ $users->no_spmt }}">
                                                            @else
                                                            <input type="text" class="form-control" name="no_spmt">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SPMT</label>
                                                            @if (!empty($users->tanggal_spmt))
                                                            <input type="text" class="form-control" name="tanggal_spmt" value="{{ $users->tanggal_spmt }}">
                                                            @else
                                                            <input type="text" class="form-control" name="tanggal_spmt">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>KPPN</label>
                                                            @if (!empty($users->kppn))
                                                            <input type="text" class="form-control" name="kppn" value="{{ $users->kppn }}">
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
                                                    <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}" readonly>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Unit Organisasi <span class="text-danger">*</span></label>
                                                            @if (!empty($users->unit_organisasi))
                                                            <input type="text" class="form-control" name="unit_organisasi" value="{{ $users->unit_organisasi }}">
                                                            @else
                                                            <input type="text" class="form-control" name="unit_organisasi">
                                                            @endif
                                                        </li>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Unit Organisasi Induk <span class="text-danger">*</span></label>
                                                            @if (!empty($users->unit_organisasi_induk))
                                                            <input type="text" class="form-control" name="unit_organisasi_induk" value="{{ $users->unit_organisasi_induk }}">
                                                            @else
                                                            <input type="text" class="form-control" name="unit_organisasi_induk">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Jabatan <span class="text-danger">*</span></label>
                                                            <br>
                                                            <select class="theSelect form-control" name="jenis_jabatan">
                                                                <br>
                                                                <option value="" disabled selected>--- Pilih jenis jabatan ---</option>
                                                                @foreach ($jenisjabatanOptions as $optionValue => $optionLabel)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->jenis_jabatan) selected @endif>
                                                                        {{ $optionLabel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Eselon</label>
                                                            @if (!empty($users->eselon))
                                                            <input type="text" class="form-control" name="eselon" value="{{ $users->eselon }}">
                                                            @else
                                                            <input type="text" class="form-control" name="eselon">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jabatan</label>
                                                            @if (!empty($users->jabatan))
                                                            <input type="text" class="form-control" name="jabatan" value="{{ $users->jabatan }}">
                                                            @else
                                                            <input type="text" class="form-control" name="jabatan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT</label>
                                                            @if (!empty($users->tmt))
                                                            <input type="date" class="form-control" name="tmt" value="{{ $users->tmt }}">
                                                            @else
                                                            <input type="date" class="form-control" name="tmt">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Lokasi Kerja</label>
                                                            @if (!empty($users->lokasi_kerja))
                                                            <input type="text" class="form-control" name="lokasi_kerja" value="{{ $users->lokasi_kerja }}">
                                                            @else
                                                            <input type="text" class="form-control" name="lokasi_kerja">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan Ruang Awal</label>
                                                            <select class="theSelect form-control" name="gol_ruang_awal">
                                                                <br>
                                                                <option value="" disabled selected>--- Pilih golongan ruang awal ---</option>
                                                                @foreach ($golonganOptions as $optionValue => $optionLabel)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->gol_ruang_awal) selected @endif>
                                                                        {{ $optionLabel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan Ruang Akhir</label>
                                                            <select class="theSelect form-control" name="gol_ruang_akhir">
                                                                <br>
                                                                <option value="" disabled selected>--- Pilih golongan ruang akhir ---</option>
                                                                @foreach ($golonganOptions as $optionValue => $optionLabel)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->gol_ruang_akhir) selected @endif>
                                                                        {{ $optionLabel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>TMT Golongan</label>
                                                            @if (!empty($users->tmt_golongan))
                                                            <input type="date" class="form-control" name="tmt_golongan" value="{{ $users->tmt_golongan }}">
                                                            @else
                                                            <input type="date" class="form-control" name="tmt_golongan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Gaji Pokok</label>
                                                            @if (!empty($users->gaji_pokok))
                                                            <input type="number" class="form-control" name="gaji_pokok" value="{{ $users->gaji_pokok }}">
                                                            @else
                                                            <input type="number" class="form-control" name="gaji_pokok">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja (Tahun)</label>
                                                            @if (!empty($users->masa_kerja_tahun))
                                                            <input type="number" class="form-control" name="masa_kerja_tahun" value="{{ $users->masa_kerja_tahun }}">
                                                            @else
                                                            <input type="number" class="form-control" name="masa_kerja_tahun">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Masa Kerja (Bulan)</label>
                                                            @if (!empty($users->masa_kerja_bulan))
                                                            <input type="number" class="form-control" name="masa_kerja_bulan" value="{{ $users->masa_kerja_bulan }}">
                                                            @else
                                                            <input type="number" class="form-control" name="masa_kerja_bulan">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor SPMT</label>
                                                            @if (!empty($users->no_spmt))
                                                            <input type="number" class="form-control" name="no_spmt" value="{{ $users->no_spmt }}">
                                                            @else
                                                            <input type="number" class="form-control" name="no_spmt">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SPMT</label>
                                                            @if (!empty($users->tanggal_spmt))
                                                            <input type="date" class="form-control" name="tanggal_spmt" value="{{ $users->tanggal_spmt }}">
                                                            @else
                                                            <input type="date" class="form-control" name="tanggal_spmt">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>KPPN</label>
                                                            @if (!empty($users->kppn))
                                                            <input type="text" class="form-control" name="kppn" value="{{ $users->kppn }}">
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
        <script src="{{ asset('assets/js/pendidikan.js') }}"></script>
        <script src="{{ asset('assets/js/golongan.js') }}"></script>
        <script src="{{ asset('assets/js/jabatan.js') }}"></script>
        <script src="{{ asset('assets/js/diklat.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
		$(".theSelect").select2();
	    </script>
    @endsection
@endsection