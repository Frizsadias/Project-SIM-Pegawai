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
                        <h3 class="page-title"> Riwayat Tugas Belajar</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Tugas Belajar</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_tugas_belajar"><i
                                class="fa fa-plus"></i> Tambah Riwayat Tugas Belajar</a>
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
                                    <th>Jenis Tugas Belajar</th>
                                    <th>Nama Sekolah</th>
                                    <th>Tingkat Pendidikan</th>
                                    <th>Pendidikan</th>
                                    <th>Predikat Akreditasi Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatTB as $sqlTB => $resultTB)
                                    <tr>
                                        <td><center>{{ ++$sqlTB }}</center></td>
                                        <td hidden class="id"><center>{{ $resultTB->id }}</center></td>
                                        <td class="jenis_tugas_belajar"><center>{{ $resultTB->jenis_tugas_belajar }}</center></td>
                                        <td class="nama_sekolah"><center>{{ $resultTB->nama_sekolah }}</center></td>
                                        <td class="tingkat_pendidikan"><center>{{ $resultTB->tingkat_pendidikan }}</center></td>
                                        <td class="pendidikan"><center>{{ $resultTB->pendidikan }}</center></td>
                                        <td class="predikat_akreditasi_jurusan"><center>{{ $resultTB->predikat_akreditasi_jurusan }}</center></td>
                                        <td hidden class="predikat_akreditasi_jurusan"><center>{{ $resultTB->predikat_akreditasi_jurusan }}</center></td>
                                        <td hidden class="no_akreditasi_jurusan"><center>{{ $resultTB->no_akreditasi_jurusan }}</center></td>
                                        <td hidden class="gelar_depan"><center>{{ $resultTB->gelar_depan }}</center></td>
                                        <td hidden class="gelar_belakang"><center>{{ $resultTB->gelar_belakang }}</center></td>
                                        <td hidden class="tanggal_mulai"><center>{{ $resultTB->tanggal_mulai }}</center></td>
                                        <td hidden class="tanggal_selesai"><center>{{ $resultTB->tanggal_selesai }}</center></td>

                                        {{-- Edit dan Hapus data  --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_tugas_belajar" href="#"
                                                        data-toggle="modal" data-target="#edit_tugas_belajar"><i
                                                            class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_tugas_belajar" href="#"
                                                        data-toggle="modal" data-target="#delete_tugas_belajar"><i
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
        <div id="add_tugas_belajar" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Riwayat Tugas Belajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/tugasbelajar/tambah-data') }}" method="POST"
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
                                        <label>Jenis Tugas Belajar</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="jenis_tugas_belajar" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama_sekolah" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan</label><small class="text-danger">*</small><br>
                                        <select name="tingkat_pendidikan" class="theSelect" id="tingkat_pendidikan" required>
                                            <option selected disabled> --Pilih Tingkat Pendidikan --</option>
                                            @foreach($tingkatpendidikanOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label><small class="text-danger">*</small><br>
                                        <select name="pendidikan" class="theSelect" id="pendidikan" required>
                                            <option selected disabled> --Pilih Pendidikan --</option>
                                            @foreach($pendidikanOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Predikat Akreditasi Jurusan</label><small class="text-danger">*</small>
                                        <select class="form-control" name="predikat_akreditasi_jurusan" required>
                                            <option disabled selected value="">-- Pilih Predikat Akreditasi Jurusan --</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Akreditasi Jurusan</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_akreditasi_jurusan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Depan</label>
                                        <input class="form-control" type="text" name="gelar_depan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input class="form-control" type="text" name="gelar_belakang">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label><small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label><small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_selesai" required>
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
        <div id="edit_tugas_belajar" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Riwayat Tugas Belajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('riwayat/tugasbelajar/edit-data') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Tugas Belajar</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="jenis_tugas_belajar" id="e_jenis_tugas_belajar" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="nama_sekolah" id="e_nama_sekolah" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan</label><small class="text-danger">*</small><br>
                                        <select name="tingkat_pendidikan" id="tingkat_pendidikan" class="form-control" required>
                                            <option selected disabled> --Pilih Tingkat Pendidikan --</option>
                                            @foreach($tingkatpendidikanOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="e_tingkat_pendidikan" id="e_tingkat_pendidikan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label><small class="text-danger">*</small><br>
                                        <select name="pendidikan" id="pendidikan" class="form-control" required>
                                            <option selected disabled> --Pilih Pendidikan --</option>
                                            @foreach($pendidikanOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="e_pendidikan" id="e_pendidikan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Predikat Akreditasi Jurusan</label><small class="text-danger">*</small>
                                        <select class="form-control" name="predikat_akreditasi_jurusan" required>
                                            <option disabled selected value="">-- Pilih Predikat Akreditasi Jurusan --</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                        <input type="hidden" name="e_predikat_akreditasi_jurusan" id="e_predikat_akreditasi_jurusan" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Akreditasi Jurusan</label><small class="text-danger">*</small>
                                        <input class="form-control" type="text" name="no_akreditasi_jurusan" id="e_no_akreditasi_jurusan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Depan</label>
                                        <input class="form-control" type="text" name="gelar_depan" id="e_gelar_depan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar Belakang</label>
                                        <input class="form-control" type="text" name="gelar_belakang" id="e_gelar_belakang">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label><small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_mulai" id="e_tanggal_mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label><small class="text-danger">*</small>
                                        <input class="form-control" type="date" name="tanggal_selesai" id="e_tanggal_selesai" required>
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
        <!-- /Edit Riwayat Diklat Modal -->

        <!-- Delete Riwayat Diklat Modal -->
        <div class="modal custom-modal fade" id="delete_tugas_belajar" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Riwayat Tugas Belajar</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('riwayat/tugasbelajar/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
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
        $(document).on('click', '.edit_tugas_belajar', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_jenis_tugas_belajar').val(_this.find('.jenis_tugas_belajar').text());
            $('#e_nama_sekolah').val(_this.find('.nama_sekolah').text());
            $('#e_tingkat_pendidikan').val(_this.find('.tingkat_pendidikan').text());
            $('#e_pendidikan').val(_this.find('.pendidikan').text());
            $('#e_predikat_akreditasi_jurusan').val(_this.find('.predikat_akreditasi_jurusan').text());
            $('#e_no_akreditasi_jurusan').val(_this.find('.no_akreditasi_jurusan').text());
            $('#e_gelar_depan').val(_this.find('.gelar_depan').text());
            $('#e_gelar_belakang').val(_this.find('.gelar_belakang').text());
            $('#e_tanggal_mulai').val(_this.find('.tanggal_mulai').text());
            $('#e_tanggal_selesai').val(_this.find('.tanggal_selesai').text());
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_tugas_belajar', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(".theSelect").select2();
    </script>

    <script>
        history.pushState({}, "", '/riwayat/tugas/belajar');
    </script>

@endsection
@endsection
