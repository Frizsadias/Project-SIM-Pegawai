@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">         
                {{-- message --}}
                {!! Toastr::message() !!}
                <!-- /Account Logo -->
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">SILK</h3>
                        <h3 class="account-title2">Sistem Informasi Layanan Kepegawaian</h3><br>
                        <!-- Account Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>NIP/NIKB</label>
                                <input type="text" class="form-control @error('nip_or_no_dokumen') is-invalid @enderror" name="nip_or_no_dokumen" value="{{ old('nip_or_no_dokumen') }}" placeholder="Masukkan NIP atau NIKB">
                                @error('nip_or_no_dokumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Kata Sandi</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput1" name="password" placeholder="Masukkan Kata Sandi">
                                    <div class="input-group-append">
                                        <button type="button" id="tampilkanPassword1" class="btn btn-outline-secondary">
                                            <i id="icon1" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label></label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{ route('forget-password') }}">Lupa Kata Sandi?
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">Masuk</button>
                            </div>
                            <div class="col-auto">
                                <a class="text-muted" href="{{ route('forget-password') }}">
                            </div>
                            <div class="account-footer">
                                <a style="color: #8e8e8e;"><strong>Copyright &copy;2023 - <script>document.write(new Date().getFullYear())</script> RSUD CARUBAN.</strong></a><br>
                                <p style="color: #8e8e8e;">All rights reserved.</p>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script src="{{ asset('assets/js/lihatkatasandi.js') }}"></script>
    @endsection
@endsection
