@extends('layouts.master')
@section('content')
@section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/abea6a9d41.js" crossorigin="anonymous"></script>
    <!-- checkbox style -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
@endsection
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Kenaikan Gaji Berkala</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kenaikan Gaji Berkala</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_layanan_kgb"><i
                            class="fa fa-plus"></i> Tambah Kenaikan Gaji Berkala</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form action="{{ route('layanan/kenaikan/gaji/berkala/admin/cari') }}" method="GET" id="search-form">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="name">
                        <label class="focus-label">Nama Pegawai</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="nip">
                        <label class="focus-label">NIP</label>
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
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Golongan Awal</th>
                                <th>Golongan Akhir</th>
                                <th>Gaji Pokok Lama</th>
                                <th>Gaji Pokok Akhir</th>
                                <th>Tanggal SK Kenaikan Gaji Berkala</th>
                                <th>Nomor SK Kenaikan Gaji Berkala</th>
                                <th>Tanggal Berlaku</th>
                                <th>Masa Kerja Golongan</th>
                                <th>Masa Kerja</th>
                                <th>Terhitung Mulai Tanggal Kenaikan Gaji Berkala</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_kgb as $sqlkgb => $result_kgb)
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

                                    {{-- Edit Layanan KGB --}}
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_layanan_kgb" href="#"
                                                    data-toggle="modal" data-target="#edit_layanan_kgb"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a href="{{ route('layanan-kenaikan-gaji-berkala-admin', ['id' => $result_kgb->id]) }}"
                                                    target="_blank" class="dropdown-item cetak-kinerja">
                                                    <i class="fa fa-print m-r-5"></i>Cetak
                                                </a>
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

    <!-- Tambah Layanan KGB Modal -->
    <div id="daftar_layanan_kgb" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kenaikan Gaji Berkala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layanan/kgb/tambah-data') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="user_id"
                                        value="{{ Auth::user()->user_id }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @foreach ($data_kgb as $gaji)
                                        <input type="hidden" class="form-control" name="nip"
                                            value="{{ $gaji->nip }}">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @foreach ($data_kgb as $gaji)
                                        <input type="hidden" class="form-control" name="name"
                                            value="{{ $gaji->name }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Golongan Awal</label>
                                    <input type="text" class="form-control" name="golongan_awal"
                                        placeholder="Golongan Awal">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Golongan Akhir</label>
                                    <input type="text" class="form-control" name="golongan_akhir"
                                        placeholder="Golongan Akhir">
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
                            <button class="btn btn-primary submit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- /Tambah Layanan Cuti Modal -->

    <!-- Edit Layanan Cuti Modal -->
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
                    <form action="{{ route('layanan/kgb/edit-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="e_id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Golongan Awal</label>
                                    <input type="text" class="form-control" name="golongan_awal"
                                        id="e_golongan_awal" placeholder="Golongan Awal" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Golongan Akhir</label>
                                    <input type="text" class="form-control" name="golongan_akhir"
                                        id="e_golongan_akhir" placeholder="Golongan Akhir" value="">
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
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Layanan Cuti Modal -->
</div>
<!-- /Page Wrapper -->

@section('script')
    <script src="{{ asset('assets/js/layanankgb.js') }}"></script>

    <script>
        history.pushState({}, "", '/layanan/kenaikan/gaji/berkala');
    </script>
@endsection
@endsection
