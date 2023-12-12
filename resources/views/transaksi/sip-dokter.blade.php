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
                        <h3 class="page-title">SIP Dokter</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">SIP Dokter</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_sip_dokter"><i class="fa fa-plus"></i> Tambah SIP Dokter</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('sip-dokter-cari') }}" method="GET" id="search-form">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="nomor_sip">
                            <label class="focus-label">Nomor SIP Dokter</label>
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
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Unit Kerja</th>
                                    <th>Nomor SIP</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Tanggal Berlaku</th>
                                    <th>SIP Jabatan</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Ruangan</th>
                                    <th>Dokumen SIP</th>
                                    <th class="text-right no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_sip_dokter as $sqlsip => $result_sip)
                                    <tr>
                                        <td>{{ ++$sqlsip }}</td>
                                        <td hidden class="id">{{ $result_sip->id }}</td>
                                        <td class="name">{{ $result_sip->name }}</td>
                                        <td class="nip">{{ $result_sip->nip }}</td>
                                        <td class="unit_kerja">{{ $result_sip->unit_kerja }}</td>
                                        <td class="nomor_sip">{{ $result_sip->nomor_sip }}</td>
                                        <td class="tanggal_terbit">{{ $result_sip->tanggal_terbit }}</td>
                                        <td class="tanggal_berlaku">{{ $result_sip->tanggal_berlaku }}</td>
                                        <td class="sip_spk_jabatan">{{ $result_sip->sip_spk_jabatan }}</td>
                                        <td class="jenis_dokumen">{{ $result_sip->jenis_dokumen }}</td>
                                        <td class="ruangan">{{ $result_sip->ruangan }}</td>
                                        <td class="dokumen_sip">
                                            <a href="{{ asset('assets/DokumenSIPDokter/' . $result_sip->dokumen_sip) }}"
                                                target="_blank">
                                                @if (pathinfo($result_sip->dokumen_sip, PATHINFO_EXTENSION) == 'pdf')
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                @endif
                                                    <td hidden class="dokumen_sip">{{ $result_sip->dokumen_sip }}</td>
                                            </a>
                                        </td>

                                        {{-- Edit Layanan SIP Dokter --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit_sip_dokter" href="#" data-toggle="modal" data-target="#edit_sip_dokter"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item delete_sip_dokter" href="#" data-toggle="modal" data-target="#delete_sip_dokter"><i class="fa fa-trash-o m-r-5"></i>Delete</a>
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

        <!-- Tambah SIP Dokter Modal -->
        <div id="daftar_sip_dokter" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah SIP Dokter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi/sip-dokter/tambah-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                            @foreach ($data_profil_sip as $result_sip)
                                <div class="row">
                                    {{-- <label>Nama</label> --}}
                                    <input type="hidden" class="form-control" name="name" value="{{ $result_sip->name }}" readonly>
                                    {{-- <label>NIP</label> --}}
                                    <input type="hidden" class="form-control" name="nip" value="{{ $result_sip->nip }}" readonly>
                                </div>
                            @endforeach
                            <div class="row">
                                {{-- <label>Jabatan</label> --}}
                                <input type="hidden" class="form-control" name="sip_spk_jabatan" value="Dokter" readonly>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <input type="text" class="form-control" name="unit_kerja"
                                            placeholder="Unit Kerja">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SIP</label>
                                        <input type="text" class="form-control" name="nomor_sip"
                                            placeholder="Nomor SIP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" class="form-control" name="tanggal_terbit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Berlaku</label>
                                        <input type="date" class="form-control" name="tanggal_berlaku">
                                    </div>
                                </div>
                                {{-- <label>Jenis Dokumen</label> --}}
                                <input type="hidden" class="form-control" name="jenis_dokumen" value="SIP Dokter" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <br>
                                        <select class="theSelect" name="ruangan">
                                            <option selected disabled>-- Pilih Ruangan --</option>
                                            @foreach ($ruanganOptions as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SIP</label>
                                        <input type="file" class="form-control" name="dokumen_sip">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tambah SIP Dokter Modal -->

        <!-- Edit SIP Dokter Modal -->
        <div id="edit_sip_dokter" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit SIP Dokter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi/sip-dokter/edit-data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit Kerja</label>
                                        <input type="text" class="form-control" name="unit_kerja" id="e_unit_kerja" placeholder="Unit Kerja" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor SIP</label>
                                        <input type="text" class="form-control" name="nomor_sip" id="e_nomor_sip" placeholder="Nomor SIP" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Terbit</label>
                                        <input type="date" class="form-control" name="tanggal_terbit" id="e_tanggal_terbit" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Berlaku</label>
                                        <input type="date" class="form-control" name="tanggal_berlaku" id="e_tanggal_berlaku" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <br>
                                        <select class="theSelect" name="ruangan" id="e_ruangan">
                                            <option selected disabled>-- Pilih Ruangan --</option>
                                            @foreach($ruanganOptions as $key => $value)
                                                @if (!empty($result_sip->ruangan))
                                                    <option value="{{ $key }}" {{ $key == $result_sip->ruangan ? 'selected' : '' }}>{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dokumen SIP</label>
                                        <input type="file" class="form-control" id="dokumen_sip" name="dokumen_sip">
                                        <input type="hidden" name="hidden_dokumen_sip" id="e_dokumen_sip" value="">
                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit SIP Dokter Modal -->

        <!-- Delete SPK Perawat Modal -->
        <div class="modal custom-modal fade" id="delete_sip_dokter" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus SIP Dokter</h3>
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('transaksi/sip-dokter/hapus-data') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="dokumen_sip" class="d_dokumen_sip_dokter2" value="">
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
        <!-- /Delete SPK Perawat Modal -->

    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script src="{{ asset('assets/js/sipdokter.js') }}"></script>

        <script>
            $(".theSelect").select2();
        </script>

        <script>
            history.pushState({}, "", '/transaksi/sip-dokter');
        </script>

    @endsection
@endsection
