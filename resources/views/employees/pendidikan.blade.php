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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_pendidikan"><i
                                class="fa fa-plus"></i> Tambah Pendidikan</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">No</th>
                                    <th>Nama Pendidikan</th>
                                    <th>Tingkat Pendidikan ID</th>
                                    <th>Status</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendidikan as $key => $items)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td class="pendidikan">{{ $items->pendidikan }}</td>
                                        <td class="tk_pendidikan_id">{{ $items->tk_pendidikan_id }}</td>
                                        <td class="status_pendidikan">{{ $items->status_pendidikan }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item  edit_pendidikan" href="#"
                                                        data-toggle="modal" data-target="#edit_pendidikan"><i
                                                            class="fa fa-pencil m-r-5"></i>Edit</a>
                                                    <a class="dropdown-item delete_pendidikan" href="#"
                                                        data-toggle="modal" data-target="#delete_pendidikan"><i
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
                                <input type="text" class="form-control" id="pendidikan_edit" name="pendidikan"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label>Tingkat Pendidikan ID<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tk_pendidikan_id_edit"
                                    name="tk_pendidikan_id" value="">
                            </div>
                            <div class="form-group">
                                <label>Status Pendidikan <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="status_pendidikan_edit"
                                    name="status_pendidikan" value="">
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
        <!-- /Delete Pendidikan Modal -->
    </div>

    <!-- /Page Wrapper -->
@section('script')
    {{-- update js --}}
    <script>
        $(document).on('click', '.edit_pendidikan', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#pendidikan_edit').val(_this.find('.pendidikan').text());
            $('#tk_pendidikan_id_edit').val(_this.find('.tk_pendidikan_id').text());
            $('#status_pendidikan_edit').val(_this.find('.status_pendidikan').text());
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click', '.delete_pendidikan', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
@endsection
@endsection
