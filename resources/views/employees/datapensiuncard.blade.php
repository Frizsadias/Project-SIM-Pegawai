@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-lists-center">
                    <div class="col">
                        <h3 class="page-title">Pegawai Pensiun</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="view-icons">
                            <a href="{{ route('daftar/pegawai/pensiun/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('daftar/pegawai/pensiun/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('daftar/pegawai/pensiun/card/search') }}" method="POST">
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

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row staff-grid-row">
                @foreach ($users as $lists )
                    @if ($lists->role_name == 'User' && $lists->kedudukan_pns == 'Pensiun')
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                <a href="{{ url('user/profile/' . $lists->user_id) }}" class="avatar"><img src="{{ URL::to('/assets/images/' . $lists->avatar) }}" alt="{{ $lists->avatar }}" alt="{{ $lists->avatar }}"></a>
                            </div>
                                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a>{{ $lists->name }}</a></h4>
                                <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a>{{ $lists->nip }}</a></h5>
                                <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a>{{ $lists->email }}</a></h5>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script>
            document.getElementById('pageTitle').innerHTML = 'Manajemen Data Pegawai Pensiun - Admin | Aplikasi SILK';
        </script>

        <script>
            history.pushState({}, "", '/daftar/pegawai/pensiun/card');
        </script>

    @endsection
@endsection
