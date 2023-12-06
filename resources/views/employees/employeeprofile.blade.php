@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
                                {{-- <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                            <img alt="" src="{{ URL::to('/assets/images/' . $users->avatar) }}" alt="{{ $users->name }}">
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="{{ URL::to('/assets/images/' . $users->avatar) }}" data-fancybox="foto-profil">
                                            <img alt="{{ $users->name }}" src="{{ URL::to('/assets/images/' . $users->avatar) }}">
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
                {{-- <div class="card tab-box">
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
                </div> --}}

                <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a href="#profil_pegawai" data-toggle="tab" class="nav-link active">Profil</a></li>
                            <li class="nav-item"><a href="#riwayat_golongan" data-toggle="tab" class="nav-link">Golongan</a></li>
                            <li class="nav-item"><a href="#kenaikan_gaji" data-toggle="tab" class="nav-link">KGB</a></li>
                            <li class="nav-item"><a href="#riwayat_pmk" data-toggle="tab" class="nav-link">PMK</a></li>
                            <li class="nav-item"><a href="#riwayat_pendidikan" data-toggle="tab" class="nav-link">Pendidikan</a></li>
                            <li class="nav-item"><a href="#riwayat_jabatan" data-toggle="tab" class="nav-link">Jabatan</a></li>
                            <li class="nav-item"><a href="#riwayat_angka_kredit" data-toggle="tab" class="nav-link">Angka Kredit</a></li>
                            <li class="nav-item"><a href="#riwayat_diklat" data-toggle="tab" class="nav-link">Diklat</a></li>
                            <li class="nav-item"><a href="#riwayat_orang_tua" data-toggle="tab" class="nav-link">Orang Tua</a></li>
                            <li class="nav-item"><a href="#riwayat_pasangan" data-toggle="tab" class="nav-link">Pasangan</a></li>
                            <li class="nav-item"><a href="#riwayat_anak" data-toggle="tab" class="nav-link">Anak</a></li>
                            <li class="nav-item"><a href="#riwayat_penghargaan" data-toggle="tab" class="nav-link">Penghargaan</a></li>
                            <li class="nav-item"><a href="#riwayat_organisasi" data-toggle="tab" class="nav-link">Organisasi</a></li>
                            <li class="nav-item"><a href="#riwayat_hukum_disiplin" data-toggle="tab" class="nav-link">Hukuman Disiplin</a></li>
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
                                                    <div class="text">{{ date('d F Y', strtotime($users->tanggal_lahir)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->tanggal_lahir }}</div>
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
                                                <div class="title">Nomor Induk Kependudukan</div>
                                                @if (!empty($users->no_dokumen))
                                                    <div class="text">{{ $users->no_dokumen }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Provinsi</div>
                                                @if (!empty($users->provinsi))
                                                    <div class="text">{{ ucwords(strtolower($users->provinsi)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Kota/Kabupaten</div>
                                                @if (!empty($users->kota))
                                                    <div class="text">{{ ucwords(strtolower($users->kota)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Kecamatan</div>
                                                @if (!empty($users->kecamatan))
                                                    <div class="text">{{ ucwords(strtolower($users->kecamatan)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Desa/Kelurahan</div>
                                                @if (!empty($users->kelurahan))
                                                    <div class="text">{{ ucwords(strtolower($users->kelurahan)) }}</div>
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
                                                    <div class="text">{{ date('d F Y', strtotime($users->tmt_pns)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->tmt_pns }}</div>
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
                                                    <div class="text">{{ date('d F Y', strtotime($users->tmt_cpns)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->tmt_cpns }}</div>
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
                                                    <div class="text">{{ ucwords(strtolower($users->pendidikan_terakhir)) }}</div>
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
                                            <li>
                                                <div class="title">Dokumen KTP</div>
                                                <a href="{{ asset('assets/DokumenKTP/' . $users->dokumen_ktp) }}" target="_blank">
                                                    @if (pathinfo($users->dokumen_ktp, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                    @else
                                                        <div class="text">N/A</div>
                                                    @endif
                                                        <div hidden class="text">{{ $users->dokumen_ktp }}</div>
                                                </a>
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
                                                <div class="title">TMT</div>
                                                @if (!empty($users->tmt))
                                                    <div class="text">{{ date('d F Y', strtotime($users->tmt)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->tmt }}</div>
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
                                                <div class="title">TMT Golongan</div>
                                                @if (!empty($users->tmt_golongan))
                                                    <div class="text">{{ date('d F Y', strtotime($users->tmt_golongan)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->tmt_golongan }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Gaji Pokok </div>
                                                @if (!empty($users->gaji_pokok))
                                                <div class="text">Rp. {{ number_format($users->gaji_pokok, 0, ',', '.') }}</div>
                                                @else
                                                <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->gaji_pokok }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Masa Kerja (Tahun)</div>
                                                @if (!empty($users->masa_kerja_tahun))
                                                    <div class="text">{{ $users->masa_kerja_tahun }} Tahun</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->masa_kerja_tahun }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Masa Kerja (Bulan)</div>
                                                @if (!empty($users->masa_kerja_bulan))
                                                    <div class="text">{{ $users->masa_kerja_bulan }} Bulan</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->masa_kerja_bulan }}</div>
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
                                                <div class="title">Tanggal SPMT</div>
                                                @if (!empty($users->tanggal_spmt))
                                                    <div class="text">{{ date('d F Y', strtotime($users->tanggal_spmt)) }}</div>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                <div hidden class="text">{{ $users->tanggal_spmt }}</div>
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
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_pendidikan">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Pendidikan
                                </a>
                            </div>
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
                                                            <option value="" disabled selected>-- Pilih Tingkat Pendidikan --</option>
                                                            @foreach($tingkatpendidikanOptions as $id => $namaTingkatPendidikan)
                                                                <option value="{{ $id }}" {{ $id == $users->tingkat_pendidikan ? 'selected' : '' }}>{{ $namaTingkatPendidikan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pendidikan</label>
                                                        <br>
                                                        <select class="theSelect" name="pendidikan" required>
                                                                <option selected disabled>-- Pilih Pendidikan --</option>
                                                            @foreach($pendidikanterakhirOptions as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
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
                                                    <option value="" disabled selected>-- Pilih Tingkat Pendidikan --</option>
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
                                                            <br>
                                                            <select class="theSelect" name="golongan" required>
                                                                    <option selected disabled>-- Pilih Golongan --</option>
                                                                @foreach ($golonganOptions as $key => $value)
                                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            </select>
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
                                                                <option value="" disabled selected>-- Pilih Jenis Jabatan --</option>
                                                                @foreach ($jenisjabatanOptions as $optionValue => $jenisJabatan)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->jenis_jabatan) selected @endif>
                                                                        {{ $jenisJabatan }}
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
                                                                <option selected disabled>-- Pilih Jenis Jabatan --</option>
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
                                                            <option selected disabled>-- Pilih Jenis Diklat --</option>
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
                                                            <option selected disabled>-- Pilih Jenis Diklat --</option>
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

                    <!-- Kenaikan Gaji Berkala Tab -->
                    <div class="tab-pane fade" id="kenaikan_gaji">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_kenaikan_gaji">
                                    <i class="fa fa-plus"></i> Tambah Kenaikan Gaji Berkala
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th class="name">Nama Pegawai</th>
                                            <th class="nip">NIP</th>
                                            <th class="golongan_awal">Golongan Awal</th>
                                            <th class="golongan_akhir">Golongan Akhir</th>
                                            <th class="gapok_lama">Gaji Pokok Lama</th>
                                            <th class="gapok_baru">Gaji Pokok Akhir</th>
                                            <th class="tgl_sk_kgb">Tanggal SK Kenaikan Gaji Berkala</th>
                                            <th class="no_sk_kgb">Nomor SK Kenaikan Gaji Berkala</th>
                                            <th class="tgl_berlaku">Tanggal Berlaku</th>
                                            <th class="masa_kerja_golongan">Masa Kerja Golongan</th>
                                            <th class="masa_kerja">Masa Kerja</th>
                                            <th class="tmt_kgb">Terhitung Mulai Tanggal Kenaikan Gaji Berkala</th>
                                            <th class="dokumen_kgb">Dokumen KGB</th>
                                            <th class="text-right no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kenaikanGaji as $sqlkgb => $result_kgb)
                                            <tr>
                                                <td>{{ ++$sqlkgb }}</td>
                                                <td hidden class="id">{{ $result_kgb->id }}</td>
                                                <td class="name">{{ $result_kgb->name }}</td>
                                                <td class="nip">{{ $result_kgb->nip }}</td>
                                                <td class="golongan_awal">{{ $result_kgb->golongan_awal }}</td>
                                                <td class="golongan_akhir">{{ $result_kgb->golongan_akhir }}</td>
                                                <td class="gapok_lama">{{ $result_kgb->gapok_lama }}</td>
                                                <td class="gapok_baru">{{ $result_kgb->gapok_baru }}</td>
                                                <td class="tgl_sk_kgb">{{ $result_kgb->tgl_sk_kgb }}</td>
                                                <td class="no_sk_kgb">{{ $result_kgb->no_sk_kgb }}</td>
                                                <td class="tgl_berlaku">{{ $result_kgb->tgl_berlaku }}</td>
                                                <td class="masa_kerja_golongan">{{ $result_kgb->masa_kerja_golongan }}</td>
                                                <td class="masa_kerja">{{ $result_kgb->masa_kerja }}</td>
                                                <td class="tmt_kgb">{{ $result_kgb->tmt_kgb }}</td>
                                                <td class="dokumen_kgb"><center>
                                                        <a href="{{ asset('assets/DokumenKGB/' . $result_kgb->dokumen_kgb) }}" target="_blank">
                                                            @if (pathinfo($result_kgb->dokumen_kgb, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_kgb">{{ $result_kgb->dokumen_kgb }}</td>
                                                        </a></center></td>

                                                {{-- Edit Layanan KGB --}}
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_layanan_kgb" href="#"
                                                                data-toggle="modal" data-target="#edit_layanan_kgb"><i
                                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item delete_kgb" href="#"
                                                                data-toggle="modal" data-target="#delete_kgb"><i
                                                                    class="fa fa-trash-o m-r-5"></i>Delete</a>
                                                            {{-- <a href="{{ route('layanan-kenaikan-gaji-berkala-admin', ['id' => $result_kgb->id]) }}"
                                                                target="_blank" class="dropdown-item cetak-kinerja">
                                                                <i class="fa fa-print m-r-5"></i>Cetak
                                                            </a> --}}
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
                        <!-- Tambah Kenaikan Gaji Modal -->
                        <div id="add_kenaikan_gaji" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Kenaikan Gaji Berkala</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('layanan/kgb/tambah-data') }}" method="POST"
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
                                                        @foreach ($kenaikanGaji as $gaji)
                                                            <input type="hidden" class="form-control" name="nip"
                                                                value="{{ $gaji->nip }}">
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        @foreach ($kenaikanGaji as $gaji)
                                                            <input type="hidden" class="form-control" name="name"
                                                                value="{{ $gaji->name }}">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Golongan Awal</label><br>
                                                        <select name="golongan_awal" class="theSelect" id="golongan_awal" required>
                                                            <option selected disabled> --Pilih Golongan Awal--</option>
                                                            @foreach ($golonganOptions as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Golongan Akhir</label><br>
                                                        <select name="golongan_akhir" class="theSelect" id="golongan_akhir" required>
                                                            <option selected disabled> --Pilih Golongan Akhir--</option>
                                                            @foreach ($golonganOptions as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gaji Pokok Lama</label>
                                                        <input type="number" class="form-control" name="gapok_lama"
                                                            placeholder="Gapok Lama">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gaji Pokok Baru</label>
                                                        <input type="number" class="form-control" name="gapok_baru"
                                                            placeholder="Gapok Baru">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK KGB</label>
                                                        <input type="date" class="form-control" name="tgl_sk_kgb">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK KGB</label>
                                                        <input type="text" class="form-control" name="no_sk_kgb">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Berlaku</label>
                                                        <input type="date" class="form-control" name="tgl_berlaku">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Kerja Golongan</label>
                                                        <input type="text" class="form-control" name="masa_kerja_golongan"
                                                            placeholder="Masa Kerja Golongan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Kerja</label>
                                                        <input type="text" class="form-control" name="masa_kerja"
                                                            placeholder="Masa Kerja">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>TMT KGB</label>
                                                        <input type="date" class="form-control" name="tmt_kgb">
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
                        <!-- /Tambah Kenaikan Gaji Modal -->
                        <!-- Edit Kenaikan Gaji Modal -->
                        <div id="edit_layanan_kgb" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Kenaikan Gaji Berkala</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('layanan/kgb/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Golongan Awal</label><br>
                                                        <select name="golongan_awal" class="theSelect" id="e_golongan_awal">
                                                            <option selected disabled> --Pilih Golongan Awal--</option>
                                                            @foreach ($golonganOptions as $key => $value)
                                                                <option value="{{ $key }}"{{ $key == $kenaikanGajis->golongan_awal ? 'selected' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Golongan Akhir</label><br>
                                                        <select name="golongan_akhir" class="theSelect" id="e_golongan_akhir">
                                                            <option selected disabled> --Pilih Golongan Akhir--</option>
                                                            @foreach ($golonganOptions as $key => $value)
                                                                <option value="{{ $key }}"{{ $key == $kenaikanGajis->golongan_akhir ? 'selected' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gaji Pokok Lama</label>
                                                        <input type="number" class="form-control" name="gapok_lama" id="e_gapok_lama"
                                                            placeholder="Gaji Pokok Lama" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gaji Pokok Baru</label>
                                                        <input type="number" class="form-control" name="gapok_baru" id="e_gapok_baru"
                                                            placeholder="Gaji Pokok Baru" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK KGB</label>
                                                        <input type="date" class="form-control" name="tgl_sk_kgb" id="e_tgl_sk_kgb"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK KGB</label>
                                                        <input type="text" class="form-control" name="no_sk_kgb" id="e_no_sk_kgb"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Berlaku</label>
                                                        <input type="date" class="form-control" name="tgl_berlaku" id="e_tgl_berlaku"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Kerja Golongan</label>
                                                        <input type="text" class="form-control" name="masa_kerja_golongan"
                                                            id="e_masa_kerja_golongan" placeholder="Masa Kerja Golongan" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Kerja</label>
                                                        <input type="text" class="form-control" name="masa_kerja" id="e_masa_kerja"
                                                            placeholder="Masa Kerja" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>TMT KGB</label>
                                                        <input type="date" class="form-control" name="tmt_kgb" id="e_tmt_kgb"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen KGB</label>
                                                        <input type="file" class="form-control" id="dokumen_kgb"
                                                            name="dokumen_kgb">
                                                        <input type="hidden" name="hidden_dokumen_kgb"
                                                            id="e_dokumen_kgb" value="">
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
                        <!-- /Edit Kenaikan Gaji Modal -->

                        <!-- Delete Kenaikan Gaji Berkala Modal -->
                        <div class="modal custom-modal fade" id="delete_kgb" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Kenaikan Gaji Berkala</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('layanan/kenaikan-gaji-berkala/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id" value="">
                                                <input type="hidden" name="dokumen_kgb" class="d_dokumen_kgb" value="">
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
                        <!-- /Delete Kenaikan Gaji Berkala Modal -->
                    </div>
                    <!-- /Riwayat Kenaikan Gaji Berkala Tab -->

                    <!-- Riwayat PMK Tab -->
                    <div class="tab-pane fade" id="riwayat_pmk">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_pmk">
                                    <i class="fa fa-plus"></i> Tambah Riwayat PMK
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th class="jenis_pmk">Jenis Peninjauan Masa Kerja</th>
                                            <th class="instansi">Instansi</th>
                                            <th class="tanggal_awal">Tanggal Awal</th>
                                            <th class="tanggal_akhir">Tanggal Akhir</th>
                                            <th class="no_sk">Nomor SK</th>
                                            <th class="tanggal_sk">Tanggal SK</th>
                                            <th class="no_bkn">Nomor BKN</th>
                                            <th class="tanggal_bkn">Tanggal BKN</th>
                                            <th class="masa_tahun">Masa Kerja (Tahun)</th>
                                            <th class="masa_bulan">Masa Kerja (Bulan)</th>
                                            <th class="dokumen_pmk">Dokumen PMK</th>
                                            <th class="aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatPMK as $sqlPMK => $result_pmk)
                                            <tr>
                                                <td>{{ ++$sqlPMK }}</td>
                                                <td hidden class="id">{{ $result_pmk->id }}</td>
                                                <td class="jenis_pmk">{{ $result_pmk->jenis_pmk }}</td>
                                                <td class="instansi">{{ $result_pmk->instansi }}</td>
                                                <td class="tanggal_awal">{{ $result_pmk->tanggal_awal }}</td>
                                                <td class="tanggal_akhir">{{ $result_pmk->tanggal_akhir }}</td>
                                                <td class="no_sk">{{ $result_pmk->no_sk }}</td>
                                                <td class="tanggal_sk">{{ $result_pmk->tanggal_sk }}</td>
                                                <td class="no_bkn">{{ $result_pmk->no_bkn }}</td>
                                                <td class="tanggal_bkn">{{ $result_pmk->tanggal_bkn }}</td>
                                                <td class="masa_tahun">{{ $result_pmk->masa_tahun }}</td>
                                                <td class="masa_bulan">{{ $result_pmk->masa_bulan }}</td>
                                                <td class="dokumen_pmk"><center>
                                                        <a href="{{ asset('assets/DokumenPMK/' . $result_pmk->dokumen_pmk) }}" target="_blank">
                                                            @if (pathinfo($result_pmk->dokumen_pmk, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_pmk">{{ $result_pmk->dokumen_pmk }}</td>
                                                        </a></center></td>

                                                {{-- Edit Riwayat PMK --}}
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_riwayat_pmk" href="#"
                                                                data-toggle="modal" data-target="#edit_riwayat_pmk"><i
                                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            {{-- <a href="{{ route('layanan-kenaikan-gaji-berkala-admin', ['id' => $result_kgb->id]) }}"
                                                                target="_blank" class="dropdown-item cetak-kinerja">
                                                                <i class="fa fa-print m-r-5"></i>Cetak
                                                            </a> --}}
                                                            <a class="dropdown-item delete_riwayat_pmk" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_pmk"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>
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
                        <!-- Tambah Riwayat PMK Modal -->
                        <div id="add_riwayat_pmk" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Riwayat PMK</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/pmk/tambah-data') }}" method="POST"
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
                                                    <label>Jenis PMK</label>
                                                    <input class="form-control" type="text" name="jenis_pmk" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Instansi</label>
                                                    <input class="form-control" type="text" name="instansi" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Awal</label>
                                                    <input class="form-control" type="date" name="tanggal_awal" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Akhir</label>
                                                    <input class="form-control" type="date" name="tanggal_akhir" required>
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
                                                    <label>Nomor BKN</label>
                                                    <input class="form-control" type="text" name="no_bkn" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal BKN</label>
                                                    <input class="form-control" type="date" name="tanggal_bkn" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Masa Kerja (Tahun)</label>
                                                    <input class="form-control" type="number" name="masa_tahun" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Masa Kerja (Bulan)</label>
                                                    <input class="form-control" type="number" name="masa_bulan" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen PMK</label>
                                                    <input class="form-control" type="file" name="dokumen_pmk" required>
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
                        <!-- /Tambah PMK Modal -->
                        <!-- Edit PMK Modal -->
                        <div id="edit_riwayat_pmk" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Peninjauan Masa Kerja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/pmk/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_pmk" value="">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis PMK</label>
                                                    <input type="text" class="form-control" name="jenis_pmk" id="e_jenis_pmk"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Instansi</label>
                                                    <input type="text" class="form-control" name="instansi" id="e_instansi"
                                                        value="">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Awal</label>
                                                        <input type="date" class="form-control" name="tanggal_awal"
                                                            id="e_tanggal_awal" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Akhir</label>
                                                        <input type="date" class="form-control" name="tanggal_akhir"
                                                            id="e_tanggal_akhir" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK</label>
                                                        <input type="text" class="form-control" name="no_sk" id="e_no_sk_pmk"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK</label>
                                                        <input type="date" class="form-control" name="tanggal_sk" id="e_tanggal_sk_pmk"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor BKN</label>
                                                        <input type="text" class="form-control" name="no_bkn" id="e_no_bkn"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal BKN</label>
                                                        <input type="date" class="form-control" name="tanggal_bkn" id="e_tanggal_bkn"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Kerja (Tahun)</label>
                                                        <input type="number" class="form-control" name="masa_tahun" id="e_masa_tahun"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Kerja (Bulan)</label>
                                                        <input type="number" class="form-control" name="masa_bulan" id="e_masa_bulan"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen PMK</label>
                                                        <input type="file" class="form-control" name="dokumen_pmk"
                                                            id="dokumen_pmk">
                                                        <input type="hidden" name="hidden_dokumen_pmk" id="e_dokumen_pmk"
                                                            value="">
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
                        <!-- /Edit Riwayat PMK Modal -->
                        <!-- Delete Riwayat PMK Modal -->
                        <div class="modal custom-modal fade" id="delete_riwayat_pmk" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Riwayat PMK</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('riwayat/pmk/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id" value="">
                                                <input type="hidden" name="dokumen_pmk" class="d_dokumen_pmk" value="">
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
                    <!-- End Delete Riwayat PMK Modal -->
                    </div>

                    <!-- Riwayat Angka Kredit Tab -->
                    <div class="tab-pane fade" id="riwayat_angka_kredit">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_angka_kredit">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Angka Kredit
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th>Jenis Jabatan</th>
                                            <th>Nomor SK</th>
                                            <th>Tanggal SK</th>
                                            <th>Angka Kredit Pertama</th>
                                            <th>Integrasi</th>
                                            <th>Konversi</th>
                                            <th>Bulan Mulai</th>
                                            <th>Tahun Mulai</th>
                                            <th>Bulan Selesai</th>
                                            <th>Tahun Selesai</th>
                                            <th>Angka Kredit Utama</th>
                                            <th>Angka Kredit Penunjang</th>
                                            <th>Total Angka Kredit</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatAngkaKredit as $sqlAK => $result_angka_kredit)
                                            <tr>
                                                <td><center>{{ ++$sqlAK }}</center></td>
                                                <td hidden class="id"><center>{{ $result_angka_kredit->id }}</center></td>
                                                <td class="nama_jabatan"><center>{{ $result_angka_kredit->nama_jabatan }}</center></td>
                                                <td class="nomor_sk"><center>{{ $result_angka_kredit->nomor_sk }}</center></td>
                                                <td class="tanggal_sk"><center>{{ $result_angka_kredit->tanggal_sk }}</center></td>
                                                <td class="angka_kredit_pertama"><center>{{ $result_angka_kredit->angka_kredit_pertama }}</center></td>
                                                <td class="integrasi"><center>{{ $result_angka_kredit->integrasi }}</center></td>
                                                <td class="konversi"><center>{{ $result_angka_kredit->konversi }}</center></td>
                                                <td class="bulan_mulai"><center>{{ $result_angka_kredit->bulan_mulai }}</center></td>
                                                <td class="tahun_mulai"><center>{{ $result_angka_kredit->tahun_mulai }}</center></td>
                                                <td class="bulan_selesai"><center>{{ $result_angka_kredit->bulan_selesai }}</center></td>
                                                <td class="tahun_selesai"><center>{{ $result_angka_kredit->tahun_selesai }}</center></td>
                                                <td class="angka_kredit_utama"><center>{{ $result_angka_kredit->angka_kredit_utama }}</center></td>
                                                <td class="angka_kredit_penunjang"><center>{{ $result_angka_kredit->angka_kredit_penunjang }}</center></td>
                                                <td class="total_angka_kredit"><center>{{ $result_angka_kredit->total_angka_kredit }}</center></td>

                                                {{-- Edit dan Hapus data  --}}
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_riwayat_angka_kredit" href="#"
                                                                data-toggle="modal" data-target="#edit_riwayat_angka_kredit"><i
                                                                    class="fa fa-pencil m-r-5"></i>
                                                                Edit</a>
                                                            <a class="dropdown-item delete_riwayat_angka_kredit" href="#"
                                                                data-toggle="modal" data-target="#delete_riwayat_angka_kredit"><i
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
                        <!-- Tambah Riwayat Angka Kredit Modal -->
                        <div id="add_riwayat_angka_kredit" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Riwayat Angka Kredit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/angkakredit/tambah-data') }}" method="POST"
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
                                                        <label>Nama Jabatan</label><small class="text-danger">*</small>
                                                        <br>
                                                        <select class="theSelect form-control" name="nama_jabatan" required>
                                                            <option selected disabled> --Pilih Nama Jabatan --</option>
                                                            @foreach ($jenisjabatanOptions as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="nomor_sk" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_sk" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group" style="margin-left: 15px;">
                                                    <label>Angka Kredit Pertama</label><br>
                                                    <input type="checkbox" class="exclusive" name="angka_kredit_pertama"
                                                        value="Angka Kredit Pertama">
                                                    Angka Kredit Pertama
                                                </div>
                                                <div class="form-group" style="margin-left: 20px;">
                                                    <label>Integrasi</label><br>
                                                    <input type="checkbox" class="exclusive" name="integrasi" value="Integrasi">
                                                    Integrasi
                                                </div>
                                                <div class="form-group" style="margin-left: 20px;">
                                                    <label>Konversi</label><br>
                                                    <input type="checkbox" class="exclusive" name="konversi" value="Konversi"> Konversi
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bulan Mulai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="bulan_mulai" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Mulai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" name="tahun_mulai" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bulan Selesai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="bulan_selesai" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Selesai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" name="tahun_selesai" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Angka Kredit Utama</label>
                                                        <input class="form-control" type="number" step="any"
                                                            name="angka_kredit_utama" pattern="^\d+(\.\d{1,2})?$">
                                                        <small class="text-danger">Koma ditulis dengan titik. Contoh: 102.5</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Angka Kredit Penunjang</label>
                                                        <input class="form-control" type="number" step="any"
                                                            name="angka_kredit_penunjang" pattern="^\d+(\.\d{1,2})?$">
                                                        <small class="text-danger">Koma ditulis dengan titik. Contoh: 102.5</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Total Angka Kredit</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" step="any"
                                                            name="total_angka_kredit" pattern="^\d+(\.\d{1,2})?$" required>
                                                        <small class="text-danger">Koma ditulis dengan titik. Contoh: 102.5</small>
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
                        <!-- /Tambah Angka Kredit Modal -->
                        <!-- Edit Angka Kredit Modal -->
                        <div id="edit_riwayat_angka_kredit" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Angka Kredit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/angkakredit/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_ak" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Jabatan</label><small class="text-danger">*</small>
                                                        <br>
                                                        <select class="theSelect form-control" name="nama_jabatan" id="e_nama_jabatan"
                                                            required>
                                                            <option selected disabled> --Pilih Nama Jabatan --</option>
                                                            @foreach ($jenisjabatanOptions as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK</label>
                                                        <input type="text" class="form-control" name="nomor_sk" id="e_nomor_sk"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK</label>
                                                        <input type="date" class="form-control" name="tanggal_sk"
                                                            id="e_tanggal_sk_ak" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group" style="margin-left: 15px;">
                                                    <label>Angka Kredit Pertama</label><br>
                                                    <input type="checkbox" class="exclusive" name="angka_kredit_pertama" id="e_angka_kredit_pertama"
                                                        value="Angka Kredit Pertama">
                                                    Angka Kredit Pertama
                                                </div>
                                                <div class="form-group" style="margin-left: 20px;">
                                                    <label>Integrasi</label><br>
                                                    <input type="checkbox" class="exclusive" name="integrasi" id="e_integrasi" value="Integrasi">
                                                    Integrasi
                                                </div>
                                                <div class="form-group" style="margin-left: 20px;">
                                                    <label>Konversi</label><br>
                                                    <input type="checkbox" class="exclusive" name="konversi" id="e_konversi" value="Konversi"> Konversi
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bulan Mulai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="bulan_mulai" id="e_bulan_mulai" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Mulai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" name="tahun_mulai" id="e_tahun_mulai" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bulan Selesai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="bulan_selesai" id="e_bulan_selesai" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Selesai Penilaian</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" name="tahun_selesai" id="e_tahun_selesai" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Angka Kredit Utama</label>
                                                        <input class="form-control" type="number" step="any"
                                                            name="angka_kredit_utama" id="e_angka_kredit_utama" pattern="^\d+(\.\d{1,2})?$">
                                                        <small class="text-danger">Koma ditulis dengan titik. Contoh: 102.5</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Angka Kredit Penunjang</label>
                                                        <input class="form-control" type="number" step="any"
                                                            name="angka_kredit_penunjang" id="e_angka_kredit_penunjang" pattern="^\d+(\.\d{1,2})?$">
                                                        <small class="text-danger">Koma ditulis dengan titik. Contoh: 102.5</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Total Angka Kredit</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" step="any"
                                                            name="total_angka_kredit" id="e_total_angka_kredit" pattern="^\d+(\.\d{1,2})?$" required>
                                                        <small class="text-danger">Koma ditulis dengan titik. Contoh: 102.5</small>
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
                        <!-- /Edit Riwayat Angka Kredit Modal -->
                        <!-- Delete Riwayat Angka Kredit Modal -->
                        <div class="modal custom-modal fade" id="delete_riwayat_angka_kredit" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Riwayat Angka Kredit</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('riwayat/angkakredit/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id_ak" value="">
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
                    <!-- End Delete Riwayat Angka Kredit Modal -->
                    </div>

                    <!-- Riwayat Orang Tua Tab -->
                    <div class="tab-pane fade" id="riwayat_orang_tua">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_orang_tua">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Orang Tua
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th>Status Hidup</th>
                                            <th>Status Pekerjaan Orang Tua</th>
                                            <th>Nama Orang Tua</th>
                                            <th>NIP</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Meninggal</th>
                                            <th>Jenis Identitas</th>
                                            <th>Nomor HP</th>
                                            <th>Nomor Telepon</th>
                                            <th>Agama</th>
                                            <th>Status Pernikahan</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Dokumen Kartu Keluarga</th>
                                            <th>Dokumen Akta Anak</th>
                                            <th>Pas Foto Ayah</th>
                                            <th>Pas Foto Ibu</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatOrangTua as $sqlOrtu => $result_Ortu)
                                            <tr>
                                                <td><center>{{ ++$sqlOrtu }}</center></td>
                                                <td hidden class="id"><center>{{ $result_Ortu->id }}</center></td>
                                                <td class="status_hidup"><center>{{ $result_Ortu->status_hidup }}</center></td>
                                                <td class="status_pekerjaan_ortu"><center>{{ $result_Ortu->status_pekerjaan_ortu }}</center></td>
                                                <td class="nama"><center>{{ $result_Ortu->nama }}</center></td>
                                                <td class="nip"><center>{{ $result_Ortu->nip }}</center></td>
                                                <td class="tanggal_lahir"><center>{{ $result_Ortu->tanggal_lahir }}</center></td>
                                                <td class="jenis_kelamin"><center>{{ $result_Ortu->jenis_kelamin }}</center></td>
                                                <td class="tanggal_meninggal"><center>{{ $result_Ortu->tanggal_meninggal }}</center></td>
                                                <td class="jenis_identitas"><center>{{ $result_Ortu->jenis_identitas }}</center></td>
                                                <td class="no_hp"><center>{{ $result_Ortu->no_hp }}</center></td>
                                                <td class="no_telepon"><center>{{ $result_Ortu->no_telepon }}</center></td>
                                                <td class="agama"><center>{{ $result_Ortu->agama }}</center></td>
                                                <td class="status_pernikahan"><center>{{ $result_Ortu->status_pernikahan }}</center></td>
                                                <td class="email"><center>{{ $result_Ortu->email }}</center></td>
                                                <td ><center>{{ $result_Ortu->alamat }}</center></td>
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

                                                {{-- Edit dan Hapus data  --}}
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_riwayat_orang_tua" href="#"
                                                                data-toggle="modal" data-target="#edit_riwayat_orang_tua"><i
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
                        <!-- Tambah Riwayat Orang Tua Modal -->
                        <div id="add_riwayat_orang_tua" class="modal custom-modal fade" role="dialog">
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
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
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
                        <!-- /Tambah Orang Tua Modal -->
                        <!-- Edit Orang Tua Modal -->
                        <div id="edit_riwayat_orang_tua" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Orang Tua</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/orangtua/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_ortu" value="">
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
                                                <button class="btn btn-primary submit-btn">Save</button>
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
                                                <input type="hidden" name="id" class="e_id_ortu" value="">
                                                <input type="hidden" name="dokumen_kk" class="d_dokumen_kk" value="">
                                                <input type="hidden" name="dokumen_akta_lahir_anak" class="d_dokumen_akta_lahir_anak" value="">
                                                <input type="hidden" name="pas_foto_ayah" class="d_pas_foto_ayah" value="">
                                                <input type="hidden" name="pas_foto_ibu" class="d_pas_foto_ibu" value="">
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
                    <!-- End Delete Riwayat Orang Tua Modal -->
                    </div>

                    <!-- Riwayat Pasangan Tab -->
                    <div class="tab-pane fade" id="riwayat_pasangan">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_pasangan">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Pasangan
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th>Suami/Istri ke</th>
                                            <th>Status Pekerjaan</th>
                                            <th>NIP</th>
                                            <th>Nama Pasangan</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jenis Identitas</th>
                                            <th>Nomor HP</th>
                                            <th>Nomor Telepon</th>
                                            <th>Agama</th>
                                            <th>Status Pernikahan</th>
                                            <th>Status Hidup</th>
                                            <th>Email</th>
                                            <th>Nomor Karis/Karsu</th>
                                            <th>Alamat</th>
                                            <th>Dokumen Nikah</th>
                                            <th>Pas Foto</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatPasangan as $sqlPasangan => $result_pasangan)
                                                <tr>
                                                    <td><center>{{ ++$sqlPasangan }}</center></td>
                                                    <td class="suami_istri_ke">{{ $result_pasangan->suami_istri_ke }}</td>
                                                    <td class="status_pekerjaan_pasangan">{{ $result_pasangan->status_pekerjaan_pasangan }}</td>
                                                    <td class="nip">{{ $result_pasangan->nip }}</td>
                                                    <td class="nama">{{ $result_pasangan->nama }}</td>
                                                    <td class="tanggal_lahir">{{ $result_pasangan->tanggal_lahir }}</td>
                                                    <td class="jenis_kelamin">{{ $result_pasangan->jenis_kelamin }}</td>
                                                    <td class="jenis_identitas">{{ $result_pasangan->jenis_identitas }}</td>
                                                    <td class="no_hp">{{ $result_pasangan->no_hp }}</td>
                                                    <td class="no_telepon">{{ $result_pasangan->no_telepon }}</td>
                                                    <td class="agama">{{ $result_pasangan->agama }}</td>
                                                    <td class="status_pernikahan">{{ $result_pasangan->status_pernikahan }}</td>
                                                    <td class="status_hidup">{{ $result_pasangan->status_hidup }}</td>
                                                    <td class="email">{{ $result_pasangan->email }}</td>
                                                    <td class="no_karis_karsu">{{ $result_pasangan->no_karis_karsu }}</td>
                                                    <td>{{ $result_pasangan->alamat }}</td>
                                                    <td class="dokumen_nikah">
                                                        <center>
                                                            <a href="{{ asset('assets/DokumenNikah/' . $result_pasangan->dokumen_nikah) }}" target="_blank">
                                                                @if (pathinfo($result_pasangan->dokumen_nikah, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                            </a>
                                                        </center>
                                                    </td>
                                                    <td class="pas_foto">
                                                        <center>
                                                            <a href="{{ asset('assets/DokumenPasFotoPasangan/' . $result_pasangan->pas_foto) }}" target="_blank">
                                                                @if (in_array(pathinfo($result_pasangan->pas_foto, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                            </a>
                                                        </center>
                                                    </td>

                                                    {{-- Edit dan Hapus data  --}}
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit_riwayat_pasangan" href="#" data-toggle="modal" data-target="#edit_riwayat_pasangan">
                                                                    <i class="fa fa-pencil m-r-5"></i>Edit</a>
                                                                <a class="dropdown-item delete_pasangan" href="#" data-toggle="modal" data-target="#delete_pasangan">
                                                                    <i class="fa fa-trash-o m-r-5"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                        <!-- Tambah Riwayat Pasangan Modal -->
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
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
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
                                                <div class="col-md-6" id="show_nip_pasangan" style="display:none;">
                                                    <div class="form-group">
                                                        <label>NIP</label>
                                                        <input class="form-control" type="text" name="nip"
                                                            placeholder="Masukkan NIP">
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
                                                            <input class="form-control" type="number" name="no_hp"
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
                                                            <input class="form-control" type="number" name="no_telepon"
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
                        <!-- /Tambah Pasangan Modal -->
                        <!-- Edit Pasangan Modal -->
                        <div id="edit_riwayat_pasangan" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Pasangan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/pasangan/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_pasangan" value="">
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
                                                        <input class="form-control" type="text" name="nip" id="e_nip_pasangan"
                                                            placeholder="Jika status pasangan bukan PNS isi dengan -" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status Pernikahan</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="status_pernikahan" id="e_status_pernikahan_pasangan" required>
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
                                                        <input class="form-control" type="text" name="nama" id="e_nama_pasangan"
                                                            placeholder="Masukkan nama pasangan" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_lahir" id="e_tanggal_lahir_pasangan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Identitas</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_identitas" id="e_jenis_identitas_pasangan" required>
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
                                                        <select class="form-control" name="agama" id="e_agama_pasangan" required>
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
                                                        <input class="form-control" type="text" name="alamat" id="e_alamat_pasangan"
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
                                                            <input class="form-control" type="number" name="no_hp" id="e_no_hp_pasangan"
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
                                                            <input class="form-control" type="number" name="no_telepon" id="e_no_telepon_pasangan"
                                                                placeholder="Masukkan nomor telepon pasangan" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="email" name="email" id="e_email_pasangan" placeholder="Masukkan email pasangan" required>
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
                                                        <input type="hidden" name="hidden_pas_foto" id="e_pas_foto_pasangan"
                                                            value="">
                                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG,   PNG.</small>
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
                        <!-- /Edit Riwayat Pasangan Modal -->
                        <!-- Delete Riwayat PAsangan Modal -->
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
                                                <input type="hidden" name="id" class="e_id_pasangan" value="">
                                                <input type="hidden" name="dokumen_nikah" class="d_dokumen_nikah" value="">
                                <input type="hidden" name="pas_foto" class="d_pas_foto" value="">
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
                    <!-- End Delete Riwayat Pasangan Modal -->
                    </div>
                    </div>

                    <!-- Riwayat Anak Tab -->
                    <div class="tab-pane fade" id="riwayat_anak">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_anak">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Anak
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
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
                                            <th>Nomor Akta Lahir</th>
                                            <th>Dokumen Akta Kelahiran</th>
                                            <th>Pas Foto</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatAnak as $sqlAnak => $result_anak)
                                                <tr>
                                                    <td><center>{{ ++$sqlAnak }}</center></td>
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
                                                    <td class="dokumen_akta_kelahiran">
                                                        <center>
                                                            <a href="{{ asset('assets/DokumenAktaKelahiran/' . $result_anak->dokumen_akta_kelahiran) }}" target="_blank">
                                                                @if (pathinfo($result_anak->dokumen_akta_kelahiran, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                            </a>
                                                        </center>
                                                    </td>
                                                    <td class="pas_foto">
                                                        <center>
                                                            <a href="{{ asset('assets/DokumenPasFotoAnak/' . $result_anak->pas_foto) }}" target="_blank">
                                                                @if (in_array(pathinfo($result_anak->pas_foto, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                            </a>
                                                        </center>
                                                    </td>

                                                    {{-- Edit dan Hapus data  --}}
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit_anak" href="#" data-toggle="modal" data-target="#edit_anak">
                                                                    <i class="fa fa-pencil m-r-5"></i>Edit</a>
                                                                <a class="dropdown-item delete_anak" href="#" data-toggle="modal" data-target="#delete_anak">
                                                                    <i class="fa fa-trash-o m-r-5"></i>Delete</a>
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
                        <!-- Tambah Riwayat Anak Modal -->
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
                                        <form action="{{ route('riwayat/anak/tambah-data') }}" method="POST"
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
                                                        <label class="col-form-label">Orang Tua (Pasangan)</label><small
                                                            class="text-danger">*</small><br>
                                                        <select class="select form-control" name="orang_tua">
                                                            <option value="">-- Pilih Nama Orang Tua --</option>
                                                            @foreach ($userList as $user)
                                                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status Pekerjaan Anak</label><small class="text-danger">*</small>
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
                                                        <label>Tanggal Lahir</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_lahir" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status Anak</label><small class="text-danger">*</small><br>
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
                                                        <label>Jenis Dokumen</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_dokumen" required>
                                                            <option disabled selected value="">-- Pilih Jenis Dokumen --</option>
                                                            <option value="KTP/KIA">KTP/KIA</option>
                                                            <option value="Passport">Passport</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Dokumen</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_dokumen"
                                                            placeholder="Masukkan nomor dokumen " required>
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
                                                        <label>Nomor Akta Kelahiran</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_akta_kelahiran"
                                                            placeholder="Masukkan nomor akta kelahiran" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Akta Kelahiran</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="file" name="dokumen_akta_kelahiran">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pas Foto</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="file" name="pas_foto">
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
                        <!-- /Tambah Anak Modal -->
                        <!-- Edit Anak Modal -->
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
                                        <form action="{{ route('riwayat/anak/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_anak" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Orang Tua (Pasangan)</label><small
                                                            class="text-danger">*</small><br>
                                                        <select class="select form-control" name="orang_tua" id="e_orang_tua_anak">
                                                            <option value="">-- Pilih Nama Orang Tua --</option>
                                                            @foreach ($userList as $user)
                                                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status Pekerjaan Anak</label><small class="text-danger">*</small>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status_pekerjaan_anak" id="bukan_pns_anak"
                                                                value="Bukan PNS" required>
                                                            <label class="form-check-label">
                                                                Bukan PNS
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status_pekerjaan_anak" id="pns_anak"
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
                                                        <label>Jenis Kelamin</label><small class="text-danger">*</small>
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="jenis_kelamin" id="laki_laki_anak" value="Laki-Laki" required>
                                                                Laki-Laki
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="jenis_kelamin" id="perempuan_anak" value="Perempuan" required>
                                                                Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_lahir" id="e_tanggal_lahir_anak" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status Anak</label><small class="text-danger">*</small><br>
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
                                                        <label>Jenis Dokumen</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_dokumen" id="e_jenis_dokumen_anak" required>
                                                            <option disabled selected value="">-- Pilih Jenis Dokumen --</option>
                                                            <option value="KTP/KIA">KTP/KIA</option>
                                                            <option value="Passport">Passport</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Dokumen</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_dokumen" id="e_no_dokumen"
                                                            placeholder="Masukkan nomor dokumen " required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Agama</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="agama" id="e_agama_anak" required>
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
                                                                <input type="radio" name="status_hidup" id="hidup_anak" value="Hidup" required>
                                                                Hidup
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="status_hidup" id="meninggal_anak" value="Meninggal" required>
                                                                Meninggal
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Akta Kelahiran</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_akta_kelahiran" id="e_no_akta_kelahiran"
                                                            placeholder="Masukkan nomor akta kelahiran" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Akta Kelahiran</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="file" name="dokumen_akta_kelahiran" id="dokumen_akta_kelahiran">
                                                        <input type="hidden" name="hidden_dokumen_akta_kelahiran" id="e_dokumen_akta_kelahiran"
                                                            value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pas Foto</label><small class="text-danger">*</small>
                                                        <input type="file" class="form-control" id="pas_foto"
                                                            name="pas_foto">
                                                        <input type="hidden" name="hidden_pas_foto" id="e_pas_foto_anak"
                                                            value="">
                                                        <small class="text-danger">*Harap unggah foto dalam format JPEG, JPG, PNG.</small>
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
                                                <input type="hidden" name="id" class="e_id_anak" value="">
                                                <input type="hidden" name="dokumen_akta_kelahiran" class="d_dokumen_akta_kelahiran" value="">
                                                <input type="hidden" name="pas_foto" class="d_pas_foto_anak" value="">
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
                    <!-- End Delete Riwayat Anak Modal -->
                    </div>

                    <!-- Riwayat Penghargaan Tab -->
                    <div class="tab-pane fade" id="riwayat_penghargaan">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_penghargaan">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Penghargaan
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th>Jenis Penghargaan</th>
                                            <th>Tahun Perolehan</th>
                                            <th>Nomor Surat</th>
                                            <th>Tanggal SK</th>
                                            <th>Dokumen Penghargaan</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatPenghargaan as $sqlPenghargaan => $result_penghargaan)
                                            <tr>
                                                <td><center>{{ ++$sqlPenghargaan }}</center></td>
                                                <td hidden class="id"><center>{{ $result_penghargaan->id }}</center></td>
                                                <td class="jenis_penghargaan"><center>{{ $result_penghargaan->jenis_penghargaan }}</center></td>
                                                <td class="tahun_perolehan"><center>{{ $result_penghargaan->tahun_perolehan }}</center></td>
                                                <td class="no_surat"><center>{{ $result_penghargaan->no_surat }}</center></td>
                                                <td class="tanggal_keputusan"><center>{{ $result_penghargaan->tanggal_keputusan }}</center></td>
                                                <td class="dokumen_penghargaan"><center>
                                                    <a href="{{ asset('assets/DokumenPenghargaan/' . $result_penghargaan->dokumen_penghargaan) }}" target="_blank">
                                                        @if (pathinfo($result_penghargaan->dokumen_penghargaan, PATHINFO_EXTENSION) == 'pdf')
                                                            <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                        @endif
                                                            <td hidden class="dokumen_penghargaan">{{ $result_penghargaan->dokumen_penghargaan }}</td>
                                                    </a></center></td>

                                                {{-- Edit dan Hapus data  --}}
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_riwayat_penghargaan" href="#"
                                                                data-toggle="modal" data-target="#edit_riwayat_penghargaan"><i
                                                                    class="fa fa-pencil m-r-5"></i>
                                                                Edit</a>
                                                            <a class="dropdown-item delete_riwayat_penghargaan" href="#"
                                                                data-toggle="modal" data-target="#delete_riwayat_penghargaan"><i
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
                        <!-- Tambah Riwayat Penghargaan Modal -->
                        <div id="add_riwayat_penghargaan" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Riwayat Penghargaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/penghargaan/tambah-data') }}" method="POST"
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
                                                        <label>Jenis Penghargaan</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_penghargaan" required>
                                                            <option disabled selected value="">-- Pilih Jenis Penghargaan --</option>
                                                            <option value="Bintang">Bintang</option>
                                                            <option value="R.I Adipurna">R.I Adipurna</option>
                                                            <option value="R.I Adipradana">R.I Adipradana</option>
                                                            <option value="R.I Utama">R.I Utama</option>
                                                            <option value="R.I Pratama">R.I Pratama</option>
                                                            <option value="R.I Naraya">R.I Naraya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Perolehan</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" name="tahun_perolehan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Surat</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_surat" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_keputusan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Penghargaan</label>
                                                        <input class="form-control" type="file" name="dokumen_penghargaan">
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
                        <!-- /Tambah Penghargaan Modal -->
                        <!-- Edit Penghargaan Modal -->
                        <div id="edit_riwayat_penghargaan" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Penghargaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/penghargaan/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_penghargaan" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Penghargaan</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_penghargaan" id="e_jenis_penghargaan" required>
                                                            <option value="Bintang">Bintang</option>
                                                            <option value="R.I Adipurna">R.I Adipurna</option>
                                                            <option value="R.I Adipradana">R.I Adipradana</option>
                                                            <option value="R.I Utama">R.I Utama</option>
                                                            <option value="R.I Pratama">R.I Pratama</option>
                                                            <option value="R.I Naraya">R.I Naraya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tahun Perolehan</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="number" name="tahun_perolehan" id="e_tahun_perolehan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Surat</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_surat" id="e_no_surat" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_keputusan" id="e_tanggal_keputusan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Penghargaan</label><small class="text-danger">*</small>
                                                        <input type="file" class="form-control" id="dokumen_penghargaan"
                                                            name="dokumen_penghargaan">
                                                        <input type="hidden" name="hidden_dokumen_penghargaan" id="e_dokumen_penghargaan"
                                                            value="">
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
                        <!-- /Edit Riwayat Penghargaan Modal -->
                        <!-- Delete Riwayat Penghargaan Modal -->
                        <div class="modal custom-modal fade" id="delete_riwayat_penghargaan" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Riwayat Penghargaan</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('riwayat/penghargaan/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id_penghargaan" value="">
                                                <input type="hidden" name="dokumen_penghargaan" class="d_dokumen_penghargaan" value="">
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
                    <!-- End Delete Riwayat Penghargaan Modal -->
                    </div>

                    <!-- Riwayat Organisasi Tab -->
                    <div class="tab-pane fade" id="riwayat_organisasi">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_organisasi">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Organisasi
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama Organisasi</th>
                                            <th>Jabatan Organisasi</th>
                                            <th>Tanggal Gabung</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Nomor Anggota</th>
                                            <th>Dokumen Organisasi</th>
                                            <th>Aksi</th>
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
                                                <td class="text-right">
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
                        <!-- Tambah Riwayat Organisasi Modal -->
                        <div id="add_riwayat_organisasi" class="modal custom-modal fade" role="dialog">
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
                                                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Organisasi</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="nama_organisasi" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jabatan di Organisasi</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="jabatan_organisasi" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Bergabung</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_gabung" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_selesai" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Anggota</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_anggota" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Organisasi</label>
                                                        <input class="form-control" type="file" name="dokumen_organisasi">
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
                        <!-- /Tambah Organisasi Modal -->
                        <!-- Edit Organisasi Modal -->
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
                                        <form action="{{ route('riwayat/organisasi/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_organisasi" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Penghargaan</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="nama_organisasi" id="e_nama_organisasi" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jabatan di Organisasi</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="jabatan_organisasi" id="e_jabatan_organisasi" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Bergabung</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_gabung" id="e_tanggal_gabung" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_selesai" id="e_tanggal_selesai_organisasi" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Anggota</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_anggota" id="e_no_anggota" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Organisasi</label><small class="text-danger">*</small>
                                                        <input type="file" class="form-control" id="dokumen_organisasi"
                                                            name="dokumen_organisasi">
                                                        <input type="hidden" name="hidden_dokumen_organisasi" id="e_dokumen_organisasi"
                                                            value="">
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
                        <!-- /Edit Riwayat Organisasi Modal -->
                        <!-- Delete Riwayat Organisasi Modal -->
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
                                                <input type="hidden" name="id" class="e_id_organisasi" value="">
                                                <input type="hidden" name="dokumen_organisasi" class="d_dokumen_organisasi" value="">
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
                    <!-- End Delete Riwayat Organisasi Modal -->
                    </div>

                    <!-- Riwayat Hukuman Disiplin Tab -->
                    <div class="tab-pane fade" id="riwayat_hukum_disiplin">    
                        <div class="row">
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_hukum">
                                    <i class="fa fa-plus"></i> Tambah Riwayat Hukuman Disiplin
                                </a>
                            </div><br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table mb-0 datatable">
                                        <thead>
                                            <th>No</th>
                                            <th>Kategori Hukuman Disiplin</th>
                                            <th>Tingkat Hukuman</th>
                                            <th>Jenis Tingkat Hukuman</th>
                                            <th>Nomor SK Hukuman</th>
                                            <th>Tanggal SK Hukuman</th>
                                            <th>Nomor Peraturan</th>
                                            <th>Alasan Hukuman</th>
                                            <th>Masa Hukuman Tahun</th>
                                            <th>Masa Hukuman Bulan</th>
                                            <th>TMT Hukuman</th>
                                            <th>Keterangan</th>
                                            <th>Dokumen Hukuman Disiplin</th>
                                            <th>Dokumen SK Pengaktifan</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatHukumDisiplin as $sqlHD => $result_hukuman_disiplin)
                                            <tr>
                                                <td><center>{{ ++$sqlHD }}</center></td>
                                                <td hidden class="id"><center>{{ $result_hukuman_disiplin->id }}</center></td>
                                                <td class="kategori_hukuman"><center>{{ $result_hukuman_disiplin->kategori_hukuman }}</center></td>
                                                <td class="tingkat_hukuman"><center>{{ $result_hukuman_disiplin->tingkat_hukuman }}</center></td>
                                                <td class="jenis_hukuman"><center>{{ $result_hukuman_disiplin->jenis_hukuman }}</center></td>
                                                <td class="no_sk_hukuman"><center>{{ $result_hukuman_disiplin->no_sk_hukuman }}</center></td>
                                                <td class="tanggal_sk_hukuman"><center>{{ $result_hukuman_disiplin->tanggal_sk_hukuman }}</center></td>
                                                <td class="no_peraturan"><center>{{ $result_hukuman_disiplin->no_peraturan }}</center></td>
                                                <td class="alasan"><center>{{ $result_hukuman_disiplin->alasan }}</center></td>
                                                <td class="masa_hukuman_tahun"><center>{{ $result_hukuman_disiplin->masa_hukuman_tahun }}</center></td>
                                                <td class="masa_hukuman_bulan"><center>{{ $result_hukuman_disiplin->masa_hukuman_bulan }}</center></td>
                                                <td class="tmt_hukuman"><center>{{ $result_hukuman_disiplin->tmt_hukuman }}</center></td>
                                                <td class="keterangan"><center>{{ $result_hukuman_disiplin->keterangan }}</center></td>
                                                <td class="dokumen_sk_hukuman"><center>
                                                    <a href="{{ asset('assets/DokumenSKHukuman/' . $result_hukuman_disiplin->dokumen_sk_hukuman) }}" target="_blank">
                                                        @if (pathinfo($result_hukuman_disiplin->dokumen_sk_hukuman, PATHINFO_EXTENSION) == 'pdf')
                                                            <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                        @endif
                                                            <td hidden class="dokumen_sk_hukuman">{{ $result_hukuman_disiplin->dokumen_sk_hukuman }}</td>
                                                    </a></center></td>
                                                <td class="dokumen_sk_pengaktifan"><center>
                                                    <a href="{{ asset('assets/DokumenSKPengaktifan/' . $result_hukuman_disiplin->dokumen_sk_pengaktifan) }}" target="_blank">
                                                        @if (pathinfo($result_hukuman_disiplin->dokumen_sk_pengaktifan, PATHINFO_EXTENSION) == 'pdf')
                                                            <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                        @endif
                                                            <td hidden class="dokumen_sk_pengaktifan">{{ $result_hukuman_disiplin->dokumen_sk_pengaktifan }}</td>
                                                    </a></center></td>

                                                {{-- Edit dan Hapus data  --}}
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_riwayat_hukuman" href="#"
                                                                data-toggle="modal" data-target="#edit_riwayat_hukuman"><i
                                                                    class="fa fa-pencil m-r-5"></i>
                                                                Edit</a>
                                                            <a class="dropdown-item delete_riwayat_hukuman" href="#"
                                                                data-toggle="modal" data-target="#delete_riwayat_hukuman"><i
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
                        <!-- Tambah Riwayat Hukuman DIsiplin Modal -->
                        <div id="add_riwayat_hukum" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Riwayat Hukuman Disiplin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/hukumandisiplin/tambah-data') }}" method="POST"
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
                                                        <label>Kategori Hukuman</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="kategori_hukuman" required>
                                                            <option disabled selected value="">-- Pilih Kategori Hukuman --</option>
                                                            <option value="Penetapan">Penetapan</option>
                                                            <option value="Pengaktifan Kembali">Pengaktifan Kembali</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tingkat Hukuman</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="tingkat_hukuman" required>
                                                            <option disabled selected value="">-- Pilih Tingkat Hukuman --</option>
                                                            <option value="Berat">Berat</option>
                                                            <option value="Ringan">Ringan</option>
                                                            <option value="Sedang">Sedang</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Hukuman</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_hukuman" required>
                                                            <option disabled selected value="">-- Pilih Jenis Hukuman --</option>
                                                            <option value="Pembebasan Dari Jabatan">Pembebasan Dari Jabatan</option>
                                                            <option value="Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri">Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri</option>
                                                            <option value="Pemberhentian Tidak Dengan Hormat Sebagai PNS">Pemberhentian Tidak Dengan Hormat Sebagai PNS</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_sk_hukuman" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Peraturan</label>
                                                        <input class="form-control" type="text" name="no_peraturan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Alasan</label>
                                                        <select class="form-control" name="alasan">
                                                            <option disabled selected value="">-- Pilih Alasan --</option>
                                                            <option value="Tidak Mengucapkan Sumpah/Janji PNS">Tidak Mengucapkan Sumpah/Janji PNS</option>
                                                            <option value="Tidak Mengucapkan Sumpah/Janji Jabatan">Tidak Mengucapkan Sumpah/Janji Jabatan</option>
                                                            <option value="Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan">Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_sk_hukuman" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Hukuman Tahun</label>
                                                        <input class="form-control" type="text" name="masa_hukuman_tahun">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>TMT Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tmt_hukuman" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Hukuman Bulan</label>
                                                        <input class="form-control" type="text" name="masa_hukuman_bulan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Keterangan</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="keterangan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen SK Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="file" name="dokumen_sk_hukuman" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen SK Pengaktifan</label>
                                                        <input class="form-control" type="file" name="dokumen_sk_pengaktifan">
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
                        <!-- /Tambah Hukuman Disiplin Modal -->
                        <!-- Edit Hukuman Disiplin Modal -->
                        <div id="edit_riwayat_hukuman" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Riwayat Hukuman Disiplin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat/hukumandisiplin/edit-data') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="e_id_hukuman" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Kategori Hukuman</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="kategori_hukuman" id="e_kategori_hukuman" required>
                                                            <option disabled selected value="">-- Pilih Kategori Hukuman --</option>
                                                            <option value="Penetapan">Penetapan</option>
                                                            <option value="Pengaktifan Kembali">Pengaktifan Kembali</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tingkat Hukuman</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="tingkat_hukuman" id="e_tingkat_hukuman" required>
                                                            <option disabled selected value="">-- Pilih Tingkat Hukuman --</option>
                                                            <option value="Berat">Berat</option>
                                                            <option value="Ringan">Ringan</option>
                                                            <option value="Sedang">Sedang</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Hukuman</label><small class="text-danger">*</small>
                                                        <select class="form-control" name="jenis_hukuman" id="e_jenis_hukuman" required>
                                                            <option disabled selected value="">-- Pilih Jenis Hukuman --</option>
                                                            <option value="Pembebasan Dari Jabatan">Pembebasan Dari Jabatan</option>
                                                            <option value="Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri">Pemberhentian Dengan Hormat Tidak atas Permintaan Sendiri</option>
                                                            <option value="Pemberhentian Tidak Dengan Hormat Sebagai PNS">Pemberhentian Tidak Dengan Hormat Sebagai PNS</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor SK Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="no_sk_hukuman" id="e_no_sk_hukuman" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Peraturan</label>
                                                        <input class="form-control" type="text" name="no_peraturan" id="e_no_peraturan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Alasan</label>
                                                        <select class="form-control" name="alasan" id="e_alasan">
                                                            <option disabled selected value="">-- Pilih Alasan --</option>
                                                            <option value="Tidak Mengucapkan Sumpah/Janji PNS">Tidak Mengucapkan Sumpah/Janji PNS</option>
                                                            <option value="Tidak Mengucapkan Sumpah/Janji Jabatan">Tidak Mengucapkan Sumpah/Janji Jabatan</option>
                                                            <option value="Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan">Tidak Mentaati Segala Ketentuan Peraturan Perundang-undangan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tanggal_sk_hukuman" id="e_tanggal_sk_hukuman" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Hukuman Tahun</label>
                                                        <input class="form-control" type="text" name="masa_hukuman_tahun" id="e_masa_hukuman_tahun">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>TMT Hukuman</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="date" name="tmt_hukuman" id="e_tmt_hukuman" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Masa Hukuman Bulan</label>
                                                        <input class="form-control" type="text" name="masa_hukuman_bulan" id="e_masa_hukuman_bulan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Keterangan</label><small class="text-danger">*</small>
                                                        <input class="form-control" type="text" name="keterangan" id="e_keterangan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen SK Hukuman</label><small class="text-danger">*</small>
                                                        <input type="file" class="form-control" id="dokumen_sk_hukuman"
                                                            name="dokumen_sk_hukuman">
                                                        <input type="hidden" name="hidden_dokumen_sk_hukuman" id="e_dokumen_sk_hukuman"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen SK Pengaktifan</label><small class="text-danger">*</small>
                                                        <input type="file" class="form-control" id="dokumen_sk_pengaktifan"
                                                            name="dokumen_sk_pengaktifan">
                                                        <input type="hidden" name="hidden_dokumen_sk_pengaktifan" id="e_dokumen_sk_pengaktifan"
                                                            value="">
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
                        <!-- /Edit Riwayat Hukuman Disiplin Modal -->
                        <!-- Delete Riwayat Hukuman Disiplin Modal -->
                        <div class="modal custom-modal fade" id="delete_riwayat_hukuman" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Hapus Riwayat Hukuman Disiplin</h3>
                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <form action="{{ route('riwayat/hukumandisiplin/hapus-data') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" class="e_id_hukuman" value="">
                                                <input type="hidden" name="dokumen_sk_hukuman" class="d_dokumen_sk_hukuman" value="">
                                                <input type="hidden" name="dokumen_sk_pengaktifan" class="d_dokumen_sk_pengaktifan" value="">
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
                    <!-- End Delete Riwayat Hukuman Disiplin Modal -->
                    </div>
                    <!-- /Riwayat Tab -->

                </div>

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
                            <form action="{{ route('profile/information/save2') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ $users->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $users->user_id }}">
                                                    <input type="hidden" class="form-control" id="nip" name="nip" value="{{ $users->nip }}">
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
                                        {{-- <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . $users->avatar) }}" alt="{{ $users->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                @if (!empty($users))
                                                    <input type="hidden" name="hidden_image" id="e_image" value="{{ $users->avatar }}">
                                                @endif
                                            </div>
                                        </div> --}}
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" id="imagePreview" src="{{ URL::to('/assets/images/' . $users->avatar) }}" alt="{{ $users->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">Unggah</span>
                                                <input class="upload" type="file" id="image" name="images" onchange="previewImage(event)">
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
                                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
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
                                                    <option value="" disabled selected>-- Pilih Agama --</option>
                                                    @foreach($agamaOptions as $id => $namaAgama)
                                                        <option value="{{ $id }}" {{ $id == $users->agama ? 'selected' : '' }}>{{ $namaAgama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Dokumen</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" value="KTP" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"></label> 
                                                <label>Nomor Induk Kependudukan</label>
                                                <span class="text-danger">*</span>
                                                <input type="number" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" value="{{ $users->no_dokumen }}">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Provinsi </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ $users->provinsi }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <span class="text-danger">*</span><br>
                                                <select class="theSelect @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi">
                                                    <option value="" disabled selected>-- Pilih Provinsi --</option>
                                                    @foreach ($provinces as $provinsi)
                                                        <option value="{{ $provinsi->name }}" @if ($users->provinsi == $provinsi->name) selected @endif>{{ $provinsi->name }}</option>
                                                    @endforeach
                                                </select>
                                                <br><small class="text-danger">*Silahkan memilih dengan pilihan yang berbeda, setelah itu Anda dapat memilih pilihan anda kembali.</small>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kota/Kabupaten </label> <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ $users->kota }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kota/Kabupaten</label>
                                                <span class="text-danger">*</span><br>
                                                <select class="theSelect @error('kota') is-invalid @enderror" name="kota" id="kotakabupaten" value="{{ $users->kota }}">
                                               
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group"></label>
                                                <label>Kecamatan</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ $users->kecamatan }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <span class="text-danger">*</span><br>
                                                <select class="theSelect @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" value="{{ $users->kecamatan }}">
                                               
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group"></label>
                                                <label>Desa/Kelurahan</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $users->kelurahan }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Desa/Kelurahan</label>
                                                <span class="text-danger">*</span><br>
                                                <select class="theSelect @error('kelurahan') is-invalid @enderror" name="kelurahan" id="desakelurahan" value="{{ $users->kelurahan }}">
                                               
                                                </select>
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
                                                    <option value="" disabled selected>-- Pilih Jenis Pegawai --</option>
                                                    @foreach($jenispegawaiOptions as $id => $namaJenisPegawai)
                                                        @if(in_array($namaJenisPegawai, ['ASN', 'Non ASN', 'PPPK', 'CPNS']))
                                                            <option value="{{ $id }}" {{ $id == $users->jenis_pegawai ? 'selected' : '' }}>{{ $namaJenisPegawai }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kedudukan PNS </label> <span class="text-danger">*</span></label>
                                                <br>
                                                <select class="theSelect @error('kedudukan_pns') is-invalid @enderror" name="kedudukan_pns">
                                                    <option value="" disabled selected>-- Pilih Kedudukan --</option>
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
                                                        <option value="" disabled selected>-- Pilih Status Pegawai --</option>
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
                                                    <option selected disabled>-- Pilih Tingkat Pendidikan --</option>
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
                                                    <option selected disabled>-- Pilih Pendidikan Terakhir --</option>
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
                                                    <option value="" disabled selected>-- Pilih Ruangan --</option>
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
                                                                <option value="" disabled selected>-- Pilih Jenis Jabatan --</option>
                                                                @foreach ($jenisjabatanOptions as $optionValue => $jenisJabatan)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->jenis_jabatan) selected @endif>
                                                                        {{ $jenisJabatan }}
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
                                                            <small class="text-danger">*Jika bukan eselon dapat diisi tanda ( - )</small>
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
                                                            <br>
                                                            <select class="theSelect form-control" name="gol_ruang_awal">
                                                                <option value="" disabled selected>-- Pilih Golongan Ruang Awal --</option>
                                                                @foreach ($golonganOptions as $optionValue => $golAwal)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->gol_ruang_awal) selected @endif>
                                                                        {{ $golAwal }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Golongan Ruang Akhir</label>
                                                            <br>
                                                            <select class="theSelect form-control" name="gol_ruang_akhir">
                                                                <option value="" disabled selected>-- Pilih Golongan Ruang Akhir --</option>
                                                                @foreach ($golonganOptions as $optionValue => $golAkhir)
                                                                    <option value="{{ $optionValue }}" @if ($optionValue == $users->gol_ruang_akhir) selected @endif>
                                                                        {{ $golAkhir }}
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

        <script>
            function previewImage(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('imagePreview').src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- FancyBox Foto Profil -->
        <script>
            $(document).ready(function() {
                $('[data-fancybox="foto-profil"]').fancybox({
                });
            });
        </script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <!-- /FancyBox Foto Profil -->

        <script src="{{ asset('assets/js/pendidikan.js') }}"></script>
        <script src="{{ asset('assets/js/golongan.js') }}"></script>
        <script src="{{ asset('assets/js/jabatan.js') }}"></script>
        <script src="{{ asset('assets/js/diklat.js') }}"></script>
        <script src="{{ asset('assets/js/layanankgb.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatPMK.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatAngkaKredit.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatOrangTua.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatPasangan.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatAnak.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatPenghargaan.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatOrganisasi.js') }}"></script>
        <script src="{{ asset('assets/js/riwayatHukumanDisiplin.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
		$(".theSelect").select2();
	    </script>

        <script>
            $(function () {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                $(function () {
                    $('#provinsi').on('change', function (){
                        let nama_provinsi = $('#provinsi option:selected').text(); // Ambil teks dari opsi yang dipilih
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('getkota') }}",
                            data : {nama_provinsi: nama_provinsi}, // Kirim nama_provinsi
                            cache : false,

                            success: function(msg){
                                $('#kotakabupaten').html(msg);
                                $('#kecamatan').html('');
                                $('#desakelurahan').html('');
                            },
                            error: function(data){
                                console.log('error:', data.responseText);
                            },
                        })
                    })

                    $('#kotakabupaten').on('change', function (){
                        let nama_kotakabupaten = $('#kotakabupaten option:selected').text(); // Ambil teks dari opsi yang dipilih
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('getkecamatan_employee') }}",
                            data : {nama_kotakabupaten: nama_kotakabupaten}, // Kirim nama_kotakabupaten
                            cache : false,

                            success: function(msg){
                                $('#kecamatan').html(msg);
                                $('#desakelurahan').html('');
                            },
                            error: function(data){
                                console.log('error:', data.responseText);
                            },
                        })
                    })

                    $('#kecamatan').on('change', function (){
                        let nama_kecamatan= $('#kecamatan option:selected').text(); // Ambil teks dari opsi yang dipilih
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('getkelurahan') }}",
                            data : {nama_kecamatan: nama_kecamatan}, // Kirim nama_kecamatan
                            cache : false,

                            success: function(msg){
                                $('#desakelurahan').html(msg);
                            },
                            error: function(data){
                                console.log('error:', data.responseText);
                            },
                        })
                    })

                })
            });
        </script>


    @endsection
@endsection