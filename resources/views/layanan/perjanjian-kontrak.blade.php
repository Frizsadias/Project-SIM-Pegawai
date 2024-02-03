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
                        <h3 class="page-title">Perjanjian Kontrak</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Perjanjian Kontrak</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_layanan_kontrak"><i class="fa fa-plus"></i> Tambah Perjanjian Kontrak</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Cetak Dokumen Perjanjian Kontrak PDF -->
            @php
                $lastperjanjian = $data_perjanjian_kontrak->last();
            @endphp
            @if ($lastperjanjian)
                <a href="{{ route('layanan-perjanjian-kontrak', ['id' => $lastperjanjian->id]) }}" target="_blank" class="btn btn-success">
                    <i class="fa-solid fa-file-pdf"></i> Dokumen Perjanjian Kontrak
                </a>
            @else
            @endif
            <br><br>
            <!-- /Cetak Dokumen Perjanjian Kontrak PDF -->

            <!-- Search Filter -->
            <form action="{{ route('layanan/perjanjian-kontrak-cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <input type="date" class="form-control floating" name="mulai_kontrak">
                            <label class="focus-label">Mulai Kontrak</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <input type="date" class="form-control floating" name="akhir_kontrak">
                            <label class="focus-label">Akhir Kontrak</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn_search">Cari</button>
                    </div>
                </div>
             </form>
            <!-- Search Filter -->

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>NIK BLUD</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Pendidikan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Jabatan</th>
                                    <th>Mulai Kontrak</th>
                                    <th>Akhir Kontrak</th>
                                    <th class="text-right no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_perjanjian_kontrak as $sqlkontrak => $result_perjanjian_kontrak)
                                    <tr>
                                        {{-- <td>{{ ++$sqlkontrak }}</td> --}}
                                        <td class="id">{{ $result_perjanjian_kontrak->id }}</td>
                                        <td class="name">{{ $result_perjanjian_kontrak->name }}</td>
                                        <td class="nip">{{ $result_perjanjian_kontrak->nip }}</td>
                                        <td class="nik_blud">{{ $result_perjanjian_kontrak->nik_blud }}</td>
                                        <td class="tempat_lahir">{{ $result_perjanjian_kontrak->tempat_lahir }}</td>
                                        <td class="tanggal_lahir">{{ $result_perjanjian_kontrak->tanggal_lahir }}</td>
                                        <td class="pendidikan">{{ $result_perjanjian_kontrak->pendidikan }}</td>
                                        <td class="tahun_lulus">{{ $result_perjanjian_kontrak->tahun_lulus }}</td>
                                        <td class="jabatan">{{ $result_perjanjian_kontrak->jabatan }}</td>
                                        <td class="mulai_kontrak">{{ $result_perjanjian_kontrak->mulai_kontrak }}</td>
                                        <td class="akhir_kontrak">{{ $result_perjanjian_kontrak->akhir_kontrak }}</td>

                                        {{-- Edit Perjanjian Kontrak --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_kontrak" href="#" data-toggle="modal" data-target="#edit_kontrak"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                                                    <a class="dropdown-item delete_perjanjian" href="#" data-toggle="modal" data-target="#delete_perjanjian"><i class="fa fa-trash-o m-r-5"></i>Delete</a>
                                                    <a href="{{ route('layanan-perjanjian-kontrak-admin', ['id' => $result_perjanjian_kontrak->id]) }}" target="_blank" class="dropdown-item cetak-kontrak"><i class="fa fa-print m-r-5"></i>Cetak</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Tambah Perjanjian Kontrak Modal -->
        <div id="daftar_layanan_kontrak" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Perjanjian Kontrak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('layanan/perjanjian-kontrak/tambah-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK BLUD</label>
                                        <input type="number" class="form-control" name="nik_blud" placeholder="NIK BLUD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input type="number" class="form-control" name="tahun_lulus" placeholder="Tahun Lulus">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai Kontrak</label>
                                        <input type="date" class="form-control" name="mulai_kontrak">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Akhir Kontrak</label>
                                        <input type="date" class="form-control" name="akhir_kontrak">
                                    </div>
                                </div>
                            </div>
                            @foreach ($data_profilpegawai as $profil_pegawai)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ $profil_pegawai->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ $profil_pegawai->tanggal_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="pendidikan" placeholder="Pendidikan" value="{{ $profil_pegawai->tingkat_pendidikan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="name" value="{{ $profil_pegawai->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="nip" value="{{ $profil_pegawai->nip }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($data_posisijabatan as $posisi_jabatan)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="jabatan" placeholder="Jabatan" value="{{ $posisi_jabatan->jabatan }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="submit-section">
                                <button type="submit" id="submit-button" class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tambah Perjanjian Kontrak Modal -->

        <!-- Edit Perjanjian Kontrak Modal -->
        <div id="edit_kontrak" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Perjanjian Kontrak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('layanan/perjanjian-kontrak/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK BLUD</label>
                                        <input type="number" class="form-control" name="nik_blud" id="e_nik_blud" placeholder="NIK BLUD" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input type="number" class="form-control" name="tahun_lulus" id="e_tahun_lulus" placeholder="Tahun Lulus" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai Kontrak</label>
                                        <input type="date" class="form-control" name="mulai_kontrak" id="e_mulai_kontrak" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Akhir Kontrak</label>
                                        <input type="date" class="form-control" name="akhir_kontrak" id="e_akhir_kontrak" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" id="submit-button" class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Perjanjian Kontrak Modal -->

        <!-- Delete Perjanjian Kontrak Modal -->
        <div class="modal custom-modal fade" id="delete_perjanjian" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Perjanjian Kontrak</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('layanan/perjanjian-kontrak/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Hapus</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Perjanjian Kontrak Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/perjanjiankontrak.js') }}"></script>

        <script>
            history.pushState({}, "", '/layanan/perjanjian-kontrak');
        </script>

        <script>
            document.getElementById('pageTitle').innerHTML = 'Layanan Perjanjian Kontrak | Aplikasi SILK';
        </script>
        
    @endsection
@endsection
