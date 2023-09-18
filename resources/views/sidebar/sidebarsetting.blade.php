<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div class="sidebar-menu">
            <ul>
                <li><a href="{{ route('home') }}"><i class="la la-home"></i> <span>Menu Utama</span></a></li>
                <li class="menu-title">Pengaturan</li>
                <li class="{{set_active(['company/settings/page'])}}"><a href="{{ route('company/settings/page') }}"><i class="la la-building"></i><span>Pengaturan</span></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Sidebar -->