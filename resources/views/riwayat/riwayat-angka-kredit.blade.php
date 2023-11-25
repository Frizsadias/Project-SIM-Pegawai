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
            {{-- <form action="{{ route('riwayat/pmk/cari') }}" method="GET" id="search-form">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="form-control" id="jenis_pmk" name="jenis_pmk">
                                <option selected disabled>-- Pilih Jenis Peninjauan Masa Kerja --</option>
                                @foreach ($jenisdiklatOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Jenis Diklat</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nama_diklat" name="nama_diklat">
                            <label class="focus-label">Nama Diklat</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="institusi_penyelenggara" name="institusi_penyelenggara">
                            <label class="focus-label">Iinstitusi Penyelenggara</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form> --}}

            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="tableAngkaKredit">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Jabatan</th>
                                    <th>Nomor SK</th>
                                    <th>Tanggal SK</th>
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
                                        <td hidden class="angka_kredit_pertama"><center>{{ $result_angka_kredit->angka_kredit_pertama }}</center></td>
                                        <td hidden class="integrasi"><center>{{ $result_angka_kredit->integrasi }}</center></td>
                                        <td hidden class="konversi"><center>{{ $result_angka_kredit->konversi }}</center></td>
                                        <td hidden class="bulan_mulai"><center>{{ $result_angka_kredit->bulan_mulai }}</center></td>
                                        <td hidden class="tahun_mulai"><center>{{ $result_angka_kredit->tahun_mulai }}</center></td>
                                        <td hidden class="bulan_selesai"><center>{{ $result_angka_kredit->bulan_selesai }}</center></td>
                                        <td hidden class="tahun_selesai"><center>{{ $result_angka_kredit->tahun_selesai }}</center></td>
                                        <td hidden class="angka_kredit_utama"><center>{{ $result_angka_kredit->angka_kredit_utama }}</center></td>
                                        <td hidden class="angka_kredit_penunjang"><center>{{ $result_angka_kredit->angka_kredit_penunjang }}</center></td>
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

        <!-- Tambah Riwayat PMK Modal -->
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
        <!-- /Tambah Riwayat Diklat Modal -->

        <!-- Edit Riwayat Diklat Modal -->
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
                                            id="e_tanggal_sk" value="">
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
        <!-- /Edit Riwayat Diklat Modal -->

        <!-- Delete Riwayat Diklat Modal -->
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
        <!-- End Delete Riwayat Diklat Modal -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
{{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableAngkaKredit').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get-angkakredit-data') }}",
                        "data": function(d) {
                            d.keyword = $('#keyword').val();
                            d._token = "{{ csrf_token() }}";
                        }
                    },
                    "columns": [
                        {
                            "data": "id"
                        },
                        {
                            "data": "nama_jabatan"
                        },
                        {
                            "data": "nomor_sk"
                        },
                        {
                            "data": "tanggal_sk"
                        },
                        {
                            "data": "angka_kredit_pertama"
                        },
                        {
                            "data": "integrasi"
                        },
                        {
                            "data": "konversi"
                        },
                        {
                            "data": "bulan_mulai"
                        },
                        {
                            "data": "tahun_mulai"
                        },
                        {
                            "data": "bulan_selesai"
                        },
                        {
                            "data": "tahun_selesai"
                        },
                        {
                            "data": "angka_kredit_utama"
                        },
                        {
                            "data": "angka_kredit_penunjang"
                        },
                        {
                            "data": "total_angka_kredit"
                        },
                        {
                            "data": "action"
                        },
                    ],
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Tidak ada data",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "Cari:",
                        "paginate": {
                            "previous": "Previous",
                            "next": "Next",
                            "first": "<<",
                            "last": ">>",
                        }
                    },
                    "order": [
                        [0, "asc"]
                    ]
                });

                // Live search
                $('#search-form').on('submit', function(e) {
                    e.preventDefault();
                    table
                        .search($('#keyword').val())
                        .draw();
                })
            });
        </script> --}}
    {{-- update --}}
    <script>
        $(document).on('click', '.edit_riwayat_angka_kredit', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_nomor_sk').val(_this.find('.nomor_sk').text());
            $('#e_tanggal_sk').val(_this.find('.tanggal_sk').text());
            $('#e_angka_kredit_pertama').prop('checked', _this.find('.angka_kredit_pertama').text() === 'Angka Kredit Pertama');
            $('#e_integrasi').prop('checked', _this.find('.integrasi').text() === 'Integrasi');
            $('#e_konversi').prop('checked', _this.find('.konversi').text() === 'Konversi');
            $('#e_bulan_mulai').val(_this.find('.bulan_mulai').text());
            $('#e_tahun_mulai').val(_this.find('.tahun_mulai').text());
            $('#e_bulan_selesai').val(_this.find('.bulan_selesai').text());
            $('#e_tahun_selesai').val(_this.find('.tahun_selesai').text());
            $('#e_angka_kredit_utama').val(_this.find('.angka_kredit_utama').text());
            $('#e_angka_kredit_penunjang').val(_this.find('.angka_kredit_penunjang').text());
            $('#e_total_angka_kredit').val(_this.find('.total_angka_kredit').text());

            var nama_jabatan = (_this.find(".nama_jabatan").text());
            var _option = '<option selected value="' + nama_jabatan + '">' + _this.find(
                    '.nama_jabatan').text() +
                '</option>'
            $(_option).appendTo("#e_nama_jabatan");
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_riwayat_angka_kredit', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(".theSelect").select2();
    </script>

    <script>
        history.pushState({}, "", '/riwayat/angka/kredit');
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.exclusive').change(function() {
                if ($(this).prop('checked')) {
                    $('.exclusive').not(this).prop('disabled', true);
                } else {
                    $('.exclusive').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
@endsection
