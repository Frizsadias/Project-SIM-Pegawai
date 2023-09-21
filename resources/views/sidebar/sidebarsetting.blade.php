<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div class="sidebar-menu">
            <ul>
                <li><a href="{{ route('home') }}"><i class="la la-home"></i> <span>Menu Utama</span></a></li>
                <li class="menu-title"> <span>Pengaturan</span> </li>
                    <li class="{{ set_active(['pengaturan/perusahaan']) }}">
                        <a href="{{ route('pengaturan-perusahaan') }}"
                            class="{{ set_active(['pengaturan/perusahaan']) ? 'noti-dot' : '' }}">
                            <i class="la la-building"></i>
                            <span> Pengaturan</span>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
<!-- Sidebar -->
