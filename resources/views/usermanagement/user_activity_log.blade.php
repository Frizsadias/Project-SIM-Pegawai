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
                        <h3 class="page-title">Riwayat Aktivitas</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Aktivitas</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- /Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="tableRiwayatAktivitas" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Peran</th>
                                    <th>Deskripsi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>

    @section('script')
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableRiwayatAktivitas').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get-riwayat-aktivitas') }}",
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
                            "data": "user_name"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "role_name"
                        },
                        {
                            "data": "modify_user"
                        },
                        {
                            "data": "date_time",
                            "render": function (data, type, row) {
                                var formattedDateTime = moment(data).locale('id').format('dddd, D MMMM YYYY || hh:mm A');
                                return '<td>' + formattedDateTime + '</td>';
                            }
                        },
                    ],
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "zeroRecords": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
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
        </script>

        <script src="{{ asset('assets/js/atur-tanggal-indo.js') }}"></script>
        
        <script>
            document.getElementById('pageTitle').innerHTML = 'Manajemen Riwayat Aktivitas - Admin | Aplikasi SILK';
        </script>

    @endsection
@endsection