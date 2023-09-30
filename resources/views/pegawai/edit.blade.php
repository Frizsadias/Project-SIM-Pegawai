@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="mb-3">Edit Pegawai</h1>

        <form action="{{ route('pegawai.update', $pegawai->user_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Akun</label>
                <select class="form-select" id="name" name="name">
                    <option value="">-- Pilih Nama Akun --</option>
                    @foreach ($userList as $user)
                        <option value="{{ $user->name }}" data-pegawai_id="{{ $user->user_id }}" data-email="{{ $user->email }}" {{ $user->name == $pegawai->user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $pegawai->email }}" readonly>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">ID Pegawai</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $pegawai->user_id }}" readonly>
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pegawai->nama }}">
            </div>

            <div class="mb-3">
                <button type="submit"