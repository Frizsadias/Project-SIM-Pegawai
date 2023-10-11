@extends('layouts.master')
@section('content')
    @section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/abea6a9d41.js" crossorigin="anonymous"></script>
    <!-- checkbox style -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
    @endsection
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pegawai Pensiun</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_pegawai"><i class="fa fa-plus"></i> Tambah Pegawai</a> --}}
                        <div class="view-icons">
                            <a href="{{ route('daftar/pegawai/pensiun/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('daftar/pegawai/pensiun/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

        <!-- Search Filter -->
        <form action="{{ route('daftar/pegawai/list/search') }}" method="POST">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="employee_id">
                        <label class="focus-label">ID Pegawai</label>
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
        </form>
        <!-- Search Filter -->
        {{-- message --}}
        {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Nomor HP</th>
                                    <th>Ruangan</th>
                                    <th>Kedudukan</th>
                                    <th>Foto</th>
                                    {{-- <th class="text-right no-sort">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $dafpeg)
                                @if ($dafpeg->role_name == 'User' && $dafpeg->kedudukan_pns == 'Pensiun')
                                <tr>
                                    <td>{{ $dafpeg->nip }}</td>
                                    <td><a href="{{ url('user/profile/' . $dafpeg->user_id) }}" style="color:black;">{{ $dafpeg->name }}</a></td>
                                    <td>{{ $dafpeg->jabatan }}</td>
                                    <td>{{ $dafpeg->pendidikan_terakhir }}</td>
                                    <td><a href="https://api.whatsapp.com/send?phone={{ $dafpeg->no_hp }}" target="_blank"><i class="fa-brands fa-whatsapp fa-2xl" style="color: #25D366;"></i></a>&nbsp; || {{ $dafpeg->no_hp }}</td>
                                    <td>{{ $dafpeg->ruangan }}</td>
                                    <td>{{ $dafpeg->kedudukan_pns }}</td>
                                    <td><h2 class="table-avatar">
                                        <a href="{{ url('user/profile/' . $dafpeg->user_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/' . $dafpeg->avatar) }}"></a>
                                    </h2></td>
                                    {{-- <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url('daftar/pegawai/view/edit/' . $dafpeg->user_id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="{{ url('daftar/pegawai/delete/' . $dafpeg->user_id) }}"onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- /Page Content -->

        {{-- <!-- Add Employee Modal -->
        <div id="daftar_pegawai" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('daftar/pegawai/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nama Akun</label>
                                        <select class="select" id="name" name="name">
                                            <option value="">-- Pilih Nama Akun --</option>
                                            @foreach ($userList as $key => $user)
                                                <option value="{{ $user->name }}" data-employee_id={{ $user->user_id }} data-email={{ $user->email }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">ID Pegawai <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="ID pengguna otomatis" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="E-mail otomatis" readonly>
                                    </div>
                                </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Tambah Data</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Employee Modal --> --}}
</div>
<!-- /Page Wrapper -->
@section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                closeOnSelect: false
            });
        });
    </script>

    <script>
        // select auto id and email
        $('#name').on('change',function()
        {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
    @endsection

@endsection
