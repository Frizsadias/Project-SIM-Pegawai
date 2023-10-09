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
                        <h3 class="page-title"> Referensi Tabel Kedudukan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Kedudukan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_kedudukan"><i
                                class="fa fa-plus"></i> Tambah Kedudukan</a>
                    </div>
                </div>
            </div>

            {{-- Fungsi Seacrh --}}
            <form action="{{ route('form/kedudukan/search') }}" method="GET" id="search-form">
                <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="keyword" name="keyword">
                        <label class="focus-label">Nama Kedudukan</label>
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
                        <table class="table table-striped custom-table datatable" id="tableKedudukan">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">No</th>
                                    <th>Nama Kedudukan</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kedudukan as $key => $items)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td class="kedudukan">{{ $items->kedudukan }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item  edit_kedudukan" href="#" data-toggle="modal"
                                                        data-target="#edit_kedudukan"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                                                    <a class="dropdown-item delete_kedudukan" href="#" data-toggle="modal"
                                                        data-target="#delete_kedudukan"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>
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

        <!-- Add Kedudukan Modal -->
        <div id="add_kedudukan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kedudukan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/kedudukan/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Kedudukan <span class="text-danger">*</span></label>
                                <input class="form-control @error('kedudukan') is-invalid @enderror" type="text"
                                    id="kedudukan" name="kedudukan">
                                @error('kedudukan')
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
        <div id="edit_kedudukan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kedudukan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/kedudukan/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Nama Kedudukan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kedudukan_edit" name="kedudukan" value="">
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
        <div class="modal custom-modal fade" id="delete_kedudukan" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Kedudukan</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/kedudukan/delete') }}" method="POST">
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
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_kedudukan', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#kedudukan_edit').val(_this.find('.kedudukan').text());
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_kedudukan', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    
@endsection
@endsection
