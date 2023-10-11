@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"> Pengajuan Cuti</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pengajuan Cuti</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Fungsi Seacrh --}}
            <form action="" method="GET" id="search-form">
                <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="keyword" name="keyword">
                        <label class="focus-label">Nama Pegawai</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                </div>
                </div>
            </form>

            <form action="">
                <div class="row filter-row">
                    <div class="col-sm-12 col-md-6">
                        <input type="text" class="form-control floating" placeholder="NIP" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <input type="text" class="form-control floating" placeholder="Nama Pegawai" readonly>
                    </div>
                </div>
            </form>

            <br>
            <div class="jumbotron">
                <h3>Form Pengajuan Cuti</h3>
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="jenis_cuti">Jenis Cuti:</label>
                                <select class="form-control" id="jenis_cuti" name="jenis_cuti">
                                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                                    <option value="Cuti Sakit">Cuti Sakit</option>
                                    <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                    <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lama_cuti">Lama Cuti:</label>
                                <input type="text" class="form-control" id="lama_cuti" name="lama_cuti">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_mulai_cuti">Tanggal Mulai Cuti:</label>
                                <input type="date" class="form-control" id="tanggal_mulai_cuti" name="tanggal_mulai_cuti">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_selesai_cuti">Tanggal Selesai Cuti:</label>
                                <input type="date" class="form-control" id="tanggal_selesai_cuti" name="tanggal_selesai_cuti">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="dokumen_kelengkapan">Dokumen Kelengkapan:</label>
                            <input type="file" class="form-control" id="dokumen_kelengkapan" name="dokumen_kelengkapan">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dokumen_rekomendasi">Dokumen Rekomendasi:</label>
                                <input type="file" class="form-control" id="dokumen_rekomendasi" name="dokumen_rekomendasi">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary">Batal</button>
                </form>
            </div>
    </div>

    

    <!-- /Page Wrapper -->
@endsection
