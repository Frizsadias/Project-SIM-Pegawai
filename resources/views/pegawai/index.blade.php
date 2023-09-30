@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="mb-3">Daftar Pegawai</h1>

        <div class="mb-3">
            <a href="{{ route('pegawai.create') }}" class="btn btn-success">Tambah Pegawai</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">ID Akun</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $user->user->name }}</td>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->nip }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('pegawai.edit', $user->user_id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('pegawai.destroy', $user->user_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

