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

            
            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="agamaDataList" style="width: 100%">
                        <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Agama</th>
                                    <th>Aksi</th>
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
                        <form action="{{ route('form/agama/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Nama Agama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="e_agama" name="agama" value="">
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
<script type="text/javascript">
        $(document).ready(function() {

            table = $('#agamaDataList').DataTable({

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                buttons: [
                    'pageLength',
                ],
                "pageLength": 10,
                order: [
                    [1, 'asc']
                ],
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url: "{{ route('get-agama-data') }}",
                    data: function(data) {
                        
                    }
                },

                columns: [{
                        data: 'no',
                        name: 'no',
                    },
                    {
                        data: 'agama',
                        name: 'agama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
            $('.btn_search').on('click', function() {
                table.draw();
            });
        });
    </script>



    {{-- update js --}}
    <script>
        $(document).on('click', '.agamaUpdate', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_agama').val(_this.find('.agama').text());
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click', '.agamaDelete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    
@endsection
@endsection
