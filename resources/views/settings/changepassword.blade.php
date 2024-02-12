@extends('layouts.master')
@section('content')
    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Ubah Kata Sandi</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    {{-- message --}}
                    {!! Toastr::message() !!}
            
                    <form method="POST" action="{{ route('change/password/db') }}">
                        @csrf
                        <div class="form-group">
                            <label>Kata Sandi Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="passwordInput1" name="current_password" value="{{ old('current_password') }}" placeholder="Masukkan kata sandi lama">
                                <div class="input-group-append">
                                    <button type="button" id="tampilkanPassword1" class="btn btn-outline-secondary">
                                        <i id="icon1" class="fa fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="passwordInput2" name="new_password" placeholder="Masukkan kata sandi baru">
                                <div class="input-group-append">
                                    <button type="button" id="tampilkanPassword2" class="btn btn-outline-secondary">
                                        <i id="icon2" class="fa fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" id="passwordInput3" name="new_confirm_password" placeholder="Konfirmasi kata sandi baru">
                                <div class="input-group-append">
                                    <button type="button" id="tampilkanPassword3" class="btn btn-outline-secondary">
                                        <i id="icon3" class="fa fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            @error('new_confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Ubah Kata Sandi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/lihatkatasandi.js') }}"></script>

        <script>
            @if (Auth::user()->role_name == 'Admin') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Ubah Kata Sandi - Admin | Aplikasi SILK';
            @endif
            @if (Auth::user()->role_name == 'Super Admin') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Ubah Kata Sandi - Super Admin | Aplikasi SILK';
            @endif
            @if (Auth::user()->role_name == 'User') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Ubah Kata Sandi - User | Aplikasi SILK';
            @endif
            @if (Auth::user()->role_name == 'Kepala Ruang') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Ubah Kata Sandi - Kepala Ruang | Aplikasi SILK';
            @endif
            @if (Auth::user()->eselon == '3') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Ubah Kata Sandi - Eselon 3 | Aplikasi SILK';
            @endif
            @if (Auth::user()->eselon == '4') 
                document.getElementById('pageTitle').innerHTML = 'Pengaturan Ubah Kata Sandi - Eselon 4 | Aplikasi SILK';
            @endif
        </script>
        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>

    @endsection
@endsection