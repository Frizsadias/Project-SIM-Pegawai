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
                        <h3 class="page-title">Pegawai</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_pegawai"><i class="fa fa-plus"></i> Tambah Pegawai</a> --}}
                        <div class="view-icons">
                            <a href="{{ route('daftar/pegawai/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('daftar/pegawai/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
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
            </form>
            <!-- Search Filter -->

            <!-- Export Excel -->
            <form action="{{ route('export-daftar-pegawai') }}" method="GET">
                <button type="submit" name="export" value="true" class="btn btn-success">
                    <i class="fa fa-file-excel"></i> Export Excel
                </button>
            </form>
            <br>

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
                                    <th>Ruang</th>
                                    <th>Kedudukan</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $dafpeg)
                                @if ($dafpeg->role_name == 'User' && (empty($dafpeg->kedudukan_pns) || $dafpeg->kedudukan_pns == 'Aktif'))
                                <tr>
                                    <td>{{ $dafpeg->nip }}</td>
                                    <td><a href="{{ url('user/profile/' . $dafpeg->user_id) }}" style="color:black;">{{ $dafpeg->name }}</a></td>
                                    <td>{{ $dafpeg->jabatan }}</td>
                                    <td>{{ $dafpeg->pendidikan_terakhir }}</td>
                                    <td><a href="https://api.whatsapp.com/send?phone={{ $dafpeg->no_hp }}" target="_blank" style="color:black;">{{ $dafpeg->no_hp }}</a></td>
                                    <td>{{ $dafpeg->ruangan }}</td>
                                    <td>{{ $dafpeg->kedudukan_pns }}</td>
                                    <td><h2 class="table-avatar">
                                        <a href="{{ url('user/profile/' . $dafpeg->user_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/' . $dafpeg->avatar) }}"></a>
                                    </h2></td>
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
            $('#name').on('change',function()
            {
                $('#employee_id').val($(this).find(':selected').data('employee_id'));
                $('#email').val($(this).find(':selected').data('email'));
            });
        </script>

    @endsection
@endsection
