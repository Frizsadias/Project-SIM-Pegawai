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
    <script src="https://kit.fontawesome.com/abea6a9d41.js" crossorigin="anonymous"></script>
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
                    <div class="col-md-24 col-sm-24 col-lg-24 col-xl-12">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                                <div class="dash-widget-info">
                                    @if (!empty($tampilanPerusahaan->company_name))
                                        <h3 class="perusahaan">{{ $tampilanPerusahaan->company_name }}</h3>
                                    @else
                                        <h3>Nama Instansi</h3>
                                    @endif

                                    @if (!empty($tampilanPerusahaan->address))
                                        <p class="alamat"><i class="fa-solid fa-location-dot fa-xl" style="color: #f43b48;"></i> : {{ $tampilanPerusahaan->address }}</p>
                                    @else
                                        <p>Alamat : Alamat Instansi</p>
                                    @endif

                                    @if (!empty($tampilanPerusahaan->phone_number))
                                        <p class="nomorhp"><i class="fa-solid fa-mobile fa-xl" style="color: #f43b48;"></i> : {{ $tampilanPerusahaan->phone_number }}</p>
                                    @else
                                        <p>No. Telepon : Nomor Telepon Instansi</p>
                                    @endif
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
