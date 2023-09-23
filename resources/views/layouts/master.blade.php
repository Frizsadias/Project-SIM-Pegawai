<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="SoengSouy Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="SoengSouy Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard - Sim Pegawai</title>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
        crossorigin="anonymous"></script>



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
                <a href="{{ route('home') }}" class="logo"
                    style="font-size: 24px; color: #3b5c03; font-weight: bold;">
                    <i class="fa fa-user" style="display: inline-block;"></i>
                    <span class="logo-text" style="display: inline-block;">SIMPEG</span>
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
            <!-- Header Title -->
            <div class="page-title-box">

            </div>
            <!-- /Header Title -->
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Profil -->
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}"
                                alt="{{ Auth::user()->name }}">
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
