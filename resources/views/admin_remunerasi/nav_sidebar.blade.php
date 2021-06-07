<li class="nav-item has-treeview menu-close">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Admin remunerasi
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('karyawan_admin.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data admin remunerasi</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('karyawan_admin_point')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Point admin remunerasi</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('karyawan_admin_upah')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Perhitungan upah</p>
            </a>
        </li>
    </ul>
</li>