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
                        <h3 class="page-title"> Referensi Tabel Unit Organisasi</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Unit Organisasi</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_unit_organisasi"><i
                                class="fa fa-plus"></i> Tambah Unit Organisasi</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th class="no">No</th>
                                    <th>ID Unit Organisasi</th>
                                    <th>Nama Unit Organisasi</th>
                                    <th class="aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit_organisasi as $sql_unor => $result_unor)
                                    <tr>
                                        {{-- <td>{{ ++$sql_unor }}</td> --}}
                                        <td class="id">{{ $result_unor->id }}</td>
                                        <td class="unor_id">{{ $result_unor->unor_id }}</td>
                                        <td class="unor_nama">{{ $result_unor->unor_nama }}</td>

                                        {{-- Edit Unit Organisasi --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_unit_organisasi" href="#" data-toggle="modal"
                                                        data-target="#edit_unit_organisasi"><i class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item delete_unit_organisasi" href="#"
                                                        data-toggle="modal" data-target="#delete_unit_organisasi"><i
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


        <!-- Add Unit Organisasi Modal -->
        <div id="add_unit_organisasi" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Unit Organisasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/unitorganisasi/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>ID Unit Organisasi <span class="text-danger">*</span></label>
                                <input class="form-control @error('unor_id') is-invalid @enderror" type="text"
                                    id="unor_id" name="unor_id">
                                @error('unor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Unit Organisasi<span class="text-danger">*</span></label>
                                <input class="form-control @error('unor_nama') is-invalid @enderror" type="text"
                                    id="unor_nama" name="unor_nama">
                                @error('unor_nama')
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
        <!-- /Add Unit Organisasi Modal -->

        <!-- Edit Unit Organisasi Modal -->
        <div id="edit_unit_organisasi" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Unit Organisasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/unitorganisasi/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>ID Unit Organisasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="unor_id_edit" name="unor_id"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label>Nama Unit Organisasi<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="unor_nama_edit"
                                    name="unor_nama" value="">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Unit Organisasi Modal -->

        <!-- Delete Unit Organisasi Modal -->
        <div class="modal custom-modal fade" id="delete_unit_organisasi" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Unit Organisasi</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/unitorganisasi/delete') }}" method="POST">
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
        <!-- /Delete Unit Organisasi Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
        <script src="{{ asset('assets/js/unor.js') }}"></script>

        <script>
            history.pushState({}, "", '/referensi/unit/organisasi');
        </script>
    @endsection
@endsection
