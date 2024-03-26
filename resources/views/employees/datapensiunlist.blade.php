@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-lists-center">
                    <div class="col">
                        <h3 class="page-title">Pegawai Pensiun</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="view-icons">
                            <a href="{{ route('daftar/pegawai/pensiun/card') }}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                            <a href="{{ route('daftar/pegawai/pensiun/list') }}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Fitur Pencarian -->
            {{-- <form action="{{ route('daftar/pegawai/pensiun/list/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="nip">
                            <label class="focus-label">NIP</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name">
                            <label class="focus-label">Nama Pegawai</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="email">
                            <label class="focus-label">E-mail</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Cari </button>
                    </div>
                </div>
            </form> --}}
            <!-- /Fitur Pencarian -->

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="tablePegawaiPensiunData" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Nomor HP</th>
                                    <th>Ruang</th>
                                    <th>Kedudukan</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
    
    @section('script')
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tablePegawaiPensiunData').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get-pegawai-pensiun-data') }}",
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
                            "data": "nip"
                        },
                        {
                            "data": "name",
                        },
                        {
                            "data": "jabatan"
                        },
                        {
                            "data": "pendidikan_terakhir"
                        },
                        {
                            "data": "no_hp",
                        },
                        {
                            "data": "ruangan"
                        },
                        {
                            "data": "kedudukan_pns"
                        },
                        {
                            "data": "user_id",
                        },
                    ],
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "zeroRecords": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "Cari:",
                        "searchPlaceholder": "NIP dan Nama Pegawai",
                        "paginate": {
                            "previous": "Previous",
                            "next": "Next",
                            "first": "<i class='fa-solid fa-backward-fast'></i>",
                            "last": "<i class='fa-solid fa-forward-fast'></i>",
                        }
                    },
                    "order": [
                        [0, "asc"]
                    ]
                });

                $('#search-form').on('submit', function(e) {
                    e.preventDefault();
                    table
                        .search($('#keyword').val())
                        .draw();
                });
            });
        </script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Manajemen Data Pegawai Pensiun - Admin | Aplikasi SILK';
        </script>

        <script>
            history.pushState({}, "", '/daftar/pegawai/pensiun/list');
        </script>

        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>

    @endsection
@endsection