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
                            <li class="breadcrumb-item active">Dashboard <b>{{ Session::get('role_name') }}</b></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPegawai }}</h3>
                                    <span>Jumlah Seluruh Pegawai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-user-circle"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPNS }}</h3>
                                    <span>Pegawai PNS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-user-circle-o"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataCPNS }}</h3>
                                    <span>Pegawai CPNS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-user-o"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPPPK }}</h3>
                                    <span>Pegawai PPPK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $datanonASN }}</h3>
                                    <span>Pegawai Non-ASN</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lihat-semua">
                <button type="button" class="btn btn-info" id="lihatSemuaJenisPegawai"><i class="fa fa-eye-slash"></i> Lihat Semua</button>
                <button type="button" class="btn btn-info" id="sembunyikanJenisPegawai" style="display: none;"><i class="fa fa-eye"></i> Sembunyikan</button>
            </div><br>

            <div class="col-md-12">
                <div class="card dash-widget">
                    <div class="card-body2">
                        <div class="dash-widget-info">
                            <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;"></span></center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" id="dataContainer">
                <div class="row">
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidur }}</h3>
                                    <span>Jumlah Tempat Tidur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurIGD }}</h3>
                                    <span>Tempat Tidur IGD Terpadu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurBedah }}</h3>
                                    <span>Tempat Tidur Bedah Center</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRR }}</h3>
                                    <span>Tempat Tidur RR</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurPoliJantung }}</h3>
                                    <span>Tempat Tidur Poli Jantung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurPoliKelamindanKulit }}</h3>
                                    <span>Tempat Tidur Poli Kelamin dan Kulit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliSaraf }}</h3>
                                    <span>Tempat Tidur Poli Saraf</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliGigi }}</h3>
                                    <span>Tempat Tidur Poli Gigi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliDalam }}</h3>
                                    <span>Tempat Tidur Poli Dalam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliMata }}</h3>
                                    <span>Tempat Tidur Poli Mata</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliTHT }}</h3>
                                    <span>Tempat Tidur Poli THT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliParu }}</h3>
                                    <span>Tempat Tidur Poli Paru</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliUmum }}</h3>
                                    <span>Tempat Tidur Poli Umum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliAnak }}</h3>
                                    <span>Tempat Tidur Poli Anak</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliKandungan }}</h3>
                                    <span>Tempat Tidur Poli Kandungan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliJiwa }}</h3>
                                    <span>Tempat Tidur Poli Jiwa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliOrthopedi }}</h3>
                                    <span>Tempat Tidur Poli Orthopedi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPoliDots }}</h3>
                                    <span>Tempat Tidur Poli Dots</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangHemodialisis }}</h3>
                                    <span>Tempat Tidur Hemodialisis</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangKebidanan }}</h3>
                                    <span>Tempat Tidur Kebidanan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPinang }}</h3>
                                    <span>Tempat Tidur Ruang Pinang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPerinatologi }}</h3>
                                    <span>Tempat Tidur Perinatologi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangCemara }}</h3>
                                    <span>Tempat Tidur Ruang Cemara</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangHCUBougenvill }}</h3>
                                    <span>Tempat Tidur HCU Bougenvill</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangICU }}</h3>
                                    <span>Tempat Tidur Ruang ICU</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangICCU }}</h3>
                                    <span>Tempat Tidur Ruang ICCU</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangAsoka }}</h3>
                                    <span>Tempat Tidur Ruang Asoka</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPinus }}</h3>
                                    <span>Tempat Tidur Ruang Pinus</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangWijayaKusuma }}</h3>
                                    <span>Tempat Tidur Ruang Wijaya Kusuma</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPavilliun }}</h3>
                                    <span>Tempat Tidur Ruang Pavilliun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangPalem }}</h3>
                                    <span>Tempat Tidur Ruang Palem</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangBidara }}</h3>
                                    <span>Tempat Tidur Ruang Bidara</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-56">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-bed"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataTempatTidurRuangNonPerawatan }}</h3>
                                    <span>Tempat Tidur Ruang Non Perawatan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lihat-semua">
                <button type="button" class="btn btn-info" id="lihatSemuaTempatTidur"><i class="fa fa-eye-slash"></i> Lihat Semua</button>
                <button type="button" class="btn btn-info" id="sembunyikanTempatTidur" style="display: none;"><i class="fa fa-eye"></i> Sembunyikan</button>
            </div><br>
            
            <div class="col-md-12">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;">Informasi
                                    Grafik</span></center>
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
    @section('script')
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endsection
@endsection
