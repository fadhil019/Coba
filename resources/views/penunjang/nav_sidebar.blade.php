<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Penunjang
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('karyawan_penunjang.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data karyawan penunjang</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('karyawan_penunjang_point')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Point karyawan penunjang</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ url('/')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Perhitungan upah</p>
    </a>
</li>