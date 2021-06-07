<li class="nav-item has-treeview menu-close">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Perawat
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('karyawan_perawat.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data karyawan perawat</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('karyawan_perawat_point')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Point karyawan perawat</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('karyawan_perawat_upah')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Perhitungan upah</p>
            </a>
        </li>
    </ul>
</li>