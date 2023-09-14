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
                    <li
                        class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-user-secret"></i> <span> Manajemen Sistem</span> <span
                                class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{ set_active(['search/user/list', 'userManagement']) }}"
                                    href="{{ route('userManagement') }}">Daftar Pengguna</a></li>
                            <li><a class="{{ set_active(['activity/log']) }}" href="{{ route('activity/log') }}">Riwayat
                                    Aktivitas</a></li>
                            <li><a class="{{ set_active(['activity/login/logout']) }}"
                                    href="{{ route('activity/login/logout') }}">Aktivitas Pengguna</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"> <span>Data Referensi </span> </li>
                    <li
                        class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-clipboard"></i> <span> Data Referensi</span> <span
                                class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a href="#">Agama</a></li>
                            <li><a href="#">Status</a></li>
                            <li><a href="#">Kedudukan</a></li>
                            <li><a href="#">Pangkat</a></li>
                            <li><a href="#">Pendidikan</a></li>
                            <li><a href="#">Unit Kerja</a></li>
                            <li><a href="#">Sumpah</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"> <span>Manajemen Pegawai</span> </li>
                    <li
                        class="{{ set_active(['all/employee/list', 'all/employee/card', 'form/holidays/new']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['all/employee/list', 'all/employee/card']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i> <span> Manajemen Pegawai</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{ set_active(['all/employee/list', 'all/employee/card']) }} {{ request()->is('all/employee/view/edit/*', 'employee/profile/*') ? 'active' : '' }}"
                                    href="{{ route('all/employee/card') }}">Daftar Pegawai</a></li>
                            <li><a class="{{ set_active(['form/holidays/new']) }}"
                                    href="{{ route('form/holidays/new') }}">Daftar Pegawai Pensiun</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"> <span>Layanan Kepegawaian </span> </li>
                    <li
                        class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-group"></i> <span> Layanan Kepegawaian</span> <span
                                class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a href="#">Kenaikan Gaji Berkala</a></li>
                            <li><a href="#">Kenaikan Pangkat</a></li>
                            <li><a href="#">Status Kepegawaian</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"> <span>Data Statistik </span> </li>
                    <li
                        class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-pie-chart"></i> <span> Data Statistik</span> <span
                                class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a href="#">Daftar Urut Kepangkatan</a></li>
                            <li><a href="#">Hukuman Disiplin</a></li>
                            <li><a href="#">Jenis Kelamin</a></li>
                            <li><a href="#">Tingkat Pendidikan</a></li>
                            <li><a href="#">Golongan Ruang</a></li>
                            <li><a href="#">Jabatan</a></li>
                            <li><a href="#">Kelompok Umur</a></li>
                            <li><a href="#">Jenis Pegawai</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"> <span>Laporan </span> </li>
                    <li
                        class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-file"></i> <span> Laporan</span>
                        </a>
                    </li>

                    <li class="menu-title">
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
                    </li>

                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['profile_user']) }}">
                        <a href="{{ route('profile_user') }}"
                            class="{{ set_active(['profile_user']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_name == 'Super Admin')
                    <li class="menu-title"> <span>Informasi Pegawai</span> </li>
                    <li class="{{ set_active(['rekapitulasi']) }}">
                        <a href="#">
                            <i class="la la-user"></i>
                            <span> Data Pegawai</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Data Statistik</span> </li>
                    <li class="{{ set_active(['rekapitulasi']) }}">
                        <a href="{{ route('rekapitulasi') }}"
                            class="{{ set_active(['rekapitulasi']) ? 'noti-dot' : '' }}">
                            <i class="la la-pie-chart"></i>
                            <span> Data Statistik</span>
                        </a>
                        <a href="#">
                            <i class="la la-files-o"></i>
                            <span> Laporan</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['profile_user']) }}">
                        <a href="{{ route('profile_user') }}"
                            class="{{ set_active(['profile_user']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_name == 'User')
                    <li class="menu-title"> <span>Pengaturan Profil</span> </li>
                    <li class="{{ set_active(['profile_user']) }}">
                        <a href="{{ route('profile_user') }}"
                            class="{{ set_active(['profile_user']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i>
                            <span> Profil Pegawai</span>
                        </a>
                    </li>
                    <li class="menu-title"> <span>Data Riwayat </span> </li>
                    <li
                        class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) }} submenu">
                        <a href="#"
                            class="{{ set_active(['search/user/list', 'userManagement', 'activity/log', 'activity/login/logout']) ? 'noti-dot' : '' }}">
                            <i class="la la-file"></i> <span> Data Riwayat</span> <span
                                class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a href="#">Pangkat/Golongan</a></li>
                            <li><a href="#">Pendidikan</a></li>
                            <li><a href="#">Jabatan</a></li>
                            <li><a href="#">Peninjauan Masa Kerja</a></li>
                            <li><a href="#">CPNS/PNS</a></li>
                            <li><a href="#">Diklat/Kursus</a></li>
                            <li><a href="#">Keluarga</a></li>
                            <li><a href="#">SKP</a></li>
                            <li><a href="#">Penghargaan</a></li>
                            <li><a href="#">Organisasi</a></li>
                            <li><a href="#">Pencantuman Gelar</a></li>
                            <li><a href="#">Hukuman Disiplin</a></li>
                            <li><a href="#">Angka Kredit</a></li>
                            <li><a href="#">Kinerja</a></li>
                            <li><a href="#">Profesi</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
