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
                                            <img alt="" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ Session::get('name') }}</h3>
                                                <h6 class="text-muted">{{ Session::get('department') }}</h6>
                                                <small class="text-muted">{{ Session::get('position') }}</small>
                                                <div class="staff-id">ID Pegawai : {{ Session::get('user_id') }}</div>
                                                <div class="small doj text-muted">Tanggal Bergabung :
                                                    {{ \Carbon\Carbon::parse(Session::get('join_date'))->locale('id')->format('d F Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">E-mail :</div>
                                                    <div class="text">
                                                        <a href="mailto:{{ Session::get('email') }}">{{ Session::get('email') }}</a>
                                                    </div>
                                                </li>
                                                @if (!empty($information))
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Tanggal Lahir :</div>
                                                            <div class="text">
                                                                {{ date('d F Y', strtotime($information->tgl_lahir)) }}
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
                                    <h3 class="card-title">Profil Pegawai <a href="#" class="edit-icon"
                                            data-toggle="modal" data-target="#profil_pegawai_modal"><i
                                                class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <!-- Ditarik untuk fitur edit -->
                                        <input type="hidden" class="form-control" id="name" name="name"
                                            value="{{ Auth::user()->name }}">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                                            value="{{ Auth::user()->user_id }}">
                                        <input type="hidden" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}">
                                        <li>
                                            <div class="title">NIP</div>
                                            @if (!empty($profilPegawai->nip))
                                                <div class="text">{{ $profilPegawai->nip }}</div>
                                            @else
                                                <div class="text">NIP</div>
                                            @endif
                                        </li>
                                        {{-- <li>
                                            <div class="title">Nama</div>
                                            @if (!empty($profilPegawai->name))
                                                <div class="text">{{ $profilPegawai->name }}</div>
                                            @else
                                                <div class="text">Nama</div>
                                            @endif
                                        </li> --}}
                                        <li>
                                            <div class="title">Gelar Depan</div>
                                            @if (!empty($profilPegawai->gelar_depan))
                                                <div class="text">{{ $profilPegawai->gelar_depan }}</div>
                                            @else
                                                <div class="text">Gelar Belakang</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gelar Belakang</div>
                                            @if (!empty($profilPegawai->gelar_belakang))
                                                <div class="text">{{ $profilPegawai->gelar_belakang }}</div>
                                            @else
                                                <div class="text">Gelar Belakang</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tempat Lahir</div>
                                            @if (!empty($profilPegawai->tempat_lahir))
                                                <div class="text">{{ $profilPegawai->tempat_lahir }}</div>
                                            @else
                                                <div class="text">Tempat Lahir</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal Lahir</div>
                                            @if (!empty($profilPegawai->tgl_lahir))
                                                <div class="text">{{ $profilPegawai->tgl_lahir }}</div>
                                            @else
                                                <div class="text">Tanggal Lahir</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Kelamin</div>
                                            @if (!empty($profilPegawai->jk))
                                                <div class="text">{{ $profilPegawai->jk }}</div>
                                            @else
                                                <div class="text">Jenis Kelamin</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Agama</div>
                                            @if (!empty($profilPegawai->agama))
                                                <div class="text">{{ $profilPegawai->agama }}</div>
                                            @else
                                                <div class="text">Agama</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">E-mail</div>
                                            @if (!empty($profilPegawai->email))
                                                <div class="text">{{ $profilPegawai->email }}</div>
                                            @else
                                                <div class="text">E-mail</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Dokumen</div>
                                            @if (!empty($profilPegawai->jenis_kelamin))
                                                <div class="text">{{ $profilPegawai->jenis_dokumen }}</div>
                                            @else
                                                <div class="text">Jenis Dokumen</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Dokumen</div>
                                            @if (!empty($profilPegawai->no_dokumen))
                                                <div class="text">{{ $profilPegawai->no_dokumen }}</div>
                                            @else
                                                <div class="text">Nomor Dokumen</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kelurahan</div>
                                            @if (!empty($profilPegawai->kelurahan))
                                                <div class="text">{{ $profilPegawai->kelurahan }}</div>
                                            @else
                                                <div class="text">Kelurahan</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kecamatan</div>
                                            @if (!empty($profilPegawai->kecamatan))
                                                <div class="text">{{ $profilPegawai->kecamatan }}</div>
                                            @else
                                                <div class="text">Kecamatan</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kota</div>
                                            @if (!empty($profilPegawai->kota))
                                                <div class="text">{{ $profilPegawai->kota }}</div>
                                            @else
                                                <div class="text">Kota</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Provinsi</div>
                                            @if (!empty($profilPegawai->provinsi))
                                                <div class="text">{{ $profilPegawai->provinsi }}</div>
                                            @else
                                                <div class="text">Provinsi</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kode Pos</div>
                                            @if (!empty($profilPegawai->kode_pos))
                                                <div class="text">{{ $profilPegawai->kode_pos }}</div>
                                            @else
                                                <div class="text">Kode Pos</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor HP</div>
                                            @if (!empty($profilPegawai->no_hp))
                                                <div class="text">{{ $profilPegawai->no_hp }}</div>
                                            @else
                                                <div class="text">Nomor HP</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Nomor Telepon</div>
                                            @if (!empty($profilPegawai->no_telp))
                                                <div class="text">{{ $profilPegawai->no_telp }}</div>
                                            @else
                                                <div class="text">Nomor Telepon</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Pegawai</div>
                                            @if (!empty($profilPegawai->jenis_pegawai))
                                                <div class="text">{{ $profilPegawai->jenis_pegawai }}</div>
                                            @else
                                                <div class="text">Jenis Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Kedudukan PNS</div>
                                            @if (!empty($profilPegawai->kedudukan_pns))
                                                <div class="text">{{ $profilPegawai->kedudukan_pns }}</div>
                                            @else
                                                <div class="text">Kedudukan PNS</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Status Pegawai</div>
                                            @if (!empty($profilPegawai->status_pegawai))
                                                <div class="text">{{ $profilPegawai->status_pegawai }}</div>
                                            @else
                                                <div class="text">Status Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT PNS</div>
                                            @if (!empty($profilPegawai->tmt_pns))
                                                <div class="text">{{ $profilPegawai->tmt_pns }}</div>
                                            @else
                                                <div class="text">TMT PNS</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No. Seri Kartu Pegawai</div>
                                            @if (!empty($profilPegawai->no_seri_karpeg))
                                                <div class="text">{{ $profilPegawai->no_seri_karpeg }}</div>
                                            @else
                                                <div class="text">No. Seri Kartu Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT CPNS</div>
                                            @if (!empty($profilPegawai->tmt_cpns))
                                                <div class="text">{{ $profilPegawai->tmt_cpns }}</div>
                                            @else
                                                <div class="text">TMT CPNS</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tingkat Pendidikan</div>
                                            @if (!empty($profilPegawai->tingkat_pendidikan))
                                                <div class="text">{{ $profilPegawai->tingkat_pegawai }}</div>
                                            @else
                                                <div class="text">Tingkat Pegawai</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Pendidikan Terakhir</div>
                                            @if (!empty($profilPegawai->pendidikan_terakhir))
                                                <div class="text">{{ $profilPegawai->pendidikan_terakhir }}</div>
                                            @else
                                                <div class="text">Pendidikan Terakhir</div>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama <span class="text-danger">*</span></label>
                                                        <input class="form-control @error('nama') is-invalid @enderror"
                                                            type="text" name="nama" value="">
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gelar Depan <span class="text-danger">*</span></label>
                                                        <input
                                                            class="form-control @error('gelar_depan') is-invalid @enderror"
                                                            type="text" name="gelar_depan" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gelar Belakang <span class="text-danger">*</span></label>
                                                        <input
                                                            class="form-control @error('gelar_belakang') is-invalid @enderror"
                                                            type="text" name="gelar_belakang" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <input
                                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                                type="text" name="tempat_lahir" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <input
                                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
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
                                                        <input
                                                            class="form-control @error('jenis_dokumen') is-invalid @enderror"
                                                            type="text" name="jenis_dokumen" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Dokumen </label>
                                                        <input
                                                            class="form-control @error('no_dokumen') is-invalid @enderror"
                                                            type="number" name="no_dokumen" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Kelurahan </label>
                                                        <input
                                                            class="form-control @error('kelurahan') is-invalid @enderror"
                                                            type="text" name="kelurahan" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Kecamatan </label>
                                                        <input
                                                            class="form-control @error('kecamatan') is-invalid @enderror"
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
                                                        <input
                                                            class="form-control @error('provinsi') is-invalid @enderror"
                                                            type="text" name="provinsi" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Kode Pos </label>
                                                        <input
                                                            class="form-control @error('kode_pos') is-invalid @enderror"
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
                                                        <input
                                                            class="form-control @error('jenis_pegawai') is-invalid @enderror"
                                                            type="text" name="jenis_pegawai" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Kedudukan PNS </label>
                                                        <input
                                                            class="form-control @error('kedudukan_pns') is-invalid @enderror"
                                                            type="text" name="kedudukan_pns" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status Pegawai </label>
                                                        <input
                                                            class="form-control @error('status_pegawai') is-invalid @enderror"
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
                                                        <input
                                                            class="form-control @error('no_seri_karpeg') is-invalid @enderror"
                                                            type="number" name="no_seri_karpeg" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>TMT CPNS </label>
                                                        <input
                                                            class="form-control @error('tmt_cpns') is-invalid @enderror"
                                                            type="text" name="tmt_cpns" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tingkat Pendidikan </label>
                                                        <input
                                                            class="form-control @error('tingkat_pendidikan') is-invalid @enderror"
                                                            type="text" name="tingkat_pendidikan" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir </label>
                                                        <input
                                                            class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
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
                        <!-- /Profil Pegawai Modal -->
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Posisi & Jabatan Pegawai <a href="#" class="edit-icon"
                                            data-toggle="modal" data-target="#posisi_jabatan_modal"><i
                                                class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <!-- Ditarik untuk fitur edit -->
                                        <input type="hidden" class="form-control" id="name" name="name"
                                            value="{{ Auth::user()->name }}">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                                            value="{{ Auth::user()->user_id }}">
                                        <input type="hidden" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}">
                                        <li>
                                            <div class="title">Unit Organisasi</div>
                                            @if (!empty($posisiJabatan->name_primary))
                                                <div class="text">{{ $posisiJabatan->name_primary }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Unit Organisasi Induk</div>
                                            @if (!empty($posisiJabatan->relationship_primary))
                                                <div class="text">{{ $posisiJabatan->relationship_primary }}</div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jenis Jabatan </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Eselon </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Jabatan </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Lokasi Kerja </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Golongan Ruang Awal </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Golongan Ruang Akhir </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">TMT Golongan </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Gaji Pokok </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Tahun) </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Masa Kerja (Bulan) </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">No SPMT </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Tanggal SPMT </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
                                            @else
                                                <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">KPPN </div>
                                            @if (!empty($posisiJabatan->phone_primary) && !empty($posisiJabatan->phone_2_primary))
                                                <div class="text">
                                                    {{ $posisiJabatan->phone_primary }},{{ $posisiJabatan->phone_2_primary }}
                                                </div>
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
                            <div class="tab-pane fade" id="riwayat_pendidikan">    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped custom-table mb-0 datatable">
                                                <thead>
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
                                                    @foreach ($riwayatPendidikan as $sqlpendidikan => $result_pendidikan)
                                    <tr>
                                        <td><center>{{ ++$sqlpendidikan }}</center></td>
                                        <td hidden class="user_id"><center>{{ $result_pendidikan->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $result_pendidikan->id }}</center></td>
                                        <td class="tingkat_pendidikan"><center>{{ $result_pendidikan->tingkat_pendidikan }}</center></td>
                                        <td class="pendidikan"><center>{{ $result_pendidikan->pendidikan }}</center></td>
                                        <td class="tahun_lulus"><center>{{ $result_pendidikan->tahun_lulus }}</center></td>
                                        <td class="no_ijazah"><center>{{ $result_pendidikan->no_ijazah }}</center></td>
                                        <td class="nama_sekolah"><center>{{ $result_pendidikan->nama_sekolah }}</center></td>
                                        <td class="gelar_depan"><center>{{ $result_pendidikan->gelar_depan }}</center></td>
                                        <td class="gelar_belakang"><center>{{ $result_pendidikan->gelar_belakang }}</center></td>
                                        <td class="jenis_pendidikan"><center>{{ $result_pendidikan->jenis_pendidikan }}</center></td>
                                        <td class="dokumen_transkrip">
                                            <center><a href="{{ asset('assets/DokumenTranskrip/' . $result_pendidikan->dokumen_transkrip) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_ijazah">
                                            <center><a href="{{ asset('assets/DokumenIjazah/' . $result_pendidikan->dokumen_ijazah) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_gelar">
                                            <center><a href="{{ asset('assets/DokumenGelar/' . $result_pendidikan->dokumen_gelar) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>


                                        {{-- Edit dan Hapus data  --}}
                                        {{-- <td class="text-right">
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
                                        </td> --}}
                                    </tr>
                                @endforeach
                                                </tbody>
                    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tempat Field Edit & Hapus -->
                            </div>

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
                                                    <th class="tmt_golongan">TMT Golongan</th>
                                                    <th class="no_teknis_bkn">No Teknis BKN</th>
                                                    <th class="tanggal_teknis_bkn">Tanggal Teknis BKN</th>
                                                    <th class="no_sk_golongan">No SK</th>
                                                    <th class="tanggal_sk">Tanggal SK</th>
                                                    <th class="dokumen_skkp">Dokumen SK KP</th>
                                                    <th class="dokumen_teknis_kp">Dokumen Teknis KP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatGolongan as $sqlgolongan => $result_golongan)
                                    <tr>
                                        <td><center>{{ ++$sqlgolongan }}</center></td>
                                        <td hidden class="user_id"><center>{{ $result_golongan->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $result_golongan->id }}</center></td>
                                        <td class="golongan"><center>{{ $result_golongan->golongan }}</center></td>
                                        <td class="jenis_kenaikan_pangkat"><center>{{ $result_golongan->jenis_kenaikan_pangkat }}</center></td>
                                        <td class="masa_kerja_golongan_tahun"><center>{{ $result_golongan->masa_kerja_golongan_tahun }}</center></td>
                                        <td class="masa_kerja_golongan_bulan"><center>{{ $result_golongan->masa_kerja_golongan_bulan }}</center></td>
                                        <td class="tmt_golongan"><center>{{ \Carbon\Carbon::parse($result_golongan->tmt_golongan)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="no_teknis_bkn"><center>{{ $result_golongan->no_teknis_bkn }}</center></td>
                                        <td class="tanggal_teknis_bkn"><center>{{ \Carbon\Carbon::parse($result_golongan->tanggal_teknis_bkn)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="no_sk_golongan"><center>{{ $result_golongan->no_sk_golongan }}</center></td>
                                        <td class="tanggal_sk"><center>{{ \Carbon\Carbon::parse($result_golongan->tanggal_sk)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="dokumen_skkp">
                                            <center><a href="{{ asset('assets/DokumenSKKP/' . $result_golongan->dokumen_skkp) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_teknis_kp">
                                            <center><a href="{{ asset('assets/DokumenTeknisKP/' . $result_golongan->dokumen_teknis_kp) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        {{-- <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_riwayat_golongan" href="#"
                                                        data-toggle="modal" data-target="#edit_riwayat_golongan"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_riwayat_golongan" href="#"
                                                        data-toggle="modal" data-target="#delete_riwayat_golongan"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Tempat Field Edit & Hapus -->
                        </div>

                    <div class="tab-pane fade" id="riwayat_jabatan">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
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
                                            @foreach ($riwayatJabatan as $sqljabatan => $result_jabatan)
                                    <tr>
                                        <td><center>{{ ++$sqljabatan }}</center></td>
                                        <td hidden class="user_id"><center>{{ $result_jabatan->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $result_jabatan->id }}</center></td>
                                        <td class="jenis_jabatan"><center>{{ $result_jabatan->jenis_jabatan }}</center></td>
                                        <td class="satuan_kerja"><center>{{ $result_jabatan->satuan_kerja }}</center></td>
                                        <td class="satuan_kerja_induk"><center>{{ $result_jabatan->satuan_kerja_induk }}</center></td>
                                        <td class="unit_organisasi"><center>{{ $result_jabatan->unit_organisasi }}</center></td>
                                        <td class="no_sk"><center>{{ $result_jabatan->no_sk }}</center></td>
                                        <td class="tanggal_sk"><center>{{ \Carbon\Carbon::parse($result_jabatan->tanggal_sk)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="tmt_jabatan"><center>{{ \Carbon\Carbon::parse($result_jabatan->tmt_jabatan)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="tmt_pelantikan"><center>{{ \Carbon\Carbon::parse($result_jabatan->tmt_pelantikan)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="dokumen_sk_jabatan">
                                            <center><a href="{{ asset('assets/DokumenSKJabatan/' . $result_jabatan->dokumen_sk_jabatan) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        <td class="dokumen_pelantikan">
                                            <center><a href="{{ asset('assets/DokumenPelantikan/' . $result_jabatan->dokumen_pelantikan) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        {{-- <td class="text-right">
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
                                        </td> --}}
                                    </tr>
                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Tempat Field Edit & Hapus -->
                    </div>

                {{-- DIKLAT --}}
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
                                        <td hidden class="user_id"><center>{{ $result_diklat->user_id }}</center></td>
                                        <td hidden class="id"><center>{{ $result_diklat->id }}</center></td>
                                        <td class="jenis_diklat"><center>{{ $result_diklat->jenis_diklat }}</center></td>
                                        <td class="nama_diklat"><center>{{ $result_diklat->nama_diklat }}</center></td>
                                        <td class="institusi_penyelenggara"><center>{{ $result_diklat->institusi_penyelenggara }}</center></td>
                                        <td class="no_sertifikat"><center>{{ $result_diklat->no_sertifikat }}</center></td>
                                        <td class="tanggal_mulai"><center>{{ \Carbon\Carbon::parse($result_diklat->tanggal_mulai)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="tanggal_selesai"><center>{{ \Carbon\Carbon::parse($result_diklat->tanggal_selesai)->formatLocalized('%d %B %Y') }}</center></td>
                                        <td class="tahun_diklat"><center>{{ $result_diklat->tahun_diklat }}</center></td>
                                        <td class="durasi_jam"><center>{{ $result_diklat->durasi_jam }}</center></td>
                                        <td class="dokumen_diklat">
                                            <center><a href="{{ asset('assets/DokumenDiklat/' . $result_diklat->dokumen_diklat) }}"
                                                target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i></a>
                                        </center></td>
                                        

                                        {{-- Edit dan Hapus data  --}}
                                        {{-- <td class="text-right">
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
                                        </td> --}}
                                    </tr>
                                @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Tempat Field Edit & Hapus -->
                </div>
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
                            <form action="{{ route('profile/information/save') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block"
                                                src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}"
                                                alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="image" name="images">
                                                <input type="hidden" name="hidden_image" id="e_image"
                                                    value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name"
                                                        name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id"
                                                        name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email"
                                                        name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            id="birthDate" name="birthDate"
                                                            value="{{ $information->tgl_lahir }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control" id="alamat"
                                                        name="alamat" value="{{ $information->alamat }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="select form-control" id="jk" name="jk">
                                                        <option value="{{ $information->jk }}"
                                                            {{ $information->jk == $information->jk ? 'selected' : '' }}>
                                                            {{ $information->jk }} </option>
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
                            <form action="{{ route('profile/information/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" id="upload" name="upload">
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
