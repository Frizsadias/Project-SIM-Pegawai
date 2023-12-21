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
                        <h3 class="page-title">Manajemen Pengguna</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i
                                class="fa fa-plus"></i> Tambah Pengguna</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="user_name" name="user_name">
                        <label class="focus-label">User Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_role">
                            <option selected disabled>-- Pilih Peran --</option>
                            @foreach ($role_name as $name)
                                <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Peran</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_status">
                            <option selected disabled> -- Pilih Status --</option>
                            @foreach ($status_user as $status)
                                <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Status</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-success btn-block btn_search"> Cari </button>
                </div>
            </div>

            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="userDataList" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>ID Pengguna</th>
                                    <th>E-mail</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add User Modal -->
        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user/add/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            id="" name="name" value="{{ old('name') }}"
                                            placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Alamat E-mail </label>
                                        <input class="form-control" type="email" id="" name="email"
                                            placeholder="Masukkan E-mail">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Peran </label><br>
                                        <select class="theSelect" name="role_name" id="role_name" style="width: 100% !important">
                                            <option selected disabled> --Pilih Peran --</option>
                                            @foreach ($role_name as $role)
                                                <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select" name="status" id="status">
                                            <option selected disabled> --Pilih Status --</option>
                                            @foreach ($status_user as $status)
                                                <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" class="form-control" id="image" name="image" value="photo_defaults.jpg">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password"  id="passwordInput1" placeholder="Masukkan Kata Sandi">
                                            <div class="input-group-append">
                                                <button type="button" id="tampilkanPassword1" class="btn btn-outline-secondary">
                                                    <i id="icon1" class="fa fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Konfirmasi Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation" id="passwordInput2" placeholder="Masukkan Konfirmasi Kata Sandi">
                                            <div class="input-group-append">
                                                <button type="button" id="tampilkanPassword2" class="btn btn-outline-secondary">
                                                    <i id="icon2" class="fa fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
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
        <!-- /Add User Modal -->

        <!-- Edit User Modal -->
        <div id="edit_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" id="e_id" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input class="form-control" type="text" name="name" id="e_name"
                                            value="" placeholder="Masukkan Nama Lengkap" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Alamat E-mail</label>
                                        <input class="form-control" type="email" name="email" id="e_email"
                                            value="" placeholder="Masukkan E-mail" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Peran </label><br>
                                        <select class="theSelect" name="role_name" id="e_role_name" style="width: 100% !important">
                                            @foreach ($role_name as $role)
                                                <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select" name="status" id="e_status">
                                            @foreach ($status_user as $status)
                                                <option value="{{ $status->type_name }}">{{ $status->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="image" name="images"
                                    value="photo_defaults.jpg">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Salary Modal -->

        {{-- <!-- Delete User Modal -->
        <div class="modal custom-modal fade" id="delete_user" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete User</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('user/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="avatar" id="e_avatar" value="">
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
        <!-- /Delete User Modal --> --}}

    </div>
    <!-- /Page Wrapper -->

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            table = $('#userDataList').DataTable({

                lengthMenu: [
                    [10, 25, 50, 100, 150],
                    [10, 25, 50, 100, 150]
                ],
                buttons: [
                    'pageLength',
                ],
                "pageLength": 10,
                order: [
                    [5, 'desc']
                ],
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url: "{{ route('get-users-data') }}",
                    data: function(data) {
                        // read valus for search
                        var user_name = $('#user_name').val();
                        var type_role = $('#type_role').val();
                        var type_status = $('#type_status').val();
                        data.user_name = user_name;
                        data.type_role = type_role;
                        data.type_status = type_status;
                    }
                },

                columns: [{
                        data: 'no',
                        name: 'no',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'join_date',
                        name: 'join_date',
                    },
                    {
                        data: 'role_name',
                        name: 'role_name',
                    },
                    {
                        data: 'status',
                        name: 'status',
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

    <script>
        $(".theSelect").select2();
    </script>

    <script src="{{ asset('assets/js/lihatkatasandi.js') }}"></script>
    <script src="{{ asset('assets/js/usercontrol.js') }}"></script>

@endsection
@endsection
