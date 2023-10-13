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
                    <li class="{{ request()->routeIs('referensi-ruangan') ? 'active' : '' }}">
                        <a href="{{ route('referensi-ruangan') }}" class="{{ request()->routeIs('referensi-ruangan') ? 'noti-dot' : '' }}">
                            <i class="las la-warehouse"></i>
                            <span>Raungan</span>
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
                    <li class="{{ request()->routeIs('layanan-cuti-admin') ? 'active' : '' }}">
                        <a href="{{ route('layanan-cuti-admin') }}" class="{{ request()->routeIs('layanan-cuti-admin') ? 'noti-dot' : '' }}">
                            <i class="las la-newspaper"></i>
                            <span>Pengajuan Cuti</span>
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
                    <li class="{{ request()->routeIs('') ? 'active' : '' }}">
                        <a href="#" class="{{ request()->routeIs('') ? 'noti-dot' : '' }}">
                            <i class="la la-files-o"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
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
                    <li class="{{ request()->routeIs('layanan-cuti') ? 'active' : '' }}">
                        <a href="{{ route('layanan-cuti') }}" class="{{ request()->routeIs('layanan-cuti') ? 'noti-dot' : '' }}">
                            <i class="las la-newspaper"></i>
                            <span>Pengajuan Cuti</span>
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
