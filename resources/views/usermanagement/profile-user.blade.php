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
                                            <img alt="" src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}" data-fancybox="foto-profil">
                                            <img alt="{{ Auth::user()->name }}" src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}">
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
                                                    <div class="title">E-mail</div>
                                                    <div class="text"><a href="mailto:{{ Session::get('email') }}">{{ Session::get('email') }}</a></div>
                                                </li>
                                                @if (!empty($information))
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Tanggal Lahir</div>
                                                        <div class="text">{{ date('d F Y', strtotime($information->tgl_lahir)) }}
                                                        </div>
                                                        @else
                                                        <div class="title">Tanggal Lahir</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Tempat Lahir</div>
                                                        <div class="text">{{ $information->tmpt_lahir }}</div>
                                                        @else
                                                        <div class="title">Tempat Lahir</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Alamat</div>
                                                        <div class="text">{{ $information->alamat }}</div>
                                                        @else
                                                        <div class="title">Alamat</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                        <div class="title">Jenis Kelamin</div>
                                                        <div class="text">{{ $information->jk }}</div>
                                                        @else
                                                        <div class="title">Jenis Kelamin</div>
                                                        <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    @else
                                                    <li>
                                                        <div class="title">Tanggal Lahir</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Tempat Lahir</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Alamat</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Jenis Kelamin</div>
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
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a href="#profil_pegawai" data-toggle="tab" class="nav-link active">Profil</a></li>
                            <li class="nav-item"><a href="#riwayat_golongan" data-toggle="tab" class="nav-link">Golongan</a></li>
                            <li class="nav-item"><a href="#kenaikan_gaji" data-toggle="tab" class="nav-link">Kenaikan Gaji Berkala</a></li>
                            <li class="nav-item"><a href="#riwayat_pmk" data-toggle="tab" class="nav-link">Peninjauan Masa Kerja</a></li>
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
                                        <a href="#" class="edit-icon" data-toggle="modal" data-target="#unggah_dokumen_ktp"><i class="fa fa-upload"></i></a></h3>
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
                                                <div class="text">{{ date('d F Y', strtotime($result_profilpegawai->tanggal_lahir)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_profilpegawai->tanggal_lahir }}</div>
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
                                            <div class="title">Nomor Induk Kependudukan</div>
                                            @if (!empty($result_profilpegawai->no_dokumen))
                                                <div class="text">{{ $result_profilpegawai->no_dokumen }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Provinsi</div>
                                            @if (!empty($result_profilpegawai->provinsi))
                                                <div class="text">{{ ucwords(strtolower($result_profilpegawai->provinsi)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kota/Kabupaten</div>
                                            @if (!empty($result_profilpegawai->kota))
                                                <div class="text">{{ ucwords(strtolower($result_profilpegawai->kota)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kecamatan</div>
                                            @if (!empty($result_profilpegawai->kecamatan))
                                                <div class="text">{{ ucwords(strtolower($result_profilpegawai->kecamatan)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Desa/Kelurahan</div>
                                            @if (!empty($result_profilpegawai->kelurahan))
                                                <div class="text">{{ ucwords(strtolower($result_profilpegawai->kelurahan)) }}</div>
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
                                                <div class="text">{{ date('d F Y', strtotime($result_profilpegawai->tmt_pns)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_profilpegawai->tmt_pns }}</div>
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
                                                <div class="text">{{ date('d F Y', strtotime($result_profilpegawai->tmt_cpns)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_profilpegawai->tmt_cpns }}</div>
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
                                                <div class="text">{{ ucwords(strtolower($result_profilpegawai->pendidikan_terakhir)) }}</div>
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
                                        <li>
                                            <div class="title">Dokumen KTP</div>
                                            <a href="{{ asset('assets/DokumenKTP/' . $result_profilpegawai->dokumen_ktp) }}" target="_blank">
                                                @if (pathinfo($result_profilpegawai->dokumen_ktp, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @else
                                                    <div class="text">N/A</div>
                                                @endif
                                                    <div hidden class="text">{{ $result_profilpegawai->dokumen_ktp }}</div>
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
                                            <div class="title">TMT</div>
                                            @if (!empty($result_posisijabatan->tmt))
                                                <div class="text">{{ date('d F Y', strtotime($result_posisijabatan->tmt)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_posisijabatan->tmt }}</div>
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
                                            <div class="title">TMT Golongan</div>
                                            @if (!empty($result_posisijabatan->tmt_golongan))
                                                <div class="text">{{ date('d F Y', strtotime($result_posisijabatan->tmt_golongan)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_posisijabatan->tmt_golongan }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Gaji Pokok </div>
                                            @if (!empty($result_posisijabatan->gaji_pokok))
                                            <div class="text">Rp. {{ number_format($result_posisijabatan->gaji_pokok, 0, ',', '.') }}</div>
                                            @else
                                            <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_posisijabatan->gaji_pokok }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Tahun)</div>
                                            @if (!empty($result_posisijabatan->masa_kerja_tahun))
                                                <div class="text">{{ $result_posisijabatan->masa_kerja_tahun }} Tahun</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_posisijabatan->masa_kerja_tahun }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Bulan)</div>
                                            @if (!empty($result_posisijabatan->masa_kerja_bulan))
                                                <div class="text">{{ $result_posisijabatan->masa_kerja_bulan }} Bulan</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_posisijabatan->masa_kerja_bulan }}</div>
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
                                            <div class="title">Tanggal SPMT</div>
                                            @if (!empty($result_posisijabatan->tanggal_spmt))
                                                <div class="text">{{ date('d F Y', strtotime($result_posisijabatan->tanggal_spmt)) }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                            <div hidden class="text">{{ $result_posisijabatan->tanggal_spmt }}</div>
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
                                                            <td class="pendidikan"><center>{{ ucwords(strtolower($result_pendidikan->pendidikan)) }}</center></td>
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
                                            <table class="table table-striped custom-table datatable">
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
                                                            <td class="masa_kerja_golongan_tahun"><center>{{ $result_golongan->masa_kerja_golongan_tahun }} Tahun</center></td>
                                                            <td class="masa_kerja_golongan_bulan"><center>{{ $result_golongan->masa_kerja_golongan_bulan }} Bulan</center></td>
                                                            <td class="tmt_golongan_riwayat"><center>{{ \Carbon\Carbon::parse($result_golongan->tmt_golongan_riwayat)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="no_teknis_bkn"><center>{{ $result_golongan->no_teknis_bkn }}</center></td>
                                                            <td class="tanggal_teknis_bkn"><center>{{ \Carbon\Carbon::parse($result_golongan->tanggal_teknis_bkn)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="no_sk_golongan"><center>{{ $result_golongan->no_sk_golongan }}</center></td>
                                                            <td class="tanggal_sk_golongan"><center>{{ \Carbon\Carbon::parse($result_golongan->tanggal_sk_golongan)->formatLocalized('%d %B %Y') }}</center></td>
                                                            <td class="dokumen_skkp"><center>
                                                                <a href="{{ asset('assets/DokumenSKKP/' . $result_golongan->dokumen_skkp) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a>
                                                            </center></td>
                                                            <td class="dokumen_teknis_kp"><center>
                                                                <a href="{{ asset('assets/DokumenTeknisKP/' . $result_golongan->dokumen_teknis_kp) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                </a>
                                                            </center></td>
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
                                                        <th class="durasi_jam">Durasi (Jam)</th>
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
                                                    <td class="durasi_jam"><center>{{ $result_diklat->durasi_jam }} Jam</center></td>
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

                            <!-- Layanan KGB Tab -->
                            <div class="tab-pane fade" id="kenaikan_gaji">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    <th>Golongan Awal</th>
                                                    <th>Golongan Akhir</th>
                                                    <th>Gaji Pokok Lama</th>
                                                    <th>Gaji Pokok Akhir</th>
                                                    <th>Tanggal SK Kenaikan Gaji Berkala</th>
                                                    <th>Nomor SK Kenaikan Gaji Berkala</th>
                                                    <th>Tanggal Berlaku</th>
                                                    <th>Masa Kerja Golongan (Tahun)</th>
                                                    <th>Masa Kerja (Tahun)</th>
                                                    <th>Terhitung Mulai Tanggal Kenaikan Gaji Berkala</th>
                                                    <th>Dokumen KGB</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_kgb as $sqlKGB => $result_kgb)
                                                    <tr>
                                                        <td>{{ ++$sqlKGB }}</td>
                                                        <td hidden class="id"><center>{{ $result_kgb->id }}</center></td>
                                                        <td class="name"><center>{{ $result_kgb->name }}</center></td>
                                                        <td class="nip"><center>{{ $result_kgb->nip }}</center></td>
                                                        <td class="golongan_awal"><center>{{ $result_kgb->golongan_awal }}</center></td>
                                                        <td class="golongan_akhir"><center>{{ $result_kgb->golongan_akhir }}</center></td>
                                                        <td class="gapok_lama"><center>Rp. {{ number_format($result_kgb->gapok_lama, 0, ',', '.') }}</center></td>
                                                        <td class="gapok_baru"><center>Rp. {{ number_format($result_kgb->gapok_baru, 0, ',', '.') }}</center></td>
                                                        <td class="tgl_sk_kgb"><center>{{ \Carbon\Carbon::parse($result_kgb->tgl_sk_kgb)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="no_sk_kgb"><center>{{ $result_kgb->no_sk_kgb }}</center></td>
                                                        <td class="tgl_berlaku"><center>{{ \Carbon\Carbon::parse($result_kgb->tgl_berlaku)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="masa_kerja_golongan"><center>{{ $result_kgb->masa_kerja_golongan }} Tahun</center></td>
                                                        <td class="masa_kerja"><center>{{ $result_kgb->masa_kerja }} Tahun</center></td>
                                                        <td class="tmt_kgb"><center>{{ \Carbon\Carbon::parse($result_kgb->tmt_kgb)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="dokumen_kgb"><center>
                                                            <a href="{{ asset('assets/DokumenKGB/' . $result_kgb->dokumen_kgb) }}" target="_blank">
                                                                @if (pathinfo($result_kgb->dokumen_kgb, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="dokumen_kgb">{{ $result_kgb->dokumen_kgb }}</td>
                                                            </a>
                                                        </center></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Layanan KGB Tab -->

                            <!-- Riwayat PMK Tab -->
                            <div class="tab-pane fade" id="riwayat_pmk">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable">
                                            <thead>
                                                <tr>
                                                    <th class="no">No</th>
                                                    <th>Jenis Peninjauan Masa Kerja</th>
                                                    <th>Instansi</th>
                                                    <th>Tanggal Awal</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>Nomor SK</th>
                                                    <th>Tanggal SK</th>
                                                    <th>Nomor BKN</th>
                                                    <th>Tanggal BKN</th>
                                                    <th>Masa Kerja (Tahun)</th>
                                                    <th>Masa Kerja (Bulan)</th>
                                                    <th>Dokumen PMK</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatPMK as $sqlPMK => $result_pmk)
                                                    <tr>
                                                        <td>{{ ++$sqlPMK }}</td>
                                                        <td hidden class="id"><center>{{ $result_pmk->id }}</center></td>
                                                        <td class="jenis_pmk"><center>{{ $result_pmk->jenis_pmk }}</center></td>
                                                        <td class="instansi"><center>{{ $result_pmk->instansi }}</center></td>
                                                        <td class="tanggal_awal"><center>{{ \Carbon\Carbon::parse($result_pmk->tanggal_awal)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="tanggal_akhir"><center>{{ \Carbon\Carbon::parse($result_pmk->tanggal_akhir)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="no_sk"><center>{{ $result_pmk->no_sk }}</center></td>
                                                        <td class="tanggal_sk"><center>{{ \Carbon\Carbon::parse($result_pmk->tanggal_sk)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="no_bkn"><center>{{ $result_pmk->no_bkn }}</center></td>
                                                        <td class="tanggal_bkn"><center>{{ \Carbon\Carbon::parse($result_pmk->tanggal_bkn)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="masa_tahun"><center>{{ $result_pmk->masa_tahun }} Tahun</center></td>
                                                        <td class="masa_bulan"><center>{{ $result_pmk->masa_bulan }} Bulan</center></td>
                                                        <td class="dokumen_pmk"><center>
                                                                <a href="{{ asset('assets/DokumenPMK/' . $result_pmk->dokumen_pmk) }}" target="_blank">
                                                                    @if (pathinfo($result_pmk->dokumen_pmk, PATHINFO_EXTENSION) == 'pdf')
                                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                    @endif
                                                                        <td hidden class="dokumen_pmk">{{ $result_pmk->dokumen_pmk }}</td>
                                                                </a></center></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Riwayat PMK Tab -->

                            <!-- Riwayat Angka Kredit Tab -->
                            <div class="tab-pane fade" id="riwayat_angka_kredit">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable">
                                            <thead>
                                                <tr>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatAK as $sqlAK => $result_angka_kredit)
                                                    <tr>
                                                        <td><center>{{ ++$sqlAK }}</center></td>
                                                        <td hidden class="id"><center>{{ $result_angka_kredit->id }}</center></td>
                                                        <td class="nama_jabatan"><center>{{ $result_angka_kredit->nama_jabatan }}</center></td>
                                                        <td class="nomor_sk"><center>{{ $result_angka_kredit->nomor_sk }}</center></td>
                                                        <td class="tanggal_sk"><center>{{ \Carbon\Carbon::parse($result_angka_kredit->tanggal_sk)->formatLocalized('%d %B %Y') }}</center></td>
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
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Riwayat Angka Kredit Tab -->

                            <!-- Riwayat OrangTua Tab -->
                            <div class="tab-pane fade" id="riwayat_orang_tua">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Status Hidup</th>
                                                    <th>Status Pekerjaan Orang Tua</th>
                                                    <th>NIP</th>
                                                    <th>Tanggal Meninggal</th>
                                                    <th>Nama Orang Tua</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Jenis Identitas</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Agama</th>
                                                    <th>Status Pernikahan</th>
                                                    <th>Alamat</th>
                                                    <th>E-Mail</th>
                                                    <th>No HP</th>
                                                    <th>No Telp</th>
                                                    <th>Dokumen Kartu Keluarga</th>
                                                    <th>Dokumen Akta Anak</th>
                                                    <th>Pas Foto Ayah</th>
                                                    <th>Pas Foto Ibu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatOrtu as $sqlOrtu => $result_Ortu)
                                                    <tr>
                                                        <td>{{ ++$sqlOrtu }}</td>
                                                        <td class="status_hidup"><center>{{ $result_Ortu->status_hidup }}</center></td>
                                                        <td class="status_pekerjaan_ortu"><center>{{ $result_Ortu->status_pekerjaan_ortu }}</center></td>
                                                        <td class="nip"><center>{{ $result_Ortu->nip }}</center></td>
                                                        <td class="tanggal_meninggal"><center>
                                                            @if($result_Ortu->tanggal_meninggal)
                                                                {{ \Carbon\Carbon::parse($result_Ortu->tanggal_meninggal)->formatLocalized('%d %B %Y') }}
                                                            @endif
                                                        </center></td>
                                                        <td class="nama"><center>{{ $result_Ortu->nama }}</center></td>
                                                        <td class="tanggal_lahir"><center>{{ \Carbon\Carbon::parse($result_Ortu->tanggal_lahir)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="jenis_identitas"><center>{{ $result_Ortu->jenis_identitas }}</center></td>
                                                        <td class="jenis_kelamin"><center>{{ $result_Ortu->jenis_kelamin }}</center></td>
                                                        <td class="agama"><center>{{ $result_Ortu->agama }}</center></td>
                                                        <td class="status_pernikahan"><center>{{ $result_Ortu->status_pernikahan }}</center></td>
                                                        <td class="alamat"><center>{{ $result_Ortu->alamat }}</center></td>

                                                        <td class="email"><center>
                                                            <a href="mailto:{{ $result_Ortu->email }}" style="color:black">{{ $result_Ortu->email }}</a>
                                                        </center></td>
                
                                                        @if (!empty($result_Ortu->no_hp))
                                                            <td class="text"><center><a href="https://api.whatsapp.com/send?phone=0{{ $result_Ortu->no_hp }}" target="_blank" style="color:black">0{{ $result_Ortu->no_hp }}</a></center></td>
                                                        @endif
                                                            <td hidden class="no_hp">{{ $result_Ortu->no_hp }}</td>
                
                                                        @if (!empty($result_Ortu->no_telepon))
                                                            <td class="text"><center><a href="https://api.whatsapp.com/send?phone=0{{ $result_Ortu->no_telepon }}" target="_blank" style="color:black">0{{ $result_Ortu->no_telepon }}</a></center></td>
                                                        @endif
                                                            <td hidden class="no_telepon">{{ $result_Ortu->no_telepon }}</td>

                                                        <td class="dokumen_kk"><center>
                                                            <a href="{{ asset('assets/DokumenKartuKeluarga/' . $result_Ortu->dokumen_kk) }}" target="_blank">
                                                                @if (pathinfo($result_Ortu->dokumen_kk, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="dokumen_kk">{{ $result_Ortu->dokumen_kk }}</td>
                                                            </a>
                                                        </center></td>
                                                        <td class="dokumen_akta_lahir_anak"><center>
                                                            <a href="{{ asset('assets/DokumenAktaLahirAnak/' . $result_Ortu->dokumen_akta_lahir_anak) }}" target="_blank">
                                                                @if (pathinfo($result_Ortu->dokumen_akta_lahir_anak, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="dokumen_akta_lahir_anak">{{ $result_Ortu->dokumen_akta_lahir_anak }}</td>
                                                            </a>
                                                        </center></td>
                                                        <td class="pas_foto_ayah"><center>
                                                            <a href="{{ asset('assets/DokumenPasFotoAyah/' . $result_Ortu->pas_foto_ayah) }}" target="_blank">
                                                                @if (in_array(pathinfo($result_Ortu->pas_foto_ayah, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="pas_foto_ayah">{{ $result_Ortu->pas_foto_ayah }}</td>
                                                            </a>
                                                        </center></td>
                                                        <td class="pas_foto_ibu"><center>
                                                            <a href="{{ asset('assets/DokumenPasFotoIbu/' . $result_Ortu->pas_foto_ibu) }}" target="_blank">
                                                                @if (in_array(pathinfo($result_Ortu->pas_foto_ibu, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="pas_foto_ibu">{{ $result_Ortu->pas_foto_ibu }}</td>
                                                            </a>
                                                        </center></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Riwayat Orang Tua Tab -->

                            <!-- Riwayat Pasangan Tab -->
                            <div class="tab-pane fade" id="riwayat_pasangan">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Suami/Istri Ke</th>
                                                    <th>Status Pekerjaan Pasangan</th>
                                                    <th>NIP</th>
                                                    <th>Status Pernikahan</th>
                                                    <th>Nama Pasangan</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Jenis Identitas</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Agama</th>
                                                    <th>Status Hidup</th>
                                                    <th>Nomor Karsu/Karis</th>
                                                    <th>Alamat</th>
                                                    <th>No HP</th>
                                                    <th>No Telp</th>
                                                    <th>Email</th>
                                                    <th>Dokumen Nikah</th>
                                                    <th>Pas Foto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatPasangan as $sqlPasangan => $result_pasangan)
                                                    <tr>
                                                        <td>{{ ++$sqlPasangan }}</td>
                                                        <td class="suami_istri_ke"><center>{{ $result_pasangan->suami_istri_ke }}</center></td>
                                                        <td class="status_pekerjaan_pasangan"><center>{{ $result_pasangan->status_pekerjaan_pasangan }}</center></td>
                                                        <td class="nip"><center>{{ $result_pasangan->nip }}</center></td>
                                                        <td class="status_pernikahan"><center>{{ $result_pasangan->status_pernikahan }}</center></td>
                                                        <td class="nama"><center>{{ $result_pasangan->nama }}</center></td>
                                                        <td class="tanggal_lahir"><center>{{ \Carbon\Carbon::parse($result_pasangan->tanggal_lahir)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="jenis_identitas"><center>{{ $result_pasangan->jenis_identitas }}</center></td>
                                                        <td class="jenis_kelamin"><center>{{ $result_pasangan->jenis_kelamin }}</center></td>
                                                        <td class="agama"><center>{{ $result_pasangan->agama }}</center></td>
                                                        <td class="status_hidup"><center>{{ $result_pasangan->status_hidup }}</center></td>
                                                        <td class="no_karis_karsu"><center>{{ $result_pasangan->no_karis_karsu }}</center></td>
                                                        <td class="alamat"><center>{{ $result_pasangan->alamat }}</center></td>

                                                        @if (!empty($result_pasangan->no_hp))
                                                            <td class="text"><center><a href="https://api.whatsapp.com/send?phone=0{{ $result_pasangan->no_hp }}" target="_blank" style="color:black">0{{ $result_pasangan->no_hp }}</a></center></td>
                                                        @endif
                                                            <td hidden class="no_hp">{{ $result_pasangan->no_hp }}</td>

                                                        @if (!empty($result_pasangan->no_telepon))
                                                            <td class="text"><center><a href="https://api.whatsapp.com/send?phone=0{{ $result_pasangan->no_telepon }}" target="_blank" style="color:black">0{{ $result_pasangan->no_telepon }}</a></center></td>
                                                        @endif
                                                            <td hidden class="no_telepon">{{ $result_pasangan->no_telepon }}</td>

                                                        <td class="email"><center>
                                                            <a href="mailto:{{ $result_pasangan->email }}" style="color:black">{{ $result_pasangan->email }}</a>
                                                        </center></td>

                                                        <td class="dokumen_nikah"><center>
                                                            <a href="{{ asset('assets/DokumenNikah/' . $result_pasangan->dokumen_nikah) }}" target="_blank">
                                                                @if (pathinfo($result_pasangan->dokumen_nikah, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="dokumen_nikah">{{ $result_pasangan->dokumen_nikah }}</td>
                                                            </a>
                                                        </center></td>
                                                        <td class="pas_foto"><center>
                                                            <a href="{{ asset('assets/DokumenPasFotoPasangan/' . $result_pasangan->pas_foto) }}" target="_blank">
                                                                @if (in_array(pathinfo($result_pasangan->pas_foto, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                    <i class="fa fa-file-image-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="pas_foto">{{ $result_pasangan->pas_foto }}</td>
                                                            </a>
                                                        </center></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div></div>
                            <!-- Riwayat Pasangan Tab -->

                            <!-- Riwayat Anak Tab -->
                            <div class="tab-pane fade" id="riwayat_anak">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatAnak as $sqlAnak => $result_anak)
                                            <tr>
                                                <td><center>{{ ++$sqlAnak }}</center></td>
                                                <td class="orang_tua"><center>{{ $result_anak->orang_tua }}</center></td>
                                                <td class="status_pekerjaan_anak"><center>{{ $result_anak->status_pekerjaan_anak }}</center></td>
                                                <td class="nama_anak"><center>{{ $result_anak->nama_anak }}</center></td>
                                                <td class="jenis_kelamin"><center>{{ $result_anak->jenis_kelamin }}</center></td>
                                                <td class="tanggal_lahir"><center>{{ \Carbon\Carbon::parse($result_anak->tanggal_lahir)->formatLocalized('%d %B %Y') }}</center></td>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- Riwayat Anak Tab -->

                            <!-- Riwayat Penghargaan Tab -->
                            <div class="tab-pane fade" id="riwayat_penghargaan">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable">
                                            <thead>
                                                <tr>
                                                    <th><center>No</center></th>
                                                    <th><center>Jenis Penghargaan</center></th>
                                                    <th><center>Tahun Perolehan</center></th>
                                                    <th><center>Nomor Surat</center></th>
                                                    <th><center>Tanggal SK</center></th>
                                                    <th><center>Dokumen Penghargaan</center></th>
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
                                                        <td class="tanggal_keputusan"><center>{{ \Carbon\Carbon::parse($result_penghargaan->tanggal_keputusan)->formatLocalized('%d %B %Y') }}</center></td>
                                                        <td class="dokumen_penghargaan"><center>
                                                            <a href="{{ asset('assets/DokumenPenghargaan/' . $result_penghargaan->dokumen_penghargaan) }}" target="_blank">
                                                                @if (pathinfo($result_penghargaan->dokumen_penghargaan, PATHINFO_EXTENSION) == 'pdf')
                                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                                @endif
                                                                    <td hidden class="dokumen_penghargaan">{{ $result_penghargaan->dokumen_penghargaan }}</td>
                                                            </a>
                                                        </center></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Riwayat Penghargaan Tab -->

                            <!-- Riwayat Organisasi Tab -->
                            <div class="tab-pane fade" id="riwayat_organisasi">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                            <tr>
                                                <th><center>No</center></th>
                                                <th><center>Nama Organisasi</center></th>
                                                <th><center>Jabatan Organisasi</center></th>
                                                <th><center>Tanggal Gabung</center></th>
                                                <th><center>Tanggal Selesai</center></th>
                                                <th><center>Nomor Anggota</center></th>
                                                <th><center>Dokumen Organisasi</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatOrganisasi as $sqlOrganisasi => $result_organisasi)
                                                <tr>
                                                    <td><center>{{ ++$sqlOrganisasi }}</center></td>
                                                    <td hidden class="id"><center>{{ $result_organisasi->id }}</center></td>
                                                    <td class="nama_organisasi"><center>{{ $result_organisasi->nama_organisasi }}</center></td>
                                                    <td class="jabatan_organisasi"><center>{{ $result_organisasi->jabatan_organisasi }}</center></td>
                                                    <td class="tanggal_gabung"><center>{{ \Carbon\Carbon::parse($result_organisasi->tanggal_gabung)->formatLocalized('%d %B %Y') }}</center></td>
                                                    <td class="tanggal_selesai"><center>{{ \Carbon\Carbon::parse($result_organisasi->tanggal_selesai)->formatLocalized('%d %B %Y') }}</center></td>
                                                    <td class="no_anggota"><center>{{ $result_organisasi->no_anggota }}</center></td>
                                                    <td class="dokumen_organisasi"><center>
                                                        <a href="{{ asset('assets/DokumenOrganisasi/' . $result_organisasi->dokumen_organisasi) }}" target="_blank">
                                                            @if (pathinfo($result_organisasi->dokumen_organisasi, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_organisasi">{{ $result_organisasi->dokumen_organisasi }}</td>
                                                        </a>
                                                    </center></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            </div>
                            <!-- Riwayat Organisasi Tab -->

                            <!-- Riwayat Hukum Disiplin Tab -->
                            <div class="tab-pane fade" id="riwayat_hukum_disiplin">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Hukuman Disiplin</th>
                                                <th>Tingkat Hukuman</th>
                                                <th>Jenis Tingkat Hukuman</th>
                                                <th>Nomor SK Hukuman</th>
                                                <th>Tanggal SK Hukuman</th>
                                                <th>Nomor Peraturan</th>
                                                <th>Alasan Hukuman</th>
                                                <th>Masa Hukuman (Tahun)</th>
                                                <th>Masa Hukuman (Bulan)</th>
                                                <th>TMT Hukuman</th>
                                                <th>Keterangan</th>
                                                <th>Dokumen Hukuman Disiplin</th>
                                                <th>Dokumen SK Pengaktifan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatHD as $sqlHD => $result_hukuman_disiplin)
                                                <tr>
                                                    <td><center>{{ ++$sqlHD }}</center></td>
                                                    <td hidden class="id"><center>{{ $result_hukuman_disiplin->id }}</center></td>
                                                    <td class="kategori_hukuman"><center>{{ $result_hukuman_disiplin->kategori_hukuman }}</center></td>
                                                    <td class="tingkat_hukuman"><center>{{ $result_hukuman_disiplin->tingkat_hukuman }}</center></td>
                                                    <td class="jenis_hukuman"><center>{{ $result_hukuman_disiplin->jenis_hukuman }}</center></td>
                                                    <td class="no_sk_hukuman"><center>{{ $result_hukuman_disiplin->no_sk_hukuman }}</center></td>
                                                    <td class="tanggal_sk_hukuman"><center>{{ \Carbon\Carbon::parse($result_hukuman_disiplin->tanggal_sk_hukuman)->formatLocalized('%d %B %Y') }}</center></td>
                                                    <td class="no_peraturan"><center>{{ $result_hukuman_disiplin->no_peraturan }}</center></td>
                                                    <td class="alasan"><center>{{ $result_hukuman_disiplin->alasan }}</center></td>
                                                    <td class="masa_hukuman_tahun"><center>{{ $result_hukuman_disiplin->masa_hukuman_tahun }} Tahun</center></td>
                                                    <td class="masa_hukuman_bulan"><center>{{ $result_hukuman_disiplin->masa_hukuman_bulan }} Bulan</center></td>
                                                    <td class="tmt_hukuman"><center>{{ \Carbon\Carbon::parse($result_hukuman_disiplin->tmt_hukuman)->formatLocalized('%d %B %Y') }}</center></td>
                                                    <td class="keterangan"><center>{{ $result_hukuman_disiplin->keterangan }}</center></td>
                                                    <td class="dokumen_sk_hukuman"><center>
                                                        <a href="{{ asset('assets/DokumenSKHukuman/' . $result_hukuman_disiplin->dokumen_sk_hukuman) }}" target="_blank">
                                                            @if (pathinfo($result_hukuman_disiplin->dokumen_sk_hukuman, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_sk_hukuman">{{ $result_hukuman_disiplin->dokumen_sk_hukuman }}</td>
                                                        </a>
                                                    </center></td>
                                                    <td class="dokumen_sk_pengaktifan"><center>
                                                        <a href="{{ asset('assets/DokumenSKPengaktifan/' . $result_hukuman_disiplin->dokumen_sk_pengaktifan) }}" target="_blank">
                                                            @if (pathinfo($result_hukuman_disiplin->dokumen_sk_pengaktifan, PATHINFO_EXTENSION) == 'pdf')
                                                                <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                            @endif
                                                                <td hidden class="dokumen_sk_pengaktifan">{{ $result_hukuman_disiplin->dokumen_sk_pengaktifan }}</td>
                                                        </a>
                                                    </center></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div></div>
                        <!-- Riwayat Hukum Disiplin Tab -->
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
                            <form action="{{ route('profile/information/save2') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="nip" name="nip" value="{{ Auth::user()->nip }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" value="{{ $information->tgl_lahir }}">
                                                        <small class="text-danger">Example : 10-10-2023</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" value="{{ $information->tmpt_lahir }}">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="avatar" name="avatar" value="{{ $user->avatar }}">
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
                            <form action="{{ route('profile/information/save2') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="nip" name="nip" value="{{ Auth::user()->nip }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                                        <small class="text-danger">Example : 10-10-2023</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir">
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
                                                        <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="avatar" name="avatar" value="{{ $user->avatar }}">
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
                                            <img class="inline-block" id="imagePreview" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">Unggah</span>
                                                <input class="upload" type="file" id="image" name="images" onchange="previewImage(event)">
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
                                            <img class="inline-block" id="imagePreview" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">Unggah</span>
                                                <input class="upload" type="file" id="image" name="images" onchange="previewImage(event)">
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
                                        <input type="hidden" class="form-control" name="user_id" value="{{ $result_profilpegawai->user_id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIP <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $result_profilpegawai->nip }}">
                                                    @error('nip')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gelar Depan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('gelar_depan') is-invalid @enderror" name="gelar_depan" value="{{ $result_profilpegawai->gelar_depan }}">
                                                    @error('gelar_depan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gelar Belakang <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('gelar_belakang') is-invalid @enderror" name="gelar_belakang" value="{{ $result_profilpegawai->gelar_belakang }}">
                                                    @error('gelar_belakang')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $result_profilpegawai->tempat_lahir }}">
                                                    @error('tempat_lahir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $result_profilpegawai->tanggal_lahir }}">
                                                    @error('tanggal_lahir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                                    <select class="select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                                        <option value="Laki-Laki" @if ($result_profilpegawai->jenis_kelamin === 'Laki-Laki') selected @endif>Laki-Laki</option>
                                                        <option value="Perempuan" @if ($result_profilpegawai->jenis_kelamin === 'Perempuan') selected @endif>Perempuan</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agama <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect @error('agama') is-invalid @enderror" name="agama" style="width: 100% !important">
                                                        <option value="" disabled selected>-- Pilih Agama --</option>
                                                        @foreach ($agamaOptions as $optionValue => $namaAgama)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->agama) selected @endif>
                                                                {{ $namaAgama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('agama')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Dokumen <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" value="KTP" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Induk Kependudukan</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="number" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" value="{{ $result_profilpegawai->no_dokumen }}">
                                                    @error('no_dokumen')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <span class="text-danger">*</span><br>
                                                    <select class="theSelect @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" style="width: 100% !important">
                                                            <option value="" disabled selected>-- Pilih Provinsi --</option>
                                                        @foreach ($provinces as $provinsi)
                                                            <option value="{{ $provinsi->name }}" @if ($result_profilpegawai->provinsi == $provinsi->name) selected @endif>{{ $provinsi->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('provinsi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <br><small class="text-danger">*Silahkan memilih dengan pilihan yang berbeda, setelah itu Anda dapat memilih pilihan anda kembali.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kota/Kabupaten</label>
                                                    <span class="text-danger">*</span><br>
                                                    <select class="theSelect @error('kota') is-invalid @enderror" name="kota" id="kotakabupaten" style="width: 100% !important" style="width: 100% !important" value="{{ $result_profilpegawai->kota }}">
                                                    
                                                    </select>
                                                    @error('kota')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <span class="text-danger">*</span><br>
                                                    <select class="theSelect @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" style="width: 100% !important" value="{{ $result_profilpegawai->kecamatan }}">
                                                    
                                                    </select>
                                                    @error('kecamatan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Desa/Kelurahan</label>
                                                    <span class="text-danger">*</span><br>
                                                    <select class="theSelect @error('kelurahan') is-invalid @enderror" name="kelurahan" id="desakelurahan" style="width: 100% !important" value="{{ $result_profilpegawai->kelurahan }}">
                                                    
                                                    </select>
                                                    @error('kelurahan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $result_profilpegawai->kode_pos }}">
                                                    @error('kode_pos')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor HP </label>
                                                    <span class="text-danger">*</span>
                                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $result_profilpegawai->no_hp }}">
                                                    @error('no_hp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Telepon</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ $result_profilpegawai->no_telp }}">
                                                    @error('no_telp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Pegawai</label>
                                                    <span class="text-danger">*</span>
                                                    <br>
                                                    <select class="theSelect @error('jenis_pegawai') is-invalid @enderror" name="jenis_pegawai" style="width: 100% !important">
                                                        <option value="" disabled selected>-- Pilih Jenis Pegawai --</option>
                                                        @foreach ($jenispegawaiOptions as $id => $namaJenisPegawai)
                                                            @if(in_array($namaJenisPegawai, ['ASN', 'Non ASN', 'PPPK', 'CPNS']))
                                                                <option value="{{ $id }}" @if ($id == $result_profilpegawai->jenis_pegawai) selected @endif>{{ $namaJenisPegawai }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_pegawai')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kedudukan PNS <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect @error('kedudukan_pns') is-invalid @enderror" name="kedudukan_pns" style="width: 100% !important">
                                                        <option value="" disabled selected>-- Pilih Kedudukan --</option>
                                                        @foreach ($kedudukanOptions as $optionValue => $namaKedudukan)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->kedudukan_pns) selected @endif>
                                                                {{ $namaKedudukan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kedudukan_pns')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status Pegawai <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect @error('status_pegawai') is-invalid @enderror" name="status_pegawai" style="width: 100% !important">
                                                        <option value="" disabled selected>-- Pilih Status Pegawai --</option>
                                                        <option value="Aktif" @if ($result_profilpegawai->status_pegawai === 'Aktif') selected @endif>Aktif</option>
                                                        <option value="Tidak Aktif" @if ($result_profilpegawai->status_pegawai === 'Tidak Aktif') selected @endif>Tidak Aktif</option>
                                                    </select>
                                                    @error('status_pegawai')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT PNS </label> <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('tmt_pns') is-invalid @enderror" name="tmt_pns" value="{{ $result_profilpegawai->tmt_pns }}">
                                                    @error('tmt_pns')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Seri Kartu Pegawai </label> <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('no_seri_karpeg') is-invalid @enderror" name="no_seri_karpeg" value="{{ $result_profilpegawai->no_seri_karpeg }}">
                                                    @error('no_seri_karpeg')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>TMT CPNS </label> <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('tmt_cpns') is-invalid @enderror" name="tmt_cpns" value="{{ $result_profilpegawai->tmt_cpns }}">
                                                    @error('tmt_cpns')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tingkat Pendidikan <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect @error('tingkat_pendidikan') is-invalid @enderror" name="tingkat_pendidikan" style="width: 100% !important">
                                                        <option value="" disabled selected>-- Pilih Tingkat Pendidikan --</option>
                                                        @foreach ($tingkatpendidikanOptions as $optionValue => $namaTingkatPendidikan)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->tingkat_pendidikan) selected @endif>
                                                                {{ $namaTingkatPendidikan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tingkat_pendidikan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pendidikan Terakhir </label> <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" style="width: 100% !important">
                                                        <option selected disabled>-- Pilih Pendidikan Terakhir --</option>
                                                        @foreach($pendidikanterakhirOptions as $id => $namaPendidikanTerakhir)
                                                            <option value="{{ $id }}" {{ $id == $result_profilpegawai->pendidikan_terakhir ? 'selected' : '' }}>{{ $namaPendidikanTerakhir }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pendidikan_terakhir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ruangan <span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="theSelect @error('ruangan') is-invalid @enderror" name="ruangan" style="width: 100% !important">
                                                        <option value="" disabled selected>-- Pilih Ruangan --</option>
                                                        @foreach ($ruanganOptions as $optionValue => $namaRuangan)
                                                            <option value="{{ $optionValue }}" @if ($optionValue == $result_profilpegawai->ruangan) selected @endif>
                                                                {{ $namaRuangan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('ruangan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
                                                        <input type="hidden" class="form-control" id="e_user_id" name="user_id" value="{{ $result_posisijabatan->user_id }}">
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
                                                                <select class="theSelect @error('jenis_jabatan') is-invalid @enderror" name="jenis_jabatan" style="width: 100% !important">
                                                                    <option selected disabled>-- Pilih Jenis Jabatan --</option>
                                                                    @foreach ($jenisjabatanOptions as $optionValue => $jenisJabatan)
                                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_posisijabatan->jenis_jabatan) selected @endif>{{ $jenisJabatan }}</option>
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
                                                                <small class="text-danger">*Jika bukan eselon dapat diisi tanda ( - )</small>
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
                                                                <select class="theSelect @error('gol_ruang_awal') is-invalid @enderror" name="gol_ruang_awal" style="width: 100% !important">
                                                                    <option selected disabled>-- Pilih Golongan Ruang Awal --</option>
                                                                    @foreach ($golonganOptions as $optionValue => $golAwal)
                                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_posisijabatan->gol_ruang_awal) selected @endif>{{ $golAwal }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Golongan Ruang Akhir</label>
                                                                <br>
                                                                <select class="theSelect @error('gol_ruang_akhir') is-invalid @enderror" name="gol_ruang_akhir" style="width: 100% !important">
                                                                    <option selected disabled>-- Pilih Golongan Ruang Akhir --</option>
                                                                    @foreach ($golonganOptions as $optionValue => $golAkhir)
                                                                        <option value="{{ $optionValue }}" @if ($optionValue == $result_posisijabatan->gol_ruang_akhir) selected @endif>{{ $golAkhir }}</option>
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
                                                <button type="submit" class="btn btn-primary submit-btn">Perbaharui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Posisi Jabatan Modal Edit -->

                        <!-- Upload Dokumen KTP Modal -->
                        <div id="unggah_dokumen_ktp" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Dokumen KTP</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user/profile/upload-ktp') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $result_profilpegawai->user_id }}">
                                                <div class="row">
                                                    <div class="dropzone-box-1" style="max-width: 50rem !important">
                                                        <label>File Dokumen KTP</label>
                                                        <div class="dropzone-area-1" style="min-height: 15rem !important">
                                                            <div class="file-upload-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" style="height: 4rem !important; width: 6rem !important;" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                                            </div>
                                                            <p class="info-pesan-form" style="font-size: 1rem !important">Klik untuk mengunggah atau seret dan lepas</p>
                                                            <input type="file" id="dokumen_ktp" name="dokumen_ktp">
                                                            <input type="hidden" name="hidden_dokumen_ktp" id="e_dokumen_ktp" value="">
                                                            <p class="info-draganddrop-1" style="font-size: 1rem !important">Tidak ada file yang di pilih</p>
                                                        </div>
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button type="submit" id="submit-button" class="btn btn-primary submit-btn">Unggah</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upload Dokumen KTP Modal -->

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
                    unit_organisasi: 'Bidang unit organisasi wajib diisi.',
                    unit_organisasi_induk: 'Bidang unit organisasi induk wajib diisi.',
                    jenis_jabatan: 'Bidang jenis jabatan wajib diisi.',
                    eselon: 'Bidang eselon wajib diisi.',
                    jabatan: 'Bidang jabatan wajib diisi.',
                    tmt: 'Bidang tmt wajib diisi.',
                    lokasi_kerja: 'Bidang lokasi kerja wajib diisi.',
                    gol_ruang_awal: 'Bidang golongan ruang awal wajib diisi.',
                    gol_ruang_akhir: 'Bidang golongan ruang akhir wajib diisi.',
                    tmt_golongan: 'Bidang tmt golongan wajib diisi.',
                    gaji_pokok: 'Bidang gaji pokok wajib diisi.',
                    masa_kerja_tahun: 'Bidang masa kerja tahun wajib diisi.',
                    masa_kerja_bulan: 'Bidang masa kerja bulan wajib diisi.',
                    no_spmt: 'Bidang nomor spmt wajib diisi.',
                    tanggal_spmt: 'Bidang tanggal spmt wajib diisi.',
                    kppn: 'Bidang kppn wajib diisi.',
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

        <script>
            $(function () {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                $(function () {
                    $('#provinsi').on('change', function (){
                        let nama_provinsi = $('#provinsi option:selected').text();
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('getkotakabupaten') }}",
                            data : {nama_provinsi: nama_provinsi},
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
                        let nama_kotakabupaten = $('#kotakabupaten option:selected').text();
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('getkecamatan') }}",
                            data : {nama_kotakabupaten: nama_kotakabupaten},
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
                        let nama_kecamatan= $('#kecamatan option:selected').text();
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('getdesakelurahan') }}",
                            data : {nama_kecamatan: nama_kecamatan},
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

        <script src="{{ asset('assets/js/drag-drop-file.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        
        <script>
		$(".theSelect").select2();
	    </script>

        <script>
            @if (Auth::user()->role_name == 'User') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Profil - User | Aplikasi SILK';
            @endif
            @if (Auth::user()->eselon == '3') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Profil - Eselon 3 | Aplikasi SILK';
            @endif
            @if (Auth::user()->eselon == '4') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Profil - Eselon 4 | Aplikasi SILK';
            @endif
        </script>

    @endsection
@endsection
