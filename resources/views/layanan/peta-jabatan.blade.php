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
                                <h3 class="page-title"> Struktur Peta Jabatan Aplikasi</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Peta Jabatan Aplikasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <div class="dash-widget-info">
                                <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;">Peta Jabatan PDF</span></center>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ( $peta_jabatan_pdf as $peta_jabatan)
                    <iframe src="{{ asset('assets/PetaJabatan/' . $peta_jabatan->pdf_peta) }}" width="100%" height="600"></iframe>
                @endforeach
            </div>

            <div class="page-wrapper">
                <div class="col-md-12">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <div class="dash-widget-info">
                                <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;">Peta Jabatan Animasi</span></center>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="{{ asset('assets/js/querypetajabatan.js') }}"></script>
                <div id="peta-jabatan-animasi"></div>
            </div>

            <body>
                <script>
                    var chart = new OrgChart(document.getElementById("peta-jabatan-animasi"), {
                        template: "ula",
                        mouseScrool: OrgChart.none,
                        nodeBinding: {
                            field_0: "Nama Pegawai",
                            field_1: "Jabatan",
                            img_0: "Foto"
                        },
                        editForm:{
                            FotoBinding: 'Foto'
                        },
                        nodeMenu: {
                            details: { text: "Detail" },
                        }
                    });
                    chart.load([
                        {
                            @foreach ($peta_jabatan_animasi as $Direktur)
                                @if ($Direktur->jabatan == 'Direktur')
                                    id: 1,
                                    "Nama Pegawai": "{{ $Direktur->name }}",
                                    Jabatan: "{{ $Direktur->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $Direktur->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KepalaBagianTataUsaha)
                                @if ($KepalaBagianTataUsaha->jabatan == 'Kepala Bagian Tata Usaha')
                                    id: 2,
                                    pid: 1,
                                    "Nama Pegawai": "{{ $KepalaBagianTataUsaha->name }}",
                                    Jabatan: "{{ $KepalaBagianTataUsaha->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KepalaBagianTataUsaha->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KepalaBidangPelayanan)
                                @if ($KepalaBidangPelayanan->jabatan == 'Kepala Bidang Pelayanan')
                                    id: 3,
                                    pid: 1,
                                    "Nama Pegawai": "{{ $KepalaBidangPelayanan->name }}",
                                    Jabatan: "{{ $KepalaBidangPelayanan->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KepalaBidangPelayanan->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KepalaBidangPenunjang)
                                @if ($KepalaBidangPenunjang->jabatan == 'Kepala Bidang Penunjang')
                                    id: 4,
                                    pid: 1,
                                    "Nama Pegawai": "{{ $KepalaBidangPenunjang->name }}",
                                    Jabatan: "{{ $KepalaBidangPenunjang->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KepalaBidangPenunjang->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KepalaBidangKeuangan)
                                @if ($KepalaBidangKeuangan->jabatan == 'Kepala Bidang Keuangan')
                                    id: 5,
                                    pid: 1,
                                    "Nama Pegawai": "{{ $KepalaBidangKeuangan->name }}",
                                    Jabatan: "{{ $KepalaBidangKeuangan->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KepalaBidangKeuangan->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasubagUmum)
                                @if ($KasubagUmum->jabatan == 'Kasubag Umum')
                                    id: 6,
                                    pid: 2,
                                    "Nama Pegawai": "{{ $KasubagUmum->name }}",
                                    Jabatan: "{{ $KasubagUmum->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasubagUmum->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasubagKepegawaian)
                                @if ($KasubagKepegawaian->jabatan == 'Kasubag Kepegawaian')
                                    id: 7,
                                    pid: 2,
                                    "Nama Pegawai": "{{ $KasubagKepegawaian->name }}",
                                    Jabatan: "{{ $KasubagKepegawaian->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasubagKepegawaian->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasubagPerencanaanInformasi)
                                @if ($KasubagPerencanaanInformasi->jabatan == 'Kasubag Perencanaan dan Informasi')
                                    id: 8,
                                    pid: 2,
                                    "Nama Pegawai": "{{ $KasubagPerencanaanInformasi->name }}",
                                    Jabatan: "{{ $KasubagPerencanaanInformasi->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasubagPerencanaanInformasi->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasiPelayananMedik)
                                @if ($KasiPelayananMedik->jabatan == 'Kasi Pelayanan Medik')
                                    id: 9,
                                    pid: 3,
                                    "Nama Pegawai": "{{ $KasiPelayananMedik->name }}",
                                    Jabatan: "{{ $KasiPelayananMedik->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasiPelayananMedik->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasiPelayananKeperawatan)
                                @if ($KasiPelayananKeperawatan->jabatan == 'Kasi Pelayanan Keperawatan')
                                    id: 10,
                                    pid: 3,
                                    "Nama Pegawai": "{{ $KasiPelayananKeperawatan->name }}",
                                    Jabatan: "{{ $KasiPelayananKeperawatan->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasiPelayananKeperawatan->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasiPenunjangMedik)
                                @if ($KasiPenunjangMedik->jabatan == 'Kasi Penunjang Medik')
                                    id: 11,
                                    pid: 4,
                                    "Nama Pegawai": "{{ $KasiPenunjangMedik->name }}",
                                    Jabatan: "{{ $KasiPenunjangMedik->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasiPenunjangMedik->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasiPenunjangNonMedik)
                                @if ($KasiPenunjangNonMedik->jabatan == 'Kasi Penunjang Non Medik')
                                    id: 12,
                                    pid: 4,
                                    "Nama Pegawai": "{{ $KasiPenunjangNonMedik->name }}",
                                    Jabatan: "{{ $KasiPenunjangNonMedik->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasiPenunjangNonMedik->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasiAnggaranMobilisasiDana)
                                @if ($KasiAnggaranMobilisasiDana->jabatan == 'Kasi Anggaran dan Mobilisasi Dana')
                                    id: 13,
                                    pid: 5,
                                    "Nama Pegawai": "{{ $KasiAnggaranMobilisasiDana->name }}",
                                    Jabatan: "{{ $KasiAnggaranMobilisasiDana->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasiAnggaranMobilisasiDana->avatar) }}"
                                @endif
                            @endforeach
                        },
                        {
                            @foreach ($peta_jabatan_animasi as $KasiVerifikasiAkuntansi)
                                @if ($KasiVerifikasiAkuntansi->jabatan == 'Kasi Verifikasi dan Akuntansi')
                                    id: 14,
                                    pid: 5,
                                    "Nama Pegawai": "{{ $KasiVerifikasiAkuntansi->name }}",
                                    Jabatan: "{{ $KasiVerifikasiAkuntansi->jabatan }}",
                                    Foto: "{{ asset('assets/images/' . $KasiVerifikasiAkuntansi->avatar) }}"
                                @endif
                            @endforeach
                        },
                    ]);
                </script>
            </body>
@endsection
