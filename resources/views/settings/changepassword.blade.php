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
                                <h3 class="page-title">Ubah Password</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <form method="POST" action="{{ route('change/password/db') }}">
                        @csrf
                        <div class="form-group">
                            <label>Kata Sandi Lama</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror " name="current_password" value="{{ old('current_password') }}" placeholder="Masukkan kata sandi lama">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Masukkan kata sandi baru">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" placeholder="Konfirmasi kata sandi baru">
                            @error('new_confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection