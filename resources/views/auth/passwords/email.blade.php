@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">
                {{-- message --}}
                {!! Toastr::message() !!}
                <!-- /Account Logo -->
                <div class="fitur-kembali">
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                    <span class="fitur-text">Kembali Halaman Login</span>
                </div>
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Lupa Kata Sandi</h3>
                        <p class="account-subtitle">Masukkan email Anda untuk mengirimkan tautan mengatur ulang kata sandi.</p>
                        <!-- Account Form -->
                        <form method="POST" action="/lupa-kata-sandi">
                            @csrf
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
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" style="border-radius: 20px" type="submit">Verifikasi</button>
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

        <script>
            document.getElementById('pageTitle').innerHTML = 'Lupa Kata Sandi | Aplikasi SILK';
        </script>

    @endsection
@endsection
