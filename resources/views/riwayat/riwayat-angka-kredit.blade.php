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
                        <h3 class="page-title"> Riwayat Angka Kredit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Angka Kredit</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_riwayat_angka_kredit"><i
                                class="fa fa-plus"></i> Tambah Riwayat Angka Kredit</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('riwayat/angkakredit/cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="nama_jabatan" name="nama_jabatan">
                                <option selected disabled>-- Pilih Jenis Jabatan --</option>
                                @foreach ($jenisjabatanOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Jenis Jenis Jabatan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nomor_sk" name="nomor_sk">
                            <label class="focus-label">Nomor SK</label>
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
                                @foreach ($riwayatAK as $sqlAK => $result_angka_kredit)
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
        </div>
        <!-- /Page Content -->

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
                                        <input type="hidden" class="form-control" name="user_id"
                                            value="{{ Auth::user()->user_id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Jabatan</label>
                                        <small class="text-danger">*</small>
                                        <br>
                                        <select class="theSelect" name="nama_jabatan" required>
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
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nomor_sk" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_sk" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-left: 15px;">
                                    <label>Angka Kredit Pertama</label><br>
                                    <input type="checkbox" class="riwayat-angka-kredit" name="angka_kredit_pertama" value="Angka Kredit Pertama"> Angka Kredit Pertama
                                </div>
                                <div class="form-group" style="margin-left: 20px;">
                                    <label>Integrasi</label><br>
                                    <input type="checkbox" class="riwayat-angka-kredit" name="integrasi" value="Integrasi"> Integrasi
                                </div>
                                <div class="form-group" style="margin-left: 20px;">
                                    <label>Konversi</label><br>
                                    <input type="checkbox" class="riwayat-angka-kredit" name="konversi" value="Konversi"> Konversi
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bulan Mulai Penilaian</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="bulan_mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Mulai Penilaian</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="number" name="tahun_mulai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bulan Selesai Penilaian</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="bulan_selesai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Selesai Penilaian</label>
                                        <small class="text-danger">*</small>
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
                                        <label>Total Angka Kredit</label>
                                        <small class="text-danger">*</small>
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
        <!-- /Tambah Riwayat Angka Kredit Modal -->

        <!-- Edit Riwayat Angka Kredit Modal -->
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
                        <form action="{{ route('riwayat/angkakredit/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Jabatan</label>
                                        <small class="text-danger">*</small>
                                        <br>
                                        <select class="theSelect" name="nama_jabatan" id="e_nama_jabatan" required>
                                            <option selected disabled> --Pilih Nama Jabatan --</option>
                                            @foreach ($jenisjabatanOptions as $key => $value)
                                                @if (!empty($result_angka_kredit->nama_jabatan))
                                                    <option value="{{ $key }}" {{ $key == $result_angka_kredit->nama_jabatan ? 'selected' : '' }}>{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SK</label>
                                        <small class="text-danger">*</small>
                                        <input type="text" class="form-control" name="nomor_sk" id="e_nomor_sk" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal SK</label>
                                        <small class="text-danger">*</small>
                                        <input type="date" class="form-control" name="tanggal_sk" id="e_tanggal_sk" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-left: 15px;">
                                    <label>Angka Kredit Pertama</label><br>
                                    <input type="checkbox" class="riwayat-angka-kredit" name="angka_kredit_pertama" id="e_angka_kredit_pertama" value="Angka Kredit Pertama"> Angka Kredit Pertama
                                </div>
                                <div class="form-group" style="margin-left: 20px;">
                                    <label>Integrasi</label><br>
                                    <input type="checkbox" class="riwayat-angka-kredit" name="integrasi" id="e_integrasi" value="Integrasi"> Integrasi
                                </div>
                                <div class="form-group" style="margin-left: 20px;">
                                    <label>Konversi</label><br>
                                    <input type="checkbox" class="riwayat-angka-kredit" name="konversi" id="e_konversi" value="Konversi"> Konversi
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bulan Mulai Penilaian</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="bulan_mulai" id="e_bulan_mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Mulai Penilaian</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="number" name="tahun_mulai" id="e_tahun_mulai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bulan Selesai Penilaian</label>
                                        <small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="bulan_selesai" id="e_bulan_selesai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Selesai Penilaian</label>
                                        <small class="text-danger">*</small>
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
                                        <label>Total Angka Kredit</label>
                                        <small class="text-danger">*</small>
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
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_pmk" class="d_dokumen_pmk" value="">
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
        <!-- End Delete Riwayat Angka Kredit Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/angkakredit.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/riwayat/angka/kredit');
        </script>

    @endsection
@endsection
