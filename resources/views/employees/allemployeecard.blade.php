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
                        <h3 class="page-title">Pegawai</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="view-icons">
                            <a href="{{ route('daftar/pegawai/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('daftar/pegawai/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('daftar/pegawai/card/search') }}" method="POST">
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
                    {{-- <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="email">
                            <label class="focus-label">E-mail</label>
                        </div>
                    </div> --}}
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Cari </button>
                    </div>
                </div>
            </form>
            <!-- Search Filter -->

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="dropdown show-entries-dropdown">
                <label>Show
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="showEntriesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="showEntriesValue">12</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="showEntriesDropdown">
                        <a class="dropdown-item" href="#" onclick="showEntries(12)">12</a>
                        <a class="dropdown-item" href="#" onclick="showEntries(24)">24</a>
                        <a class="dropdown-item" href="#" onclick="showEntries(48)">48</a>
                        <a class="dropdown-item" href="#" onclick="showEntries(96)">96</a>
                        <a class="dropdown-item" href="#" onclick="showEntries(156)">156</a>
                        {{-- <a class="dropdown-item" href="#" onclick="showEntries('all')">All</a> --}}
                    </div>
                </label> entries
            </div>

            <div class="row staff-grid-row">
                @foreach ($users as $lists )
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                <a href="{{ url('user/profile/' . $lists->user_id) }}" class="avatar"><img src="{{ URL::to('/assets/images/' . $lists->avatar) }}" alt="{{ $lists->avatar }}" loading="lazy"></a>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a>{{ $lists->name }}</a></h4>
                            <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a>{{ $lists->nip }}</a></h5>
                            {{-- <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a>{{ $lists->email }}</a></h5> --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="dataTables_paginate">
                <ul class="pagination">
                    <li class="paginate_button page-item previous">
                        <a href="#" class="page-link" onclick="previousEntries()">Previous</a>
                    </li>
                    <li class="paginate_button page-item" id="pageButtons">
                    <li class="paginate_button page-item next">
                        <a href="#" class="page-link" onclick="nextEntries()">Next</a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

    <style>
        @foreach($result_tema as $sql_mode => $mode_tema)
            @foreach($result_tema as $sql_user => $aplikasi_tema)
                @if ($aplikasi_tema->tema_aplikasi == 'Gelap')
                    .paginate_button .page-item{background-color: {{ $mode_tema->warna_sistem }} !important; color: {{ $mode_tema->warna_sistem_tulisan }} !important; border: 1px solid {{ $mode_tema->warna_mode}} !important;}
                    .paginate_button .page-item2{background-color: {{ $mode_tema->warna_sistem }} !important; color: {{ $mode_tema->warna_sistem_tulisan }} !important; border: 1px solid {{ $mode_tema->warna_mode}} !important;}
                    .paginate_button .page-item.active{background-color: {{ $mode_tema->warna_mode}} !important; color: {{ $mode_tema->warna_sistem_tulisan }}}
                    .btn-secondary{background-color: {{ $mode_tema->warna_mode}} !important; color: {{ $mode_tema->warna_sistem_tulisan }}}
                    .btn-secondary:hover{background-color: {{ $mode_tema->warna_mode}} !important; color: {{ $mode_tema->warna_sistem_tulisan }}}
                    .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle{background-color: {{ $mode_tema->warna_mode}} !important; color: {{ $mode_tema->warna_sistem_tulisan }}}
                @endif
            @endforeach
        @endforeach
    </style>

    @section('script')
        <script>
            var currentPosition = 0;
            var itemsPerPage = 12;
            var totalPages = 0;
        
            $(document).ready(function() {
                showEntries(12);
            });
        
            function showEntries(num) {
                itemsPerPage = num;
                if (num === 'all') {
                    $('.staff-grid-row .profile-widget').show();
                    $('#showEntriesValue').text('All');
                } else {
                    $('.staff-grid-row .profile-widget').hide();
                    $('.staff-grid-row .profile-widget:lt(' + num + ')').show();
                    $('#showEntriesValue').text(num);
                }
                currentPosition = 0;
                updatePageNumber();
            }
        
            function nextEntries() {
                currentPosition += itemsPerPage;
                if (currentPosition >= totalPages * itemsPerPage) {
                    currentPosition = (totalPages - 1) * itemsPerPage;
                }
                $('.staff-grid-row .profile-widget').hide();
                $('.staff-grid-row .profile-widget').slice(currentPosition, currentPosition + itemsPerPage).show();
                updatePageNumber();
            }
        
            function previousEntries() {
                currentPosition -= itemsPerPage;
                if (currentPosition < 0) {
                    currentPosition = 0;
                }
                $('.staff-grid-row .profile-widget').hide();
                $('.staff-grid-row .profile-widget').slice(currentPosition, currentPosition + itemsPerPage).show();
                updatePageNumber();
            }
        
            function updatePageNumber() {
                var currentPage = Math.floor(currentPosition / itemsPerPage) + 1;
                totalPages = Math.ceil($('.staff-grid-row .profile-widget').length / itemsPerPage);
        
                var pageButtons = $('#pageButtons');
                pageButtons.empty();
        
                if (totalPages <= 5) {
                    for (var i = 1; i <= totalPages; i++) {
                        var buttonClass = (i === currentPage) ? 'paginate_button page-item active' : 'paginate_button page-item';
                        pageButtons.append('<button class="' + buttonClass + '" onclick="goToPage(' + i + ')">' + i + '</button>');
                    }
                } else {
                    if (currentPage <= 3) {
                        for (var i = 1; i <= 5; i++) {
                            var buttonClass = (i === currentPage) ? 'paginate_button page-item active' : 'paginate_button page-item';
                            pageButtons.append('<button class="' + buttonClass + '" onclick="goToPage(' + i + ')">' + i + '</button>');
                        }
                        pageButtons.append('<span class="paginate_button page-item2">...</span>');
                        pageButtons.append('<button class="paginate_button page-item" onclick="goToPage(' + totalPages + ')">' + totalPages + '</button>');
                    } else if (currentPage >= totalPages - 2) {
                        pageButtons.append('<button class="paginate_button page-item" onclick="goToPage(1)">1</button>');
                        pageButtons.append('<span class="paginate_button page-item2">...</span>');
                        for (var i = totalPages - 4; i <= totalPages; i++) {
                            var buttonClass = (i === currentPage) ? 'paginate_button page-item active' : 'paginate_button page-item';
                            pageButtons.append('<button class="' + buttonClass + '" onclick="goToPage(' + i + ')">' + i + '</button>');
                        }
                    } else {
                        pageButtons.append('<button class="paginate_button page-item" onclick="goToPage(1)">1</button>');
                        pageButtons.append('<span class="paginate_button page-item2">...</span>');
                        for (var i = currentPage - 1; i <= currentPage + 1; i++) {
                            var buttonClass = (i === currentPage) ? 'paginate_button page-item active' : 'paginate_button page-item';
                            pageButtons.append('<button class="' + buttonClass + '" onclick="goToPage(' + i + ')">' + i + '</button>');
                        }
                        pageButtons.append('<span class="paginate_button page-item2">...</span>');
                        pageButtons.append('<button class="paginate_button page-item" onclick="goToPage(' + totalPages + ')">' + totalPages + '</button>');
                    }
                }
            }
        
            function goToPage(page) {
                currentPosition = (page - 1) * itemsPerPage;
                $('.staff-grid-row .profile-widget').hide();
                $('.staff-grid-row .profile-widget').slice(currentPosition, currentPosition + itemsPerPage).show();
                updatePageNumber();
            }
        </script>
    
        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>

        <script>
            @if (Auth::user()->role_name == 'Admin') 
                document.getElementById('pageTitle').innerHTML = 'Manajemen Daftar Pegawai - Admin | Aplikasi SILK';
            @endif
            @if (Auth::user()->role_name == 'Super Admin') 
                document.getElementById('pageTitle').innerHTML = 'Informasi Daftar Pegawai - Super Admin | Aplikasi SILK';
            @endif
        </script>

        <script>
            history.pushState({}, "", '/daftar/pegawai/card');
        </script>

    @endsection
@endsection