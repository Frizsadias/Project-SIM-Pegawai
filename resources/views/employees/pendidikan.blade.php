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
                        <h3 class="page-title"> Referensi Tabel Pendidikan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pendidikan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_pendidikan"><i class="fa fa-plus"></i> Tambah Pendidikan</a>
                    </div>
                </div>
            </div>

            <!-- Pencaharian Pendidikan -->
            <form action="{{ route('form/pendidikan/search') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="keyword" name="keyword">
                            <label class="focus-label">Nama Pendidikan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form>
            <!-- /Pencaharian Pendidikan -->

            <!-- /Page Header -->
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="tablePendidikan" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="no">No</th>
                                    <th>Nama Pendidikan</th>
                                    <th>Tingkat Pendidikan ID</th>
                                    <th>Status</th>
                                    <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->


        <!-- Add Pendidikan Modal -->
        <div id="add_pendidikan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pendidikan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/pendidikan/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Pendidikan <span class="text-danger">*</span></label>
                                <input class="form-control @error('pendidikan') is-invalid @enderror" type="text"
                                    id="pendidikan" name="pendidikan">
                                @error('pendidikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tingkat Pendidikan ID<span class="text-danger">*</span></label>
                                <input class="form-control @error('tk_pendidikan_id') is-invalid @enderror" type="text"
                                    id="tk_pendidikan_id" name="tk_pendidikan_id">
                                @error('tk_pendidikan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Status Pendidikan<span class="text-danger">*</span></label>
                                <input class="form-control @error('status_pendidikan') is-invalid @enderror" type="text"
                                    id="status_pendidikan" name="status_pendidikan">
                                @error('status_pendidikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Pendidikan Modal -->

        <!-- Edit Pendidikan Modal -->
        <div id="edit_pendidikan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pendidikan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/pendidikan/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Nama Pendidikan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pendidikan_edit" name="pendidikan" value="">
                            </div>
                            <div class="form-group">
                                <label>Tingkat Pendidikan ID<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tk_pendidikan_id_edit" name="tk_pendidikan_id" value="">
                            </div>
                            <div class="form-group">
                                <label>Status Pendidikan <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="status_pendidikan_edit" name="status_pendidikan" value="">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Pendidikan Modal -->

        <!-- Delete Pendidikan Modal -->
        <div class="modal custom-modal fade" id="delete_pendidikan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Pendidikan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/pendidikan/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
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
        <!-- /Delete Pendidikan Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tablePendidikan').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get-pendidikan-data') }}",
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
                            "data": "pendidikan"
                        },
                        {
                            "data": "tk_pendidikan_id"
                        },
                        {
                            "data": "status_pendidikan"
                        },
                        {
                            "data": "action"
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

        <script src="{{ asset('assets/js/referensipendidikan.js') }}"></script>

        <script>
            history.pushState({}, "", '/referensi/pendidikan');
        </script>

    @endsection
@endsection
