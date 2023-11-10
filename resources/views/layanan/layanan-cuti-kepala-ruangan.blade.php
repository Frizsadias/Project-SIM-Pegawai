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
                </div>
                <br>
                
                <!-- Search Filter -->
                <form action="{{ route('layanan/cuti/cari/kepala-ruangan') }}" method="GET" id="search-form">
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
                                            <th>Pengajuan Kepala Ruangan</th>
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
                                            <td class="persetujuan_kepalaruangan">
                                                <div class="dropdown">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" id="statusDropdown" data-toggle="dropdown" aria-expanded="false">
                                                        @if ($result_cuti->persetujuan_kepalaruangan == 'Disetujui')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                        @elseif ($result_cuti->persetujuan_kepalaruangan == 'Dalam Proses Persetujuan')
                                                            <i class="fa fa-dot-circle-o text-warning"></i>
                                                        @elseif ($result_cuti->persetujuan_kepalaruangan == 'Ditolak')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                        @endif
                                                        <span class="dropdown_pengajuan">{{ $result_cuti->persetujuan_kepalaruangan }}</span>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                        <form action="{{ route('updateStatus', $result_cuti->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item" name="persetujuan_kepalaruangan" value="Disetujui">
                                                                <i class="fa fa-dot-circle-o text-success"></i> Disetujui
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_kepalaruangan" value="Dalam Proses Persetujuan">
                                                                <i class="fa fa-dot-circle-o text-warning"></i> Dalam Proses Persetujuan
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="persetujuan_kepalaruangan" value="Ditolak">
                                                                <i class="fa fa-dot-circle-o text-danger"></i> Ditolak
                                                            </button>
                                                        </form>
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

     </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script>
            $(document).ready(function () {
                $('#pilihDokumenKelengkapan').select2();
                $('#cetakDokumenKelengkapan').on('click', function ()
                {
                    const selectedCutiId = $('#pilihDokumenKelengkapan').val();
                    if (selectedCutiId)
                    {
                        const url = "{{ route('layanan-cuti-kepala-ruangan-kelengkapan', ['id' => ':id']) }}".replace(':id', selectedCutiId);
                        window.open(url, '_blank');
                    }
                });
            });
        </script>

        <script src="{{ asset('assets/js/layanancuti.js') }}"></script>
    @endsection
@endsection
