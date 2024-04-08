@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">
                {{-- message --}}
                {!! Toastr::message() !!}
                <!-- /Account Logo -->
                <div class="fitur-kembali-2">
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-backward fa-2xl"></i>
                    </a>
                    <span class="fitur-text">Kembali Halaman Login</span>
                </div>
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Menyetel <br>Ulang Kata Sandi</h3>
                        <p class="account-subtitle">Masukkan email anda untuk memperbaharui kata sandi baru.</p>
                        <!-- Account Form -->
                        <form method="POST" action="/ubah-kata-sandi">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label>Alamat E-mail</label>
                                <div class="input-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda">
                                    <div class="input-group-append">
                                        <button type="button" class="form-control-text" disabled>
                                            <i class="fa-solid fa-envelope"></i>
                                        </button>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Kata Sandi</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput1" name="password" placeholder="Masukkan Kata Sandi Baru">
                                    <div class="input-group-append">
                                        <button type="button" id="tampilkanPassword1" class="btn btn-outline-secondary">
                                            <i id="icon1" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="kekuatan-indicator">
                                    <div class="kata-sandi-lemah-after-1"></div>
                                    <div class="kata-sandi-sedang-after-1"></div>
                                    <div id="indicator-kata-sandi-1"></div>
                                    <div class="kata-sandi-lemah-before-1"></div>
                                    <div class="kata-sandi-sedang-before-1"></div>
                                </div>
                                <div id="indicator-kata-sandi-tulisan-1"></div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Konfirmasi Kata Sandi</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput2" name="password_confirmation" placeholder="Konfirmasi Kata Sandi Baru">
                                    <div class="input-group-append">
                                        <button type="button" id="tampilkanPassword2" class="btn btn-outline-secondary">
                                            <i id="icon2" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="kekuatan-indicator">
                                    <div class="kata-sandi-lemah-after-2"></div>
                                    <div class="kata-sandi-sedang-after-2"></div>
                                    <div id="indicator-kata-sandi-2"></div>
                                    <div class="kata-sandi-lemah-before-2"></div>
                                    <div class="kata-sandi-sedang-before-2"></div>
                                </div>
                                <div id="indicator-kata-sandi-tulisan-2"></div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" style="border-radius: 20px" type="submit">Perbaharui</button>
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
        <script src="https://kit.fontawesome.com/95e99ea6db.js" crossorigin="anonymous"></script>

        <script src="{{ asset('assets/js/lihatkatasandi.js') }}"></script>

        <script src="{{ asset('assets/js/indicatorkatasandi.js') }}"></script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Ubah Kata Sandi | Aplikasi SILK';
        </script>
    
    @endsection
@endsection