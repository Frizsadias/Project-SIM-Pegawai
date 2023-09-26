@extends('layouts.master')
@section('content')
@section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
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
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pegawai</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Tambah Pegawai</a>
                    <div class="view-icons">
                        <a href="{{ route('all/employee/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="{{ route('all/employee/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form action="{{ route('all/employee/list/search') }}" method="POST">
            @csrf
            <div class="container">
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
                            <input type="text" class="form-control floating" name="position">
                            <label class="focus-label">Posisi</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <button type="sumit" class="btn btn-success btn-block"> Cari </button>  
                    </div>
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
                                <th>Nama</th>
                                <th>Gelar Depan</th>
                                <th>Gelar Belakang</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Jenis Dokumen</th>
                                <th>No Dokumen</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Kode Pos</th>
                                <th>No HP</th>
                                <th>Nomor Telepon</th>
                                <th>Jenis Pegawai</th>
                                <th>Kedudukan PNS</th>
                                <th>Status Pegawai</th>
                                <th>TMT PNS</th>
                                <th>No Seri Karpeg</th>
                                <th>TMT CPNS</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-right no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $items)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/profile/' . $items->user_id) }}"
                                                class="avatar"><img alt=""
                                                    src="{{ URL::to('/assets/images/' . $items->avatar) }}"></a>
                                            <a
                                                href="{{ url('employee/profile/' . $items->user_id) }}">{{ $items->name }}<span>{{ $items->position }}</span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $items->user_id }}</td>
                                    <td>{{ $items->email }}</td>
                                    <td>{{ $items->role_name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                    href="{{ url('all/employee/view/edit/' . $items->user_id) }}"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('all/employee/delete/' . $items->user_id) }}"onclick="return confirm('Are you sure to want to delete it?')"><i
                                                        class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    <!-- Add Employee Modal -->
    <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('all/employee/save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Lengkap</label>
                                    <select class="select" id="name" name="name">
                                        <option value="">-- Select --</option>
                                        @foreach ($userList as $key => $user)
                                            <option value="{{ $user->name }}" data-employee_id={{ $user->user_id }}
                                                data-email={{ $user->email }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Auto email" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">NIP</label>
                                    <input class="form-control" type="nip" id="nip" name="nip"
                                        placeholder="Masukkan NIP">
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Lengkap</label>
                                    <input class="form-control" type="name" id="name" name="name"
                                        placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Gelar Depan</label>
                                    <input class="form-control" type="text" id="gelar_depan" name="gelar_depan"
                                        placeholder="Masukkan Gelar Depan">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Gelar Belakang</label>
                                    <input class="form-control" type="text" id="gelar_belakang"
                                        name="gelar_belakang" placeholder="Masukkan Gelar Belakang">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input class="form-control" type="text" id="tempat_lahir"
                                        name="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" type="date" id="tanggal_lahir"
                                        name="tanggal_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="select form-control" id="gender" name="gender">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <input class="form-control" type="text" id="agama" name="agama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Dokumen</label>
                                    <input class="form-control" type="text" id="jenis_dokumen"
                                        name="jenis_dokumen">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Dokumen</label>
                                    <input class="form-control" type="text" id="no_dokumen" name="no_dokumen">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input class="form-control" type="text" id="kelurahan" name="kelurahan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" type="text" id="kecamatab" name="kecamatan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input class="form-control" type="text" id="kota" name="kota">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <input class="form-control" type="text" id="provinsi" name="provinsi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input class="form-control" type="text" id="kode_pos" name="kode_pos">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input class="form-control" type="text" id="no_hp" name="no_hp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input class="form-control" type="text" id="no_telepon" name="no_telepon">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Pegawai</label>
                                    <input class="form-control" type="text" id="jenis_pegawai"
                                        name="jenis_pegawai">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kedudukan PNS</label>
                                    <input class="form-control" type="text" id="kedudukan_pns"
                                        name="kedudukan_pns">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Pegawai</label>
                                    <input class="form-control" type="text" id="status_pegawai"
                                        name="status_pegawai">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TMT PNS</label>
                                    <input class="form-control" type="text" id="tmt_pns" name="tmt_pns">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Seri Kartu Pegawai</label>
                                    <input class="form-control" type="text" id="no_seri_karpeg"
                                        name="no_seri_karpeg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TMT CPNS</label>
                                    <input class="form-control" type="text" id="tmt_cpns" name="tmt_cpns">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tingkat Pendidikan</label>
                                    <input class="form-control" type="text" id="tingkat_pendidikan"
                                        name="tingkat_pendidikan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input class="form-control" type="text" id="pendidikan_terakhir"
                                        name="pendidikan_terakhir">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">ID Pegawai <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="employee_id" name="employee_id"
                                        placeholder="Auto id employee" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Employee Modal -->
</div>
<!-- /Page Wrapper -->
@section('script')
    <script>
        $("input:checkbox").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>

    <script>
        // select auto id and email
        $('#name').on('change', function() {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
@endsection
@endsection
