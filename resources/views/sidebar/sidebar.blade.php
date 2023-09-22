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
                    <li class="menu-title"> <span>Manajemen Sistem</span> </li>
                    <li class="{{ request()->is('search/user/list', 'manajemen/pengguna') ? 'active' : '' }}">
                        <a href="{{ route('manajemen-pengguna') }}"
                            class="{{ request()->is('search/user/list', 'manajemen/pengguna') ? 'noti-dot' : '' }}">
                            <i class="la la-user-secret"></i> <span>Daftar Pengguna</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-aktivitas') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-aktivitas') }}"
                            class="{{ request()->routeIs('riwayat-aktivitas') ? 'noti-dot' : '' }}">
                            <i class="la la-caret-square-o-left"></i>
                            <span>Riwayat Aktivitas</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-aktivitas-otentikasi') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-aktivitas-otentikasi') }}"
                            class="{{ request()->routeIs('riwayat-aktivitas-otentikasi') ? 'noti-dot' : '' }}">
                            <i class="la la-line-chart"></i>
                            <span>Aktivitas Pengguna</span>
                        </a>
                    </li>
                    </li>

                    <li class="menu-title"> <span>Data Referensi </span>
                    <li class="{{ request()->routeIs('referensi-agama') ? 'active' : '' }}">
                        <a href="{{ route('referensi-agama') }}"
                            class="{{ request()->routeIs('referensi-agama') ? 'noti-dot' : '' }}">
                            <i class="la la-heart"></i>
                            <span>Agama</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('status') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('status') ? 'noti-dot' : '' }}">
                            <i class="la la-map"></i>
                            <span>Status</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('kedudukan') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('kedudukan') ? 'noti-dot' : '' }}">
                            <i class="la la-trello"></i>
                            <span>Kedudukan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('pangkat') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('pangkat') ? 'noti-dot' : '' }}">
                            <i class="la la-sitemap"></i>
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
                    <li class="{{ request()->routeIs('unit-kerja') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('unit-kerja') ? 'noti-dot' : '' }}">
                            <i class="la la-laptop"></i>
                            <span>Unit Kerja</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('sumpah') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('sumpah') ? 'noti-dot' : '' }}">
                            <i class="la la-gavel"></i>
                            <span>Sumpah</span>
                        </a>
                    </li>

                    <li class="menu-title"> <span>Manajemen Pegawai</span> </li>
                    {{-- <li
                        class="{{ request()->routeIs('all/employee/list','all/employee/card') || request()->routeIs('all/employee/card') ? 'active' : '' }}">
                        <a href="{{ route('all/employee/list', 'all/employee/card') }}"
                            class="{{ request()->routeIs('all/employee/list', 'all/employee/card') || request()->routeIs('all/employee/card') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i>
                            <span>Daftar Pegawai</span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->is('search/user/list', 'daftar/pegawai') ? 'active' : '' }}">
                        <a href="{{ route('daftar-pegawai') }}"
                            class="{{ request()->is('search/user/list', 'daftar/pegawai') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i> <span>Daftar Pegawai</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-level-down"></i>
                            <span>Daftar Pegawai Pensiun</span>
                        </a>
                    </li>

                    <li class="menu-title"> <span>Layanan Kepegawaian </span> </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-money"></i>
                            <span>Kenaikan Gaji Berkala</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-long-arrow-up"></i>
                            <span>Kenaikan Pangkat</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-tags"></i>
                            <span>Status Kepegawaian</span>
                        </a>
                    </li>

                    <li class="menu-title"> <span>Data Statistik </span> </li>
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
                    </li>

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
                    <li class="{{ set_active(['change/password']) }}">
                        <a href="{{ route('change/password') }}"
                            class="{{ set_active(['change/password']) ? 'noti-dot' : '' }}">
                            <i class="la la-key"></i>
                            <span> Ubah Password</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_name == 'Super Admin')
                    <li class="menu-title"> <span>Informasi Pegawai</span> </li>
                    <li
                        class="{{ request()->routeIs('all/employee/list') || request()->routeIs('') ? 'active' : '' }}">
                        <a href="{{ route('all/employee/list') }}"
                            class="{{ request()->routeIs('all/employee/list') || request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i>
                            <span>Data Pegawai</span>
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
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-files-o"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['superadmin/profile']) }}">
                        <a href="{{ route('superadmin-profile') }}"
                            class="{{ set_active(['superadmin/profile']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                    <li class="{{ set_active(['change/password']) }}">
                        <a href="{{ route('change/password') }}"
                            class="{{ set_active(['change/password']) ? 'noti-dot' : '' }}">
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
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-sliders"></i>
                            <span>Peninjauan Masa Kerja</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-info"></i>
                            <span>CPNS/PNS</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('riwayat-diklat') ? 'active' : '' }}">
                        <a href="{{ route('riwayat-diklat') }}"
                            class="{{ request()->routeIs('riwayat-diklat') ? 'noti-dot' : '' }}">
                            <i class="la la-slack"></i>
                            <span> Diklat/Kursus</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-users"></i>
                            <span>Keluarga</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-quote-left"></i>
                            <span>SKP</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-certificate"></i>
                            <span>Penghargaan</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-building-o"></i>
                            <span>Organisasi</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-bookmark-o"></i>
                            <span>Pencantuman Gelar</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-gavel"></i>
                            <span>Hukuman Disiplin</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-bank"></i>
                            <span>Angka Kredit</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-wrench"></i>
                            <span>Kinerja</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-pied-piper-alt"></i>
                            <span>Profesi</span>
                        </a>
                    </li>

                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['user/profile']) }}">
                        <a href="{{ route('user-profile') }}"
                            class="{{ set_active(['user/profile']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                    <li class="{{ set_active(['change/password']) }}">
                        <a href="{{ route('change/password') }}"
                            class="{{ set_active(['change/password']) ? 'noti-dot' : '' }}">
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
