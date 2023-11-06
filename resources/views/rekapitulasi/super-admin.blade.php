@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Data Statistik</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Statistik</li>
                    </ul>
                </div>
            </div>
        </div>

            <div class="container">
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
                                        <h3 class="card-title"><b> Pegawai Berdasarkan Pangkat</b></h3>
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
            </div>
        </div>
        {{-- message --}}
        {!! Toastr::message() !!}
    </div>
    </div>
    <!-- /Page Content -->
    </div>
@endsection
