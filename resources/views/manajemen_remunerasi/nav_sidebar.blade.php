<li class="nav-item">
    <a href="{{ url('daftar_dashboard/'. date('Y') )}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Dasboard</p>
    </a>
</li>
<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
           Karyawan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('karyawan_admin.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Admin remunerasi</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('karyawan_penunjang.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Penunjang</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('karyawan_perawat.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Perawat</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ url('periode_rekap_data')}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Rekap data</p>
    </a>
</li>
