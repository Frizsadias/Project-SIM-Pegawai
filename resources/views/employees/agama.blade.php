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
                        <h3 class="page-title"> Referensi Tabel Agama</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Agama</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_agama"><i
                                class="fa fa-plus"></i> Tambah Agama</a>
                    </div>
                </div>
            </div>

            {{-- Fungsi Seacrh --}}
            <form action="{{ route('form/agama/search') }}" method="GET" id="search-form">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="keyword" name="keyword">
                            <label class="focus-label">Nama Agama</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
            </form>

            <!-- /Page Header -->
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="tableAgama" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="no">No</th>
                                    <th>Nama Agama</th>
                                    <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Agama Modal -->
        <div id="add_agama" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Agama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/agama/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Agama <span class="text-danger">*</span></label>
                                <input class="form-control @error('agama') is-invalid @enderror" type="text"
                                    id="agama" name="agama">
                                @error('agama')
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

        <!-- /Add Department Modal -->

        <!-- Edit Department Modal -->
        <div id="edit_agama" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Agama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/agama/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Nama Agama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="agama_edit" name="agama" value="">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Department Modal -->

        <!-- Delete Department Modal -->
        <div class="modal custom-modal fade" id="delete_agama" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Agama</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/agama/delete') }}" method="POST">
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
        <!-- /Delete Department Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#tableAgama').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get-agama-data') }}",
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
                            "data": "agama"
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
        </script>

        {{-- update js --}}
        <script>
            $(document).on('click', '.edit_agama', function() {
                var id = $(this).data('id');
                var agama = $(this).data('agama');
                $("#e_id").val(id);
                $("#agama_edit").val(agama);
            });
        </script>

        {{-- delete model --}}
        <script>
            $(document).on('click', '.delete_agama', function() {
                var id = $(this).data('id');
                $(".e_id").val(id);
            });
        </script>
    
    @endsection
@endsection
