@extends('layouts.master')
@section('content')
        @section('style')
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <script src="https://kit.fontawesome.com/abea6a9d41.js" crossorigin="anonymous"></script>
        <!-- checkbox style -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
        @endsection
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Pengajuan Cuti</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pengajuan Cuti</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#daftar_layanan_cuti"><i class="fa fa-plus"></i> Tambah Pengajuan Cuti</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Cetak Dokumen Kelengkapan PDF -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <select id="pilihDokumenKelengkapan" class="form-control">
                            <option selected disabled> --Pilih Dokumen Kelengkapan --</option>
                            @foreach($data_cuti_pdf as $cuti)
                                <option value="{{ $cuti->id }}">Dokumen Kelengkapan - {{ $cuti->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button id="cetakDokumenKelengkapan" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i> Dokumen Kelengkapan</button>
                    </div>
                
                    <!-- Cetak Dokumen Rekomendasi PDF -->
                    <div class="col-sm-6 col-md-3">
                        <select id="pilihDokumenRekomendasi" class="form-control">
                            <option selected disabled> --Pilih Dokumen Rekomendasi --</option>
                            @foreach($data_cuti_pdf as $cuti)
                                <option value="{{ $cuti->id }}">Dokumen Rekomendasi - {{ $cuti->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button id="cetakDokumenRekomendasi" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i> Dokumen Rekomendasi</button>
                    </div>
                </div>
                <br>
                
                <!-- Search Filter -->
                <form action="{{ route('layanan/cuti/cari/admin') }}" method="GET" id="search-form">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="name">
                                <label class="focus-label">Nama Pegawai</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="jenis_cuti">
                                <label class="focus-label">Jenis Cuti</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" name="status_pengajuan">
                                <label class="focus-label">Status Pengajuan</label>
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
                                            <th>Jenis Cuti</th>
                                            <th>Lama Cuti (Hari)</th>
                                            <th>Sisa Cuti (N2, N1, N)</th>
                                            <th>Tanggal Mulai Cuti</th>
                                            <th>Tanggal Selesai Cuti</th>
                                            <th>Tanggal Pengajuan Cuti</th>
                                            <th>Dokumen Kelengkapan</th>
                                            <th>Dokumen Rekomendasi</th>
                                            <th>Status Permohonan Cuti</th>
                                            <th>Pengajuan Eselon 3</th>
                                            <th class="text-right no-sort">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_cuti as $sqlcuti => $result_cuti)
                                        <tr>
                                            <td>{{ ++$sqlcuti }}</td>
                                            <td hidden class="id">{{ $result_cuti->id }}</td>
                                            <td class="name">{{ $result_cuti->name }}</td>
                                            <td class="nip">{{ $result_cuti->nip }}</td>
                                            <td class="jenis_cuti">{{ $result_cuti->jenis_cuti }}</td>
                                            <td class="lama_cuti">{{ $result_cuti->lama_cuti }}</td>
                                            <td>
                                                {{ date('Y', strtotime('-2 year')) }} = {{ $sisaCutiTwoYearsAgo }} hari,&nbsp;&nbsp;&nbsp;
                                                {{ date('Y', strtotime('-1 year')) }} = {{ $sisaCutiLastYear }} hari,&nbsp;&nbsp;&nbsp;
                                                {{ date('Y') }} = {{ $sisaCutiThisYear }} hari
                                            </td>
                                            <td class="tanggal_mulai_cuti">{{ $result_cuti->tanggal_mulai_cuti }}</td>
                                            <td class="tanggal_selesai_cuti">{{ $result_cuti->tanggal_selesai_cuti }}</td>
                                            <td>{{ \Carbon\Carbon::parse($result_cuti->created_at)->formatLocalized('%d %B %Y') }}</td>
                                            <td class="dokumen_kelengkapan">
                                                <a href="{{ asset('assets/DokumenKelengkapan/' . $result_cuti->dokumen_kelengkapan) }}" target="_blank">
                                                    @if (pathinfo($result_cuti->dokumen_kelengkapan, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                    @endif
                                                        <td hidden class="dokumen_kelengkapan">{{ $result_cuti->dokumen_kelengkapan }}</td>
                                                </a></td>
                                            <td class="dokumen_rekomendasi">
                                                <a href="{{ asset('assets/DokumenRekomendasi/' . $result_cuti->dokumen_rekomendasi) }}" target="_blank">
                                                    @if (pathinfo($result_cuti->dokumen_rekomendasi, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fa fa-file-pdf-o fa-2x" style="color: #1db9aa;" aria-hidden="true"></i>
                                                    @endif
                                                        <td hidden class="dokumen_rekomendasi">{{ $result_cuti->dokumen_rekomendasi }}</td>
                                                </a></td>
                                            <td class="status_pengajuan">
                                                <div class="dropdown">
                                                    <a class="status-persetujuan-superadmin">
                                                        @if ($result_cuti->status_pengajuan == 'Disetujui')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                        @elseif ($result_cuti->status_pengajuan == 'Dalam Proses Persetujuan')
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                        @elseif ($result_cuti->status_pengajuan == 'Ditolak')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                        @endif
                                                        <span class="dropdown_pengajuan">{{ $result_cuti->status_pengajuan }}</span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="persetujuan_eselon3">
                                                <div class="dropdown">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" id="statusDropdown" data-toggle="dropdown" aria-expanded="false">
                                                        @if ($result_cuti->persetujuan_eselon3 == 'Disetujui')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                        @elseif ($result_cuti->persetujuan_eselon3 == 'Dalam Proses Persetujuan')
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                        @elseif ($result_cuti->persetujuan_eselon3 == 'Ditolak')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                        @endif
                                                        <span class="dropdown_pengajuan">{{ $result_cuti->persetujuan_eselon3 }}</span>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                        <form action="{{ route('updateStatus', $result_cuti->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon3" value="Disetujui">
                                                                <i class="fa fa-dot-circle-o text-success"></i> Disetujui
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon3" value="Dalam Proses Persetujuan">
                                                                <i class="fa fa-dot-circle-o text-warning"></i> Dalam Proses Persetujuan
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_eselon3" value="Ditolak">
                                                                <i class="fa fa-dot-circle-o text-danger"></i> Ditolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Edit Layanan Cuti--}}
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit_layanan_cuti" href="#" data-toggle="modal" data-target="#edit_layanan_cuti"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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

                    <!-- Tambah Layanan Cuti Modal -->
                    <div id="daftar_layanan_cuti" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pengajuan Cuti</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('layanan/cuti/tambah-data') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Nama Pegawai</label>
                                                    <select class="select" id="name" name="name">
                                                        <option value="">-- Pilih Nama Pegawai --</option>
                                                        @foreach ($userList as $key => $user)
                                                            <option value="{{ $user->name }}" data-user_id={{ $user->user_id }} data-nip={{ $user->nip }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">ID Pengguna <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="ID pengguna otomatis terisi" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">NIP <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" id="nip" name="nip" placeholder="NIP otomatis terisi" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Cuti</label>
                                                    <select class="select" name="jenis_cuti" id="jenis_cuti">
                                                        <option selected disabled> --Pilih Jenis Cuti --</option>
                                                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                                                        <option value="Cuti Sakit">Cuti Sakit</option>
                                                        <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                                        <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Lama Cuti</label>
                                                    <input type="number" class="form-control" name="lama_cuti" placeholder="Jumlah Hari Cuti">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai Cuti</label>
                                                    <input type="date" class="form-control" name="tanggal_mulai_cuti">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Selesai Cuti</label>
                                                    <input type="date" class="form-control" name="tanggal_selesai_cuti">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="status_pengajuan"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_administrasi"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_eselon3"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_eselon4"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="persetujuan_kepalaruangan"  value="Dalam Proses Persetujuan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Tambah Layanan Cuti Modal -->

                    <!-- Edit Layanan Cuti Modal -->
                    <div id="edit_layanan_cuti" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pengajuan Cuti</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('layanan/cuti/edit-data') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <input type="hidden" name="id" id="e_id" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jenis Cuti</label>
                                                        <select name="jenis_cuti" class="select" id="e_jenis_cuti">
                                                            <option selected disabled> --Pilih Jenis Cuti --</option>
                                                            <option>Cuti Tahunan</option>
                                                            <option>Cuti Sakit</option>
                                                            <option>Cuti Melahirkan</option>
                                                            <option>Cuti Karena Alasan Penting</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Lama Cuti</label>
                                                        <input type="number" class="form-control" name="lama_cuti" id="e_lama_cuti" placeholder="Jumlah Hari Cuti" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Mulai Cuti</label>
                                                        <input type="date" class="form-control" name="tanggal_mulai_cuti" id="e_tanggal_mulai_cuti" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai Cuti</label>
                                                        <input type="date" class="form-control" name="tanggal_selesai_cuti" id="e_tanggal_selesai_cuti" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Kelengkapan</label>
                                                        <input type="file" class="form-control" id="dokumen_kelengkapan" name="dokumen_kelengkapan">
                                                        <input type="hidden" name="hidden_dokumen_kelengkapan" id="e_dokumen_kelengkapan" value="">
                                                        <small class="text-danger">*Harap unggah dokumen dalam format PDF.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dokumen Rekomendasi</label>
                                                        <input type="file" class="form-control" id="dokumen_rekomendasi" name="dokumen_rekomendasi">
                                                        <input type="hidden" name="hidden_dokumen_rekomendasi" id="e_dokumen_rekomendasi" value="">
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
                    <!-- /Edit Layanan Cuti Modal -->
     </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script>
            $(document).ready(function () {
                $('#pilihDokumenRekomendasi').select2();
                $('#cetakDokumenRekomendasi').on('click', function ()
                {
                    const selectedCutiId = $('#pilihDokumenRekomendasi').val();
                    if (selectedCutiId)
                    {
                        const url = "{{ route('layanan-cuti-admin-rekomendasi', ['id' => ':id']) }}".replace(':id', selectedCutiId);
                        window.open(url, '_blank');
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#pilihDokumenKelengkapan').select2();
                $('#cetakDokumenKelengkapan').on('click', function ()
                {
                    const selectedCutiId = $('#pilihDokumenKelengkapan').val();
                    if (selectedCutiId)
                    {
                        const url = "{{ route('layanan-cuti-admin-kelengkapan', ['id' => ':id']) }}".replace(':id', selectedCutiId);
                        window.open(url, '_blank');
                    }
                });
            });
        </script>

        <script src="{{ asset('assets/js/layanancuti.js') }}"></script>
    @endsection
@endsection
