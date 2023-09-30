@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="mb-3">Tambah Pegawai</h1>

        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Akun</label>
                <select class="form-select" id="name" name="name">
                    <option value="">-- Pilih Nama Akun --</option>
                    @foreach ($userList as $user)
                        <option value="{{ $user->name }}" data-pegawai_id="{{ $user->user_id }}" data-email="{{ $user->email }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">ID Pegawai</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // select auto id and email
        $('#name').on('change', function() {
            $('#user_id').val($(this).find(':selected').data('pegawai_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
@endsection

