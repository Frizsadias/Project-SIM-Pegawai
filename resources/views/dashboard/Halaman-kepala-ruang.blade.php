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
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataIGD }}</h3>
                                    <span>Jumlah Pegawai Ruang IGD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataBedahCentral }}</h3>
                                    <span>Jumlah Pegawai Ruang Bedah Central</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataRR }}</h3>
                                    <span>Jumlah Pegawai RR</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliJantung }}</h3>
                                    <span>Jumlah Pegawai Poli Jantung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliKelaminDanKulit }}</h3>
                                    <span>Jumlah Pegawai Poli Kelamin dan Kulit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliSaraf }}</h3>
                                    <span>Jumlah Pegawai Poli Saraf</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliGigi }}</h3>
                                    <span>Jumlah Pegawai Poli Gigi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliDalam }}</h3>
                                    <span>Jumlah Pegawai Poli Dalam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliMata }}</h3>
                                    <span>Jumlah Pegawai Poli Mata</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliTHT }}</h3>
                                    <span>Jumlah Pegawai Poli THT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliParu }}</h3>
                                    <span>Jumlah Pegawai Poli Paru</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliUmum }}</h3>
                                    <span>Jumlah Pegawai Poli Umum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliAnak }}</h3>
                                    <span>Jumlah Pegawai Poli Anak</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliKandungan }}</h3>
                                    <span>Jumlah Pegawai Poli Kandungan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliJiwa }}</h3>
                                    <span>Jumlah Pegawai Poli Jiwa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliOrthopedi }}</h3>
                                    <span>Jumlah Pegawai Poli Orthopedi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPoliDots }}</h3>
                                    <span>Jumlah Pegawai Poli Dots</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataHemodialisis }}</h3>
                                    <span>Jumlah Pegawai Ruang Hemodialisis</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataKebidanan }}</h3>
                                    <span>Jumlah Pegawai Kebidanan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPinang }}</h3>
                                    <span>Jumlah Pegawai Ruang Pinang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPerinatologi }}</h3>
                                    <span>Jumlah Pegawai Perinatologi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataHCU_Bougenvill }}</h3>
                                    <span>Jumlah Pegawai Ruang HCU Bougenvill</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataICU }}</h3>
                                    <span>Jumlah Pegawai Ruang ICU</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataICCU }}</h3>
                                    <span>Jumlah Pegawai Ruang ICCU</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataAsoka }}</h3>
                                    <span>Jumlah Pegawai Ruang Asoka</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPinus }}</h3>
                                    <span>Jumlah Pegawai Ruang Pinus</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataWijayaKusuma }}</h3>
                                    <span>Jumlah Pegawai Ruang Wijaya Kusuma</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPaviliun }}</h3>
                                    <span>Jumlah Pegawai Ruang Paviliun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataPalem_PICU }}</h3>
                                    <span>Jumlah Pegawai Ruang Palem PICU</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataUnitStroke }}</h3>
                                    <span>Jumlah Pegawai Ruang Unit Stroke</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataBidara_RanapJiwa }}</h3>
                                    <span>Jumlah Pegawai Ruang Ranap Jiwa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $dataLain_Lain_NonPerawatan }}</h3>
                                    <span>Jumlah Pegawai Ruang Non Perawatan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lihat-semua">
                    <button type="button" class="btn btn-info" id="lihatSemuaJenisPegawai">Lihat Semua</button>
                </div><br>

                <div class="col-md-12">
                    <div class="card dash-widget">
                        <div class="card-body2">
                            <div class="dash-widget-info">
                                <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;"></span>
                                </center>
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
            </div>
            <!-- /Page Content -->
        </div>
    @section('script')
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endsection
@endsection
