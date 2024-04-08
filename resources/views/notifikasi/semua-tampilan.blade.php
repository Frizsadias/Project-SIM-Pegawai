@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Semua Notifikasi - {{ Session::get('name') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Notifikasi</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            {!! Toastr::message() !!}

            <div class="card tab-box" style="overflow-x: hidden;">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified" style="text-align: center">
                            <li class="nav-item"><a href="#semua_notif" data-toggle="tab" class="nav-link active">Semua</a></li>
                            <li class="nav-item"><a href="#sip_dokter" data-toggle="tab" class="nav-link">SIP Dokter</a></li>
                            <li class="nav-item"><a href="#spk_dokter" data-toggle="tab" class="nav-link">SPK Dokter</a></li>
                            <li class="nav-item"><a href="#spk_perawat" data-toggle="tab" class="nav-link">SPK Perawat</a></li>
                            <li class="nav-item"><a href="#spk_nakes_lain" data-toggle="tab" class="nav-link">SPK Nakes Lain</a></li>
                            <li class="nav-item"><a href="#ulang_tahun" data-toggle="tab" class="nav-link">Ulang Tahun</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Notifikasi -->
            <div class="tab-content">

                <!-- Semua Notifikasi -->
                <div id="semua_notif" class="pro-overview tab-pane fade show active">
                    <ul class="notification-list @if(auth()->user()->unreadNotifications->isEmpty() && auth()->user()->readNotifications->isEmpty()) empty @endif" style="margin-top: 10%;">
                        @if(auth()->user()->unreadNotifications->isEmpty() && auth()->user()->readNotifications->isEmpty())
                            <li class="notification-message noti-unread">
                                <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                    <i class="fa-solid fa-bell-slash fa-fade fa-2xl" style="font-size: 40px !important"></i>
                                </p>
                                <p class="noti-details" style="margin-top: 20px; text-align: center; font-size: 18px;">Tidak ada notifikasi baru</p>
                            </li>
                        @endif
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($semua_notifikasi->where('notifiable_id', auth()->id()) as $notifikasi)
                            @php
                                $notifikasiData = json_decode($notifikasi->data);
                                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
                            @endphp
                            <div class="card" data-notification="{{ json_encode($notifikasiData) }}">
                                <div class="card-header" onclick="toggleCardBody(this)">
                                    {{ $notifikasiData->message3 }}
                                    <span class="arrow-notif"></span><br>
                                    <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                    <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                </div>
                                <div class="card-body" style="display:none">
                                    <p><b>{{ ucfirst(strtolower($notifikasiData->message5)) }}</b>, memberikan notifikasi {{ strtolower($notifikasiData->message3) }} kepada Anda. Anda dapat melihat dan menghapus notifikasi ini.</p>
                                    @if ($notifikasi->read_at)
                                        <i class="fa-solid fa-check-double" style="color: #4999de;"></i>
                                        <span class="notification-time">{{ $read_at->diffForHumans() }}</span>
                                    @endif
                                        <a class="simbol-hapus hapus_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#hapus_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-trash fa-lg"></i></a>
                                        <a class="simbol-lihat lihat_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#lihat_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Semua Notifikasi -->
                
                <!-- Notifikasi SIP Dokter -->
                <div id="sip_dokter" class="tab-pane fade">
                    <ul class="notification-list @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SIP Dokter'; })->isEmpty()) empty @endif" style="margin-top: 10%;">
                        @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SIP Dokter'; })->isEmpty())
                            <li class="notification-message noti-unread">
                                <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                    <i class="fa-solid fa-bell-slash fa-fade fa-2xl" style="font-size: 40px !important"></i>
                                </p>
                                <p class="noti-details" style="margin-top: 20px; text-align: center; font-size: 18px;">Tidak ada notifikasi baru</p>
                            </li>
                        @endif
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($semua_notifikasi->where('notifiable_id', auth()->id()) as $notifikasi)
                            @php
                                $notifikasiData = json_decode($notifikasi->data);
                                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
                            @endphp
                            @if ($notifikasiData->message3 == 'Masa Berlaku SIP Dokter')
                                <div class="card" data-notification="{{ json_encode($notifikasiData) }}">
                                    <div class="card-header" onclick="toggleCardBody(this)">
                                        {{ $notifikasiData->message3 }}
                                        <span class="arrow-notif"></span><br>
                                        <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                        <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="card-body" style="display:none">
                                        <p><b>{{ ucfirst(strtolower($notifikasiData->message5)) }}</b>, memberikan notifikasi {{ strtolower($notifikasiData->message3) }} kepada Anda. Anda dapat melihat dan menghapus notifikasi ini.</p>
                                        @if ($notifikasi->read_at)
                                            <i class="fa-solid fa-check-double" style="color: #4999de;"></i>
                                            <span class="notification-time">{{ $read_at->diffForHumans() }}</span>
                                        @endif
                                            <a class="simbol-hapus hapus_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#hapus_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-trash fa-lg"></i></a>
                                            <a class="simbol-lihat lihat_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#lihat_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Notifikasi SIP Dokter -->

                <!-- Notifikasi SPK Dokter -->
                <div id="spk_dokter" class="tab-pane fade">
                    <ul class="notification-list @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SPK Dokter'; })->isEmpty()) empty @endif" style="margin-top: 10%;">
                        @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SPK Dokter'; })->isEmpty())
                            <li class="notification-message noti-unread">
                                <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                    <i class="fa-solid fa-bell-slash fa-fade fa-2xl" style="font-size: 40px !important"></i>
                                </p>
                                <p class="noti-details" style="margin-top: 20px; text-align: center; font-size: 18px;">Tidak ada notifikasi baru</p>
                            </li>
                        @endif
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($semua_notifikasi->where('notifiable_id', auth()->id()) as $notifikasi)
                            @php
                                $notifikasiData = json_decode($notifikasi->data);
                                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
                            @endphp
                            @if ($notifikasiData->message3 == 'Masa Berlaku SPK Dokter')
                                <div class="card" data-notification="{{ json_encode($notifikasiData) }}">
                                    <div class="card-header" onclick="toggleCardBody(this)">
                                        {{ $notifikasiData->message3 }}
                                        <span class="arrow-notif"></span><br>
                                        <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                        <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="card-body" style="display:none">
                                        <p><b>{{ ucfirst(strtolower($notifikasiData->message5)) }}</b>, memberikan notifikasi {{ strtolower($notifikasiData->message3) }} kepada Anda. Anda dapat melihat dan menghapus notifikasi ini.</p>
                                        @if ($notifikasi->read_at)
                                            <i class="fa-solid fa-check-double" style="color: #4999de;"></i>
                                            <span class="notification-time">{{ $read_at->diffForHumans() }}</span>
                                        @endif
                                            <a class="simbol-hapus hapus_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#hapus_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-trash fa-lg"></i></a>
                                            <a class="simbol-lihat lihat_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#lihat_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Notifikasi SPK Dokter -->

                <!-- Notifikasi SPK Perawat -->
                <div id="spk_perawat" class="tab-pane fade">
                    <ul class="notification-list @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SPK Perawat'; })->isEmpty()) empty @endif" style="margin-top: 10%;">
                        @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SPK Perawat'; })->isEmpty())
                            <li class="notification-message noti-unread">
                                <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                    <i class="fa-solid fa-bell-slash fa-fade fa-2xl" style="font-size: 40px !important"></i>
                                </p>
                                <p class="noti-details" style="margin-top: 20px; text-align: center; font-size: 18px;">Tidak ada notifikasi baru</p>
                            </li>
                        @endif
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($semua_notifikasi->where('notifiable_id', auth()->id()) as $notifikasi)
                            @php
                                $notifikasiData = json_decode($notifikasi->data);
                                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
                            @endphp
                            @if ($notifikasiData->message3 == 'Masa Berlaku SPK Perawat')
                                <div class="card" data-notification="{{ json_encode($notifikasiData) }}">
                                    <div class="card-header" onclick="toggleCardBody(this)">
                                        {{ $notifikasiData->message3 }}
                                        <span class="arrow-notif"></span><br>
                                        <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                        <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="card-body" style="display:none">
                                        <p><b>{{ ucfirst(strtolower($notifikasiData->message5)) }}</b>, memberikan notifikasi {{ strtolower($notifikasiData->message3) }} kepada Anda. Anda dapat melihat dan menghapus notifikasi ini.</p>
                                        @if ($notifikasi->read_at)
                                            <i class="fa-solid fa-check-double" style="color: #4999de;"></i>
                                            <span class="notification-time">{{ $read_at->diffForHumans() }}</span>
                                        @endif
                                            <a class="simbol-hapus hapus_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#hapus_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-trash fa-lg"></i></a>
                                            <a class="simbol-lihat lihat_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#lihat_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Notifikasi SPK Perawat -->

                <!-- Notifikasi SPK Nakes Lain -->
                <div id="spk_nakes_lain" class="tab-pane fade">
                    <ul class="notification-list @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SPK Nakes Lain'; })->isEmpty()) empty @endif" style="margin-top: 10%;">
                        @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Masa Berlaku SPK Nakes Lain'; })->isEmpty())
                            <li class="notification-message noti-unread">
                                <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                    <i class="fa-solid fa-bell-slash fa-fade fa-2xl" style="font-size: 40px !important"></i>
                                </p>
                                <p class="noti-details" style="margin-top: 20px; text-align: center; font-size: 18px;">Tidak ada notifikasi baru</p>
                            </li>
                        @endif
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($semua_notifikasi->where('notifiable_id', auth()->id()) as $notifikasi)
                            @php
                                $notifikasiData = json_decode($notifikasi->data);
                                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
                            @endphp
                            @if ($notifikasiData->message3 == 'Masa Berlaku SPK Nakes Lain')
                                <div class="card" data-notification="{{ json_encode($notifikasiData) }}">
                                    <div class="card-header" onclick="toggleCardBody(this)">
                                        {{ $notifikasiData->message3 }}
                                        <span class="arrow-notif"></span><br>
                                        <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                        <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="card-body" style="display:none">
                                        <p><b>{{ ucfirst(strtolower($notifikasiData->message5)) }}</b>, memberikan notifikasi {{ strtolower($notifikasiData->message3) }} kepada Anda. Anda dapat melihat dan menghapus notifikasi ini.</p>
                                        @if ($notifikasi->read_at)
                                            <i class="fa-solid fa-check-double" style="color: #4999de;"></i>
                                            <span class="notification-time">{{ $read_at->diffForHumans() }}</span>
                                        @endif
                                            <a class="simbol-hapus hapus_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#hapus_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-trash fa-lg"></i></a>
                                            <a class="simbol-lihat lihat_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#lihat_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Notifikasi SPK Nakes Lain -->

                <!-- Notifikasi Ulang Tahun -->
                <div id="ulang_tahun" class="tab-pane fade">
                    <ul class="notification-list @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Selamat Ulang Tahun'; })->isEmpty()) empty @endif" style="margin-top: 10%;">
                        @if(auth()->user()->unreadNotifications->filter(function ($notification) { return $notification->data['message3'] === 'Selamat Ulang Tahun'; })->isEmpty())
                            <li class="notification-message noti-unread">
                                <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                    <i class="fa-solid fa-bell-slash fa-fade fa-2xl" style="font-size: 40px !important"></i>
                                </p>
                                <p class="noti-details" style="margin-top: 20px; text-align: center; font-size: 18px;">Tidak ada notifikasi baru</p>
                            </li>
                        @endif
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($semua_notifikasi->where('notifiable_id', auth()->id()) as $notifikasi)
                            @php
                                $notifikasiData = json_decode($notifikasi->data);
                                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
                            @endphp
                            @if ($notifikasiData->message3 == 'Selamat Ulang Tahun')
                                <div class="card" data-notification="{{ json_encode($notifikasiData) }}">
                                    <div class="card-header" onclick="toggleCardBody(this)">
                                        {{ $notifikasiData->message3 }}
                                        <span class="arrow-notif"></span><br>
                                        <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                        <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="card-body" style="display:none">
                                        <p><b>{{ ucfirst(strtolower($notifikasiData->message5)) }}</b>, memberikan notifikasi {{ strtolower($notifikasiData->message3) }} kepada Anda. Anda dapat melihat dan menghapus notifikasi ini.</p>
                                        @if ($notifikasi->read_at)
                                            <i class="fa-solid fa-check-double" style="color: #4999de;"></i>
                                            <span class="notification-time">{{ $read_at->diffForHumans() }}</span>
                                        @endif
                                            <a class="simbol-hapus hapus_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#hapus_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-trash fa-lg"></i></a>
                                            <a class="simbol-lihat lihat_notifikasi_{{ $notifikasi->id }}" href="#" data-toggle="modal" data-target="#lihat_notifikasi_{{ $notifikasi->id }}"><i class="fa-solid fa-eye fa-lg"></i></a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Notifikasi Ulang Tahun -->
                
            </div>
            <!-- /Content Notifikasi -->

        </div>
        <!-- /Page Content -->

            <!-- Preview Notifikasi Modal -->
            @foreach ($semua_notifikasi as $notifikasi)
            @php
                $notifikasiData = json_decode($notifikasi->data);
                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
            @endphp
            <div class="modal custom-modal fade" id="lihat_notifikasi_{{ $notifikasi->id }}" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="text-align: center ">Notifikasi <br>{{ $notifikasiData->message3 }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="notification-message noti-read">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="noti-details3">
                                            <a><b>{{ $notifikasiData->name }}</b></a><br>
                                            <a style="font-size: 15px">{{ $notifikasiData->message }} / {{ \Carbon\Carbon::parse($notifikasiData->message2)->format('d F Y') }}</a><br>
                                            <a style="color: #808080; font-weight: 500; font-size: 12px">ID Notifikasi: {{ substr($notifikasi->id, 0, 8) }}</a>
                                        </p><br>
                                        <p class="noti-details4">
                                            <i>{{ $notifikasiData->message4 }} <b>{{ $notifikasiData->message5 }}</b> {{ $notifikasiData->message6 }} {{ $notifikasiData->message7 }}<b>{{ $notifikasiData->message8 }}</b> Kepada <b>{{ $notifikasiData->name }}</b> {{ $notifikasiData->message9 }}</i>
                                        </p><br>
                                        <p class="logo-rsud">
                                            <img src="{{ asset('assets/images/Logo_RSUD_Caruban.png') }}" alt="Logo RSUD Caruban">
                                        </p>
                                        <p class="noti-time2">
                                            <b>RSUD Caruban</b><br>
                                            <i class="fa-solid fa-clock" style="color: #808080;" aria-hidden="true"></i>
                                            <span class="notification-time">{{ $created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- /Preview Notifikasi Modal -->

            <!-- Delete Notifikasi Modal -->
            @foreach ($semua_notifikasi as $notifikasi)
            @php
                $notifikasiData = json_decode($notifikasi->data);
                $created_at = \Carbon\Carbon::parse($notifikasi->created_at);
                $read_at = \Carbon\Carbon::parse($notifikasi->read_at);
            @endphp
            <div class="modal custom-modal fade" id="hapus_notifikasi_{{ $notifikasi->id }}" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Hapus Notifikasi</h3>
                                <p>Apakah anda yakin ingin menghapus notifikasi ini?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('tampilan-semua-notifikasi-hapus-data', $notifikasi->id) }}">
                                            <button type="button" class="btn btn-primary continue-btn submit-btn">Hapus</button>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Delete Notifikasi Modal -->
    </div>

    <!-- /Page Wrapper -->
    <style>
        .notification-list.empty {
            display: block;
        }
    
        .notification-list:not(.empty) {
            display: none;
        }

        .card {
            border: 1px solid #ededed;
            border-radius: 5px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .card-header {
          padding: 15px;
          background-color: rgb(70 70 70 / 17%);
          cursor: pointer;
        }

        .card-body {
          padding: 15px;
          display: none;
        }

        .arrow-notif {
            -webkit-transition: -webkit-transform 0.15s;
            -o-transition: -o-transform 0.15s;
            transition: transform .15s;
            position: absolute;
            right: 25px;
            display: inline-block;
            font-family: 'FontAwesome';
            text-rendering: auto;
            line-height: 40px;
            font-size: 18px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-transform: translate(0, 0);
            -ms-transform: translate(0, 0);
            -o-transform: translate(0, 0);
            transform: translate(0, 0);
            line-height: 18px;
            top: 30px;
        }

        .arrow-notif.up {
            content: "\f105";
        }

        .arrow-notif.down {
            -ms-transform: rotate(90deg);
            -webkit-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .arrow-notif:before {
            content: "\f105";
        }

        .notification-time {
            font-size: 13px;
            line-height: 1.35;
            color: #979797;
        }

        .fa-clock {
            font-size: 12px;
        }

        .fa-check-double {
            font-size: 12px;
        }

        .fa-eye {
            color: black;
        }

        .fa-eye:hover {
            color: #5edd97;
        }

        .fa-trash:hover {
            color: #f43b48;
        }

        @foreach($result_tema as $sql_mode => $mode_tema)
            @foreach($result_tema as $sql_user => $aplikasi_tema)
                @if ($aplikasi_tema->tema_aplikasi == 'Gelap')
                    .card-body{background-color: {{ $mode_tema->warna_dropdown_menu }} !important;}
                    .notification-time{color: {{ $mode_tema->warna_sistem_tulisan}} !important;}
                    .fa-clock{color: {{ $mode_tema->warna_sistem_tulisan}} !important;}
                    .fa-eye{color: {{ $mode_tema->warna_sistem_tulisan}}}
                    .fa-check-double{color: {{ $mode_tema->warna_sistem_tulisan}} !important;}
                    .noti-details4{color: {{ $mode_tema->warna_sistem_tulisan}} !important;}
                    .noti-time2{color: {{ $mode_tema->warna_sistem_tulisan}} !important;}
                @endif
            @endforeach
        @endforeach
      </style>

    @section('script')
        <script>
            function toggleCardBody(header) {
            var cardBody = header.nextElementSibling;
            var arrow = header.querySelector('.arrow-notif');
                if (cardBody.style.display === "none") {
                    cardBody.style.display = "block";
                    arrow.classList.remove('up');
                    arrow.classList.add('down');
                } else if (cardBody.style.display === "block") {
                    cardBody.style.display = "none";
                    arrow.classList.remove('down');
                    arrow.classList.add('up');
                }
            }
        </script>

        <script>
            history.pushState({}, "", '/tampilan/semua/notifikasi');
        </script>
        
        <script>
            document.getElementById('pageTitle').innerHTML = 'Semua Notifikasi | Aplikasi SILK';
        </script>
        
    @endsection
@endsection