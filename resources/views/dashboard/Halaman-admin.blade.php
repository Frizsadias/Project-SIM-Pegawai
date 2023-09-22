@extends('layouts.master')
@section('content')
    <?php
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $msg = ' Today is ' . date('l, M. d, Y.');
    
    if ($hour >= 0 && $hour <= 11 && $minute <= 59 && $second <= 59) {
        $greet = 'Selamat Pagi,';
    } elseif ($hour >= 12 && $hour <= 15 && $minute <= 59 && $second <= 59) {
        $greet = 'Selamat Siang,';
    } elseif ($hour >= 16 && $hour <= 17 && $minute <= 59 && $second <= 59) {
        $greet = 'Selamat Sore,';
    } elseif ($hour >= 18 && $hour <= 23 && $minute <= 59 && $second <= 59) {
        $greet = 'Selamat Malam,';
    }
    
    ?>
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">{{ $greet }} {{ Session::get('name') }} &#128522;</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard {{ Session::get('name') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-user-plus"></i></span>
                                <div class="dash-widget-info">
                                    <h3>100</h3>
                                    <span>Jumlah Pegawai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b>Riwayat Pendidikan</b></h3>
                                    <div class="container px-4 mx-auto">
                                        {!! $chart->container() !!}
                                    </div>
                                    <script src="{{ $chart->cdn() }}"></script>
                                    {{ $chart->script() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b>Grafik Pegawai Berdasarkan Agama</b></h3>
                                    <div class="container px-4 mx-auto">
                                    {!! $grafikAgama->container() !!}
                                    </div>
                                    <script src="{{ $grafikAgama->cdn() }}"></script>
                                    {{ $grafikAgama->script() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b>Grafik Pegawai Berdasarkan Jenis Kelamin</b></h3>
                                    <div class="container px-4 mx-auto">
                                        {!! $grafikJenisKelamin->container() !!}
                                    </div>
                                    <script src="{{ $grafikJenisKelamin->cdn() }}"></script>
                                    {{ $grafikJenisKelamin->script() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b>Jumlah Pegawai Berdasarkan Pangkat</b></h3>
                                    <div class="container px-4 mx-auto">
                                        {!! $grafikPangkat->container() !!}
                                    </div>
                                    <script src="{{ $grafikPangkat->cdn() }}"></script>
                                    {{ $grafikPangkat->script() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- message --}}
            {!! Toastr::message() !!}
        </div>
    </div>
    <!-- /Page Content -->
    </div>
@endsection
