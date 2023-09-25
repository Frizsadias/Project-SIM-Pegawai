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
                        <h3 class="account-title">Lupa Password</h3>
                        <p class="account-subtitle">Masukkan email Anda untuk mengirimkan tautan reset password.</p>
                        <!-- Account Form -->
                        <form method="POST" action="/forget-password">
                            @csrf
                            <div class="form-group">
                                <label>Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">KIRIM</button>
                            </div>
                            {{-- <div class="account-footer">
                                <p>"Belum memiliki akun?" <a href="{{ route('login') }}">Login</a></p>
                            </div> --}}
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
