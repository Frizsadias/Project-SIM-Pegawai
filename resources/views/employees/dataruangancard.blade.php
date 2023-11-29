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
                        <h3 class="page-title">Ruangan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ruangan</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="view-icons">
                            <a href="{{ route('daftar/ruangan/pegawai/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('daftar/ruangan/pegawai/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('ruangan/pegawai/card/cari') }}" method="POST">
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
                        <button type="sumit" class="btn btn-success btn-block"> Cari </button>
                    </div>
                </div>
            </form>
            <!-- Search Filter -->

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row staff-grid-row">
                @foreach ($data_ruangan as $result_ruang)
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                <a href="{{ url('user/profile/' . $result_ruang->user_id) }}" class="avatar"><img src="{{ URL::to('/assets/images/' . $result_ruang->avatar) }}" alt="{{ $result_ruang->avatar }}"></a>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis">
                                <a>{{ $result_ruang->name }}</a>
                            </h4>
                            @if ($result_ruang->ruangan)
                                <p>{{ $result_ruang->ruangan }}</p>
                            @else
                                <p>Belum Ada Informasi Ruangan</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
