<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="SoengSouy Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="SoengSouy Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard | Aplikasi SILK</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ URL::to('ssets/plugins/morris/morris.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/abea6a9d41.js" crossorigin="anonymous"></script>

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>

<body>
    @yield('style')
    <style>
        .invalid-feedback {
            font-size: 14px;
        }
        .error {
            color: red;
        }
    </style>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Loader -->
        <div id="loader-wrapper">
            <div id="loader">
                <div class="loader-ellips">
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                </div>
            </div>
        </div>
        <!-- /Loader -->

        <!-- Header -->
        <div class="header">
            <!-- Logo -->
            <div class="header-left">
                <a href="{{ route('home') }}" class="logo" style="font-size: 24px; color: #3b5c03; font-weight: bold;">
                    <i class="fa fa-user" style="display: inline-block;"></i>
                    <span class="logo-text" style="display: inline-block;">SILK</span>
                </a>
            </div>

            <!-- /Logo -->
            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <!-- /Header Title -->
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge badge-pill">{{ $unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifikasi</span>
                            <form method="POST" action="{{ route('notifikasi.dibaca-semua') }}">
                                @csrf
                                <button type="submit" class="clear-noti"> Tandai Semua Dibaca </button>
                            </form>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                @if(auth()->user()->unreadNotifications->isEmpty() && auth()->user()->readNotifications->isEmpty())
                                    <li class="notification-message noti-unread">
                                        <p class="noti-details" style="margin-top: 30px; text-align: center;">
                                            <i class="fa-solid fa-bell-slash fa-2xl"></i>
                                        </p>
                                        <p class="noti-details" style="margin-top: 10px; text-align: center;">Tidak ada notifikasi baru</p>
                                    </li>
                                @else
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li class="notification-message noti-unread">
                                        <a href="#" id="open-popup">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::to('/assets/images/' . $notification->data['avatar']) }}">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details">
                                                        <span class="noti-title">{{ $notification->data['name'] }}</span> mendapatkan pesan baru <b>{{ $notification->data['message3'] }}</b>
                                                    </p>
                                                    <p class="noti-time">
                                                        <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                @foreach (auth()->user()->readNotifications as $notification)
                                    <li class="notification-message noti-read">
                                        <a href="#" id="open-popup">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::to('/assets/images/' . $notification->data['avatar']) }}">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details">
                                                        <span class="noti-title">{{ $notification->data['name'] }}</span> mendapatkan pesan baru <b>{{ $notification->data['message3'] }}</b>
                                                    </p>
                                                    <p class="noti-time">
                                                        <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer"><a href="#">Lihat Semua Notifikasi</a></div>
                    </div>
                </li>
				<!-- /Notifications -->

                <!-- Ulang Tahun Modal -->
                <div id="popup-ulangtahun">
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <li class="notification-message noti-unread">
                            <div class="media">
                                <div class="media-body">
                                    <p class="noti-details3">
                                        <br><br><br><b>{{ $notification->data['name'] }}</b><br>
                                        {{ $notification->data['message'] }} / {{ $notification->data['message2'] }}
                                    <br><br></p>
                                    <p class="noti-details2">
                                        <i>{{ $notification->data['message4'] }} <b>{{ $notification->data['message5'] }}</b> {{ $notification->data['message6'] }}<br>
                                        {{ $notification->data['message7'] }} <b>{{ $notification->data['message8'] }}</b><br>
                                        Kepada <b>{{ $notification->data['name'] }}</b> {{ $notification->data['message9'] }}</i>
                                    <br><br></p>
                                    <p class="logo-rsud">
                                        <img src="{{ asset('assets/images/Logo_RSUD_Caruban.png') }}" alt="Logo RSUD Caruban">
                                    </p>
                                    <p class="noti-time2">
                                        <b>RSUD Caruban</b><br>
                                        <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    @foreach (auth()->user()->readNotifications as $notification)
                        <li class="notification-message noti-read">
                            <div class="media">
                                <div class="media-body">
                                    <p class="noti-details3">
                                        <br><br><br><b>{{ $notification->data['name'] }}</b><br>
                                        {{ $notification->data['message'] }} / {{ $notification->data['message2'] }}
                                    <br><br></p>
                                    <p class="noti-details2">
                                        <i>{{ $notification->data['message4'] }} <b>{{ $notification->data['message5'] }}</b> {{ $notification->data['message6'] }}<br>
                                        {{ $notification->data['message7'] }} <b>{{ $notification->data['message8'] }}</b><br>
                                        Kepada <b>{{ $notification->data['name'] }}</b> {{ $notification->data['message9'] }}</i>
                                    <br><br></p>
                                    <p class="logo-rsud">
                                        <img src="{{ asset('assets/images/Logo_RSUD_Caruban.png') }}" alt="Logo RSUD Caruban">
                                    </p>
                                    <p class="noti-time2">
                                        <b>RSUD Caruban</b><br>
                                        <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <div class="close-ulangtahun">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <a href="{{ route('notifikasi.dibaca', $notification->id) }}"><button id="close-popup">Tutup</button></a>
                        @endforeach
                        @foreach (auth()->user()->readNotifications as $notification)
                            <a href="{{ route('notifikasi.dibaca', $notification->id) }}"><button id="close-popup">Tutup</button></a>
                        @endforeach
                    </div>
                    
                    <br>
                </div>
                <!-- /Ulang Tahun Modal -->

                <!-- Profil -->
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                            <span class="status online"></span>
                        </span>
                        <span>{{ Session::get('name') }}</span>
                    </a>
                    <div class="dropdown-menu">
                        @if (Auth::user()->role_name == 'Admin')
                            <a class="dropdown-item" href="{{ route('admin-profile') }}">Profil Saya</a>
                        @endif
                        @if (Auth::user()->role_name == 'Super Admin')
                            <a class="dropdown-item" href="{{ route('super-admin-profile') }}">Profil Saya</a>
                        @endif
                        @if (Auth::user()->role_name == 'User')
                            <a class="dropdown-item" href="{{ route('user-profile') }}">Profil Saya</a>
                        @endif
                        @if (Auth::user()->role_name == 'Admin' || Auth::user()->role_name == 'Super Admin')
                            <a class="dropdown-item" href="{{ route('pengaturan-perusahaan') }}">Pengaturan</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                @if (Auth::user()->role_name == 'Admin')
                    <a class="dropdown-item" href="{{ route('admin-profile') }}">Profil Saya</a>
                @endif
                @if (Auth::user()->role_name == 'Super Admin')
                    <a class="dropdown-item" href="{{ route('super-admin-profile') }}">Profil Saya</a>
                @endif
                @if (Auth::user()->role_name == 'User')
                    <a class="dropdown-item" href="{{ route('user-profile') }}">Profil Saya</a>
                @endif
                @if (Auth::user()->role_name == 'Admin' || Auth::user()->role_name == 'Super Admin')
                    <a class="dropdown-item" href="{{ route('pengaturan-perusahaan') }}">Pengaturan</a>
                @endif
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->

        </div>
        <!-- /Header -->
        <!-- Sidebar -->
        @include('sidebar.sidebar')
        <!-- /Sidebar -->
        <!-- Page Wrapper -->
        @yield('content')
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/chart.js') }}"></script>
    <script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/line-chart.js') }}"></script>
    <!-- Slimscroll JS -->
    <script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
    <!-- Datetimepicker JS -->
    <script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- Datatable JS -->
    <script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Multiselect JS -->
    <script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>
    <!-- validation-->
    <script src="{{ URL::to('assets/js/jquery.validate.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ URL::to('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/master.js') }}"></script>



    <script>
        var toggleBtn = document.getElementById("toggle_btn");
        var logoText = document.querySelector(".logo-text");
        var faUser = document.querySelector(".fa-user");

        toggleBtn.addEventListener("click", function() {
            if (logoText.style.display === "none") {
                logoText.style.display = "inline-block";
                faUser.style.display = "inline-block";
            } else {
                logoText.style.display = "none";
                faUser.style.display = "inline-block";
            }
        });
    </script>
    @yield('script')
    
</body>

</html>
