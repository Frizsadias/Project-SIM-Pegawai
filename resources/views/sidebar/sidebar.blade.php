<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ set_active(['home']) }}">
                    <a href="{{ route('home') }}" class="{{ set_active(['home']) ? 'noti-dot' : '' }}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role_name == 'Admin')
                    <li class="{{set_active(['manajemen/pengguna','riwayat/aktivitas','riwayat/aktivitas/otentikasi'])}} submenu">
                        <a href="#" class="{{ set_active(['manajemen/pengguna','riwayat/aktivitas','riwayat/aktivitas/otentikasi']) ? 'noti-dot' : '' }}">
                            <i class="la la-server"></i>
                            <span> Manajemen Sistem</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['manajemen/pengguna','manajemen/pengguna'])}}" href="{{ route('manajemen-pengguna') }}"> <span>Daftar Pengguna</span></a></li>
                        <li><a class="{{set_active(['riwayat/aktivitas','riwayat/aktivitas'])}}" href="{{ route('riwayat-aktivitas') }}"> <span>Riwayat Aktivitas</span></a></li>
                        <li><a class="{{set_active(['riwayat/aktivitas/otentikasi','riwayat/aktivitas/otentikasi'])}}" href="{{ route('riwayat-aktivitas-otentikasi') }}"> <span>Aktivitas Pengguna</span></a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Struktur Organisasi</span>
                    <li class="{{ request()->routeIs('peta-jabatan') ? 'active' : '' }}">
                        <a href="{{ route('peta-jabatan') }}" class="{{ request()->routeIs('peta-jabatan') ? 'noti-dot' : '' }}">
                            <i class="la la-sitemap"></i>
                            <span> Peta Jabatan</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Data Referensi </span>
                    <li class="{{ request()->routeIs('referensi-agama') ? 'active' : '' }}">
                        <a href="{{ route('referensi-agama') }}"
                            class="{{ request()->routeIs('referensi-agama') ? 'noti-dot' : '' }}">
                            <i class="las la-star-and-crescent"></i>
                            <span>Agama</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('referensi-status') ? 'active' : '' }}">
                        <a href="{{ route('referensi-status') }}" class="{{ request()->routeIs('referensi-status') ? 'noti-dot' : '' }}">
                            <i class="la la-map"></i>
                            <span>Status</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('referensi-kedudukan') ? 'active' : '' }}">
                        <a href="{{ route('referensi-kedudukan') }}" class="{{ request()->routeIs('referensi-kedudukan') ? 'noti-dot' : '' }}">
                            <i class="la la-trello"></i>
                            <span>Kedudukan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('referensi-pangkat') ? 'active' : '' }}">
                        <a href="{{ route('referensi-pangkat') }}" class="{{ request()->routeIs('referensi-pangkat') ? 'noti-dot' : '' }}">
                            <i class="la la-sort-amount-up"></i>
                            <span>Pangkat</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('referensi-pendidikan') ? 'active' : '' }}">
                        <a href="{{ route('referensi-pendidikan') }}"
                            class="{{ request()->routeIs('referensi-pendidikan') ? 'noti-dot' : '' }}">
                            <i class="la la-mortar-board"></i>
                            <span>Pendidikan</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('unit-kerja') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('unit-kerja') ? 'noti-dot' : '' }}">
                            <i class="la la-laptop"></i>
                            <span>Unit Kerja</span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->routeIs('referensi-sumpah') ? 'active' : '' }}">
                        <a href="{{ route('referensi-sumpah') }}" class="{{ request()->routeIs('referensi-sumpah') ? 'noti-dot' : '' }}">
                            <i class="la la-gavel"></i>
                            <span>Sumpah</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('referensi-ruangan') ? 'active' : '' }}">
                        <a href="{{ route('referensi-ruangan') }}" class="{{ request()->routeIs('referensi-ruangan') ? 'noti-dot' : '' }}">
                            <i class="las la-warehouse"></i>
                            <span>Ruangan</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Manajemen Pegawai</span> </li>
                    <li
                        class="{{ request()->routeIs('daftar/pegawai/list','daftar/pegawai/card') || request()->routeIs('daftar/pegawai/card') ? 'active' : '' }}">
                        <a href="{{ route('daftar/pegawai/list', 'daftar/pegawai/card') }}"
                            class="{{ request()->routeIs('daftar/pegawai/list', 'daftar/pegawai/card') || request()->routeIs('daftar/pegawai/card') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i>
                            <span>Daftar Pegawai</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('daftar/pegawai/pensiun/list','daftar/pegawai/pensiun/card') || request()->routeIs('daftar/pegawai/pensiun/card') ? 'active' : '' }}">
                        <a href="{{ route('daftar/pegawai/pensiun/list', 'daftar/pegawai/pensiun/card') }}" class="{{ request()->routeIs('daftar/pegawai/pensiun/list', 'daftar/pegawai/pensiun/card') || request()->routeIs('daftar/pegawai/pensiun/card') ? 'noti-dot' : '' }}">
                            <i class="la la-level-down"></i>
                            <span>Pegawai Pensiun</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Layanan Kepegawaian </span> </li>
                    <li class="{{ request()->routeIs('kenaikan-gaji-berkala-admin') ? 'active' : '' }}">
                        <a href="{{ route('kenaikan-gaji-berkala-admin') }}" class="{{ request()->routeIs('kenaikan-gaji-berkala-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-money"></i>
                            <span>Kenaikan Gaji Berkala</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('layanan-cuti-admin') ? 'active' : '' }}">
                        <a href="{{ route('layanan-cuti-admin') }}" class="{{ request()->routeIs('layanan-cuti-admin') ? 'noti-dot' : '' }}">
                            <i class="las la-newspaper"></i>
                            <span>Pengajuan Cuti</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('perjanjian-kontrak-admin') ? 'active' : '' }}">
                        <a href="{{ route('perjanjian-kontrak-admin') }}" class="{{ request()->routeIs('perjanjian-kontrak-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-calendar-check-o"></i>
                            <span>Perjanjian Kontrak</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('perjanjian-kinerja-admin') ? 'active' : '' }}">
                        <a href="{{ route('perjanjian-kinerja-admin') }}" class="{{ request()->routeIs('perjanjian-kinerja-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-calendar-check-o"></i>
                            <span>Perjanjian Kinerja</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('perpanjang-kontrak-admin') ? 'active' : '' }}">
                        <a href="{{ route('perpanjang-kontrak-admin') }}" class="{{ request()->routeIs('perpanjang-kontrak-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-calendar-alt"></i>
                            <span>Perpanjangan Kontrak</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('sip-dokter-admin') ? 'active' : '' }}">
                        <a href="{{ route('sip-dokter-admin') }}" class="{{ request()->routeIs('sip-dokter-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-file-alt"></i>
                            <span>SIP Dokter</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('spk-dokter-admin') ? 'active' : '' }}">
                        <a href="{{ route('spk-dokter-admin') }}" class="{{ request()->routeIs('spk-dokter-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-file-alt"></i>
                            <span>SPK Dokter</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('spk-perawat-admin') ? 'active' : '' }}">
                        <a href="{{ route('spk-perawat-admin') }}" class="{{ request()->routeIs('spk-perawat-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-file-alt"></i>
                            <span>SPK Perawat</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('spk-nakes-lain-admin') ? 'active' : '' }}">
                        <a href="{{ route('spk-nakes-lain-admin') }}" class="{{ request()->routeIs('spk-nakes-lain-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-file-alt"></i>
                            <span>SPK Nakes Lain</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('surat-tanda-registrasi-admin') ? 'active' : '' }}">
                        <a href="{{ route('surat-tanda-registrasi-admin') }}" class="{{ request()->routeIs('surat-tanda-registrasi-admin') ? 'noti-dot' : '' }}">
                            <i class="la la-folder-open"></i>
                            <span>Surat Tanda Registrasi</span>
                        </a>
                    </li>
                    {{-- <li class="menu-title"> <span>Data Statistik </span> </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-list"></i>
                            <span>Daftar Urut Kepangkatan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-exclamation"></i>
                            <span>Hukuman Disiplin</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-venus"></i>
                            <span>Jenis Kelamin</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-university"></i>
                            <span>Tingkat Pendidikan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-industry"></i>
                            <span>Golongan Ruang</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-info"></i>
                            <span>Jabatan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-male"></i>
                            <span>Kelompok Umur</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-map-signs"></i>
                            <span>Jenis Pegawai</span>
                        </a>
                    </li>

                    <li class="menu-title"> <span>Laporan </span> </li>
                    <li class="{{ set_active(['search/user/list']) }} submenu">
                        <a href="#" class="{{ set_active(['search/user/list']) ? 'noti-dot' : '' }}">
                            <i class="la la-file"></i> <span> Laporan</span>
                        </a>
                    </li> --}}

                    {{-- <li class="menu-title">
                        <span>Informasi Riwayat</span>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-pendidikan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-pendidikan') }}"
                            class="{{ request()->routeIs('riwayat-pendidikan') ? 'noti-dot' : '' }}">
                            <i class="la la-mortar-board"></i>
                            <span>Riwayat Pendidikan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-golongan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-golongan') }}"
                            class="{{ request()->routeIs('riwayat-golongan') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i>
                            <span>Riwayat Golongan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-jabatan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-jabatan') }}"
                            class="{{ request()->routeIs('riwayat-jabatan') ? 'noti-dot' : '' }}">
                            <i class="la la-area-chart"></i>
                            <span>Riwayat Jabatan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-diklat') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-diklat') }}"
                            class="{{ request()->routeIs('riwayat-diklat') ? 'noti-dot' : '' }}">
                            <i class="la la-suitcase"></i>
                            <span>Riwayat Diklat</span>
                        </a>
                    </li> --}}

                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['admin/profile']) }}">
                        <a href="{{ route('admin-profile') }}"
                            class="{{ set_active(['admin/profile']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                    <li class="{{ set_active(['admin/kata-sandi']) }}">
                        <a href="{{ route('admin-kata-sandi') }}"
                            class="{{ set_active(['admin/kata-sandi']) ? 'noti-dot' : '' }}">
                            <i class="la la-key"></i>
                            <span> Ubah Password</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_name == 'Super Admin')
                    <li class="menu-title"> <span>Informasi Pegawai</span> </li>
                    <li class="{{ request()->routeIs('daftar/pegawai/list','daftar/pegawai/card') || request()->routeIs('daftar/pegawai/card') ? 'active' : '' }}">
                        <a href="{{ route('daftar/pegawai/list', 'daftar/pegawai/card') }}" class="{{ request()->routeIs('daftar/pegawai/list', 'daftar/pegawai/card') || request()->routeIs('daftar/pegawai/card') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i>
                            <span>Daftar Pegawai</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Data Statistik</span> </li>
                    <li class="{{ set_active(['rekapitulasi']) }}">
                        <a href="{{ route('rekapitulasi') }}"
                            class="{{ set_active(['rekapitulasi']) ? 'noti-dot' : '' }}">
                            <i class="la la-pie-chart"></i>
                            <span> Data Statistik</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-files-o"></i>
                            <span>Laporan</span>
                        </a>
                    </li> --}}
                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['super-admin/profile']) }}">
                        <a href="{{ route('super-admin-profile') }}"
                            class="{{ set_active(['super-admin/profile']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                    <li class="{{ set_active(['super-admin/kata-sandi']) }}">
                        <a href="{{ route('super-admin-kata-sandi') }}"
                            class="{{ set_active(['super-admin/kata-sandi']) ? 'noti-dot' : '' }}">
                            <i class="la la-key"></i>
                            <span> Ubah Password</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_name == 'Kepala Ruang')
                    <li class="menu-title"> <span>Layanan Kepegawaian </span> </li>
                    <li class="{{ request()->routeIs('layanan-cuti-kepala-ruangan') ? 'active' : '' }}">
                        <a href="{{ route('layanan-cuti-kepala-ruangan') }}" class="{{ request()->routeIs('layanan-cuti-kepala-ruangan') ? 'noti-dot' : '' }}">
                            <i class="las la-newspaper"></i>
                            <span>Pengajuan Cuti</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Informasi Ruangan </span> </li>
                    <li class="{{ request()->routeIs('daftar/ruangan/pegawai/list','daftar/ruangan/pegawai/card') || request()->routeIs('daftar/ruangan/pegawai/card') ? 'active' : '' }}">
                        <a href="{{ route('daftar/ruangan/pegawai/list', 'daftar/ruangan/pegawai/card') }}" class="{{ request()->routeIs('daftar/ruangan/pegawai/list', 'daftar/ruangan/pegawai/card') || request()->routeIs('daftar/ruangan/pegawai/card') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i>
                            <span>Daftar Ruangan</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['kepala-ruangan/profile']) }}">
                        <a href="{{ route('kepala-ruangan-profile') }}"
                            class="{{ set_active(['kepala-ruangan/profile']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                    <li class="{{ set_active(['kepala-ruangan/kata-sandi']) }}">
                        <a href="{{ route('kepala-ruangan-kata-sandi') }}"
                            class="{{ set_active(['kepala-ruangan/kata-sandi']) ? 'noti-dot' : '' }}">
                            <i class="la la-key"></i>
                            <span> Ubah Password</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_name == 'User')
                    <li class="menu-title"> <span>Data Riwayat </span> </li>
                    <li class="{{ request()->routeIs('riwayat-golongan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-golongan') }}"
                            class="{{ request()->routeIs('riwayat-golongan') ? 'noti-dot' : '' }}">
                            <i class="la la-black-tie"></i>
                            <span>Pangkat/Golongan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-pendidikan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-pendidikan') }}"
                            class="{{ request()->routeIs('riwayat-pendidikan') ? 'noti-dot' : '' }}">
                            <i class="la la-mortar-board"></i>
                            <span>Pendidikan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-jabatan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-jabatan') }}"
                            class="{{ request()->routeIs('riwayat-jabatan') ? 'noti-dot' : '' }}">
                            <i class="la la-area-chart"></i>
                            <span>Jabatan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-pmk') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-pmk') }}" class="{{ request()->routeIs('riwayat-pmk') ? 'noti-dot' : '' }}">
                            <i class="la la-sliders"></i>
                            <span>Peninjauan Masa Kerja</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-info"></i>
                            <span>CPNS/PNS</span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->routeIs('riwayat-diklat') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-diklat') }}"
                            class="{{ request()->routeIs('riwayat-diklat') ? 'noti-dot' : '' }}">
                            <i class="la la-slack"></i>
                            <span> Diklat/Kursus</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-orangtua') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-orangtua') }}" class="{{ request()->routeIs('riwayat-orangtua') ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span>Orang Tua</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-pasangan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-pasangan') }}" class="{{ request()->routeIs('riwayat-pasangan') ? 'noti-dot' : '' }}">
                            <i class="la la-heart"></i>
                            <span>Pasangan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-anak') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-anak') }}" class="{{ request()->routeIs('riwayat-anak') ? 'noti-dot' : '' }}">
                            <i class="la la-child"></i>
                            <span>Anak</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-quote-left"></i>
                            <span>SKP</span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->routeIs('riwayat-penghargaan') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-penghargaan') }}" class="{{ request()->routeIs('riwayat-penghargaan') ? 'noti-dot' : '' }}">
                            <i class="la la-certificate"></i>
                            <span>Penghargaan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-organisasi') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-organisasi') }}" class="{{ request()->routeIs('riwayat-organisasi') ? 'noti-dot' : '' }}">
                            <i class="la la-building-o"></i>
                            <span>Organisasi</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-tugas-belajar') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-tugas-belajar') }}" class="{{ request()->routeIs('riwayat-tugas-belajar') ? 'noti-dot' : '' }}">
                            <i class="la la-bookmark-o"></i>
                            <span>Tugas Belajar</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-bookmark-o"></i>
                            <span>Pencantuman Gelar</span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->routeIs('riwayat-hukuman-disiplin') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-hukuman-disiplin') }}" class="{{ request()->routeIs('riwayat-hukuman-disiplin') ? 'noti-dot' : '' }}">
                            <i class="la la-gavel"></i>
                            <span>Hukuman Disiplin</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-angka-kredit') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-angka-kredit') }}" class="{{ request()->routeIs('riwayat-angka-kredit') ? 'noti-dot' : '' }}">
                            <i class="la la-bank"></i>
                            <span>Angka Kredit</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-wrench"></i>
                            <span>Kinerja</span>
                        </a>
                    </li> --}}
                    {{-- <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-pied-piper-alt"></i>
                            <span>Profesi</span>
                        </a>
                    </li> --}}
                    <li class="menu-title"> <span>Layanan Kepegawaian</span></li>
                    <li class="{{ request()->routeIs('kenaikan-gaji-berkala') ? 'active' : '' }}">
                        <a href="{{ route('kenaikan-gaji-berkala') }}" class="{{ request()->routeIs('kenaikan-gaji-berkala') ? 'noti-dot' : '' }}">
                            <i class="la la-money"></i>
                            <span>Kenaikan Gaji Berkala</span>
                        </a>
                    </li>
                    
                    @if (Auth::user()->role_name == 'User' && Auth::user()->eselon == '-')
                        <li class="{{ request()->routeIs('layanan-cuti') ? 'active' : '' }}">
                            <a href="{{ route('layanan-cuti') }}" class="{{ request()->routeIs('layanan-cuti') ? 'noti-dot' : '' }}">
                                <i class="las la-newspaper"></i>
                                <span>Pengajuan Cuti</span>
                            </a>
                        </li>

                        @elseif (Auth::user()->role_name == 'User' && Auth::user()->eselon == '3')
                        <li class="{{ request()->routeIs('layanan-cuti-eselon3') ? 'active' : '' }}">
                            <a href="{{ route('layanan-cuti-eselon3') }}" class="{{ request()->routeIs('layanan-cuti-eselon3') ? 'noti-dot' : '' }}">
                                <i class="las la-newspaper"></i>
                                <span>Pengajuan Cuti</span>
                            </a>
                        </li>

                        @elseif (Auth::user()->role_name == 'User' && Auth::user()->eselon == '4')
                        <li class="{{ request()->routeIs('layanan-cuti-eselon4') ? 'active' : '' }}">
                            <a href="{{ route('layanan-cuti-eselon4') }}" class="{{ request()->routeIs('layanan-cuti-eselon4') ? 'noti-dot' : '' }}">
                                <i class="las la-newspaper"></i>
                                <span>Pengajuan Cuti</span>
                            </a>
                        </li>
                    @endif

                    <li class="{{ request()->routeIs('perjanjian-kontrak') ? 'active' : '' }}">
                        <a href="{{ route('perjanjian-kontrak') }}" class="{{ request()->routeIs('perjanjian-kontrak') ? 'noti-dot' : '' }}">
                            <i class="la la-calendar-check-o"></i>
                            <span>Perjanjian Kontrak</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('perjanjian-kinerja') ? 'active' : '' }}">
                        <a href="{{ route('perjanjian-kinerja') }}" class="{{ request()->routeIs('perjanjian-kinerja') ? 'noti-dot' : '' }}">
                            <i class="la la-calendar-check-o"></i>
                            <span>Perjanjian Kinerja</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('perpanjang-kontrak') ? 'active' : '' }}">
                        <a href="{{ route('perpanjang-kontrak') }}" class="{{ request()->routeIs('perpanjang-kontrak') ? 'noti-dot' : '' }}">
                            <i class="la la-calendar-alt"></i>
                            <span>Perpanjangan Kontrak</span>
                        </a>
                    </li>

                    @if (Auth::user()->role_name == 'User' && Auth::user()->jenis_jabatan == 'Jabatan Struktural')
                        <li class="{{ request()->routeIs('sip-dokter') ? 'active' : '' }}">
                            <a href="{{ route('sip-dokter') }}" class="{{ request()->routeIs('sip-dokter') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SIP Dokter</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-dokter') ? 'active' : '' }}">
                            <a href="{{ route('spk-dokter') }}" class="{{ request()->routeIs('spk-dokter') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Dokter</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-perawat') ? 'active' : '' }}">
                            <a href="{{ route('spk-perawat') }}" class="{{ request()->routeIs('spk-perawat') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Perawat</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-nakes-lain') ? 'active' : '' }}">
                            <a href="{{ route('spk-nakes-lain') }}" class="{{ request()->routeIs('spk-nakes-lain') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Nakes Lain</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('surat-tanda-registrasi') ? 'active' : '' }}">
                            <a href="{{ route('surat-tanda-registrasi') }}" class="{{ request()->routeIs('surat-tanda-registrasi') ? 'noti-dot' : '' }}">
                                <i class="la la-folder-open"></i>
                                <span>Surat Tanda Registrasi</span>
                            </a>
                        </li>
                    
                        @elseif (Auth::user()->role_name == 'User' && Auth::user()->jenis_jabatan == 'Jabatan Fungsional Tertentu')
                        <li class="{{ request()->routeIs('sip-dokter') ? 'active' : '' }}">
                            <a href="{{ route('sip-dokter') }}" class="{{ request()->routeIs('sip-dokter') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SIP Dokter</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-dokter') ? 'active' : '' }}">
                            <a href="{{ route('spk-dokter') }}" class="{{ request()->routeIs('spk-dokter') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Dokter</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-perawat') ? 'active' : '' }}">
                            <a href="{{ route('spk-perawat') }}" class="{{ request()->routeIs('spk-perawat') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Perawat</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-nakes-lain') ? 'active' : '' }}">
                            <a href="{{ route('spk-nakes-lain') }}" class="{{ request()->routeIs('spk-nakes-lain') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Nakes Lain</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('surat-tanda-registrasi') ? 'active' : '' }}">
                            <a href="{{ route('surat-tanda-registrasi') }}" class="{{ request()->routeIs('surat-tanda-registrasi') ? 'noti-dot' : '' }}">
                                <i class="la la-folder-open"></i>
                                <span>Surat Tanda Registrasi</span>
                            </a>
                        </li>

                        @elseif (Auth::user()->role_name == 'User' && Auth::user()->jenis_jabatan == 'Jabatan Rangkap (Struktural dan Fungsional)')
                        <li class="{{ request()->routeIs('sip-dokter') ? 'active' : '' }}">
                            <a href="{{ route('sip-dokter') }}" class="{{ request()->routeIs('sip-dokter') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SIP Dokter</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-dokter') ? 'active' : '' }}">
                            <a href="{{ route('spk-dokter') }}" class="{{ request()->routeIs('spk-dokter') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Dokter</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-perawat') ? 'active' : '' }}">
                            <a href="{{ route('spk-perawat') }}" class="{{ request()->routeIs('spk-perawat') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Perawat</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('spk-nakes-lain') ? 'active' : '' }}">
                            <a href="{{ route('spk-nakes-lain') }}" class="{{ request()->routeIs('spk-nakes-lain') ? 'noti-dot' : '' }}">
                                <i class="la la-file-alt"></i>
                                <span>SPK Nakes Lain</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('surat-tanda-registrasi') ? 'active' : '' }}">
                            <a href="{{ route('surat-tanda-registrasi') }}" class="{{ request()->routeIs('surat-tanda-registrasi') ? 'noti-dot' : '' }}">
                                <i class="la la-folder-open"></i>
                                <span>Surat Tanda Registrasi</span>
                            </a>
                        </li>
                    @endif

                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['user/profile']) }}">
                        <a href="{{ route('user-profile') }}"
                            class="{{ set_active(['user/profile']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                    <li class="{{ set_active(['user/kata-sandi']) }}">
                        <a href="{{ route('user-kata-sandi') }}"
                            class="{{ set_active(['user/kata-sandi']) ? 'noti-dot' : '' }}">
                            <i class="la la-key"></i>
                            <span> Ubah Password</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
