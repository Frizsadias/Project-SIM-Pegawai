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

        <!-- Cetak Dokumen KGB PDF -->
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <select id="pilihDokumenKGB" class="form-control">
                    <option selected disabled> --Pilih Dokumen KBG --</option>
                    @foreach ($data_kgb_pdf as $kgb)
                        <option value="{{ $kgb->id }}">Dokumen KBG - {{ $kgb->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <button id="cetakDokumenKBG" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i>
                    Dokumen KBG</button>
            </div>
        </div><br>

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

        <!-- Tampilkan hasil pencarian atau data KGB di sini -->


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
                    <form action="{{ route('layanan/kgb/tambah-data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Pegawai</label>
                                    <select class="select" id="name" name="name">
                                        <option value="">-- Pilih Nama Pegawai --</option>
                                        @foreach ($userList as $key => $user)
                                            <option value="{{ $user->name }}" data-user_id={{ $user->user_id }}
                                                data-nip={{ $user->nip }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">ID Pengguna <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_id" name="user_id"
                                        placeholder="ID pengguna otomatis terisi" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">NIP <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="nip" name="nip"
                                        placeholder="NIP otomatis terisi" readonly>
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
                                    <input type="text" class="form-control" name="no_sk_kgb"
                                        placeholder="Nomor SK KGB">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berlaku</label>
                                    <input type="date" class="form-control" name="tgl_berlaku">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Masa Kerja Golongan</label>
                                    <input type="text" class="form-control" name="masa_kerja_golongan"
                                        placeholder="Masa Kerja Golongan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Masa Kerja</label>
                                    <input type="text" class="form-control" name="masa_kerja"
                                        placeholder="Masa Kerja">
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
    <script>
        $(document).ready(function() {
            $('#pilihDokumenKGB').select2();
            $('#cetakDokumenKBG').on('click', function() {
                const selectedKGBId = $('#pilihDokumenKGB').val();
                if (selectedKGBId) {
                    const url =
                        "{{ route('layanan-kenaikan-gaji-berkala-admin', ['id' => ':id']) }}"
                        .replace(':id', selectedKGBId);
                    window.open(url, '_blank');
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
		$(".theSelect").select2();
	    </script>

    <script src="{{ asset('assets/js/layanankgb.js') }}"></script>
@endsection
@endsection
