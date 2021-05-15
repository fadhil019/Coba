<!-- <li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('/')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Penyewa</p>
            </a>
        </li>
    </ul>
</li> -->
<li class="nav-item">
    <a href="{{ route('periode.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Periode</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('data_keuangan_pasien.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Data keuangan pasien</p>
    </a>
</li>
<li class="nav-item has-treeview menu-close">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Pasien rawat jalan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('periode_pasien_rawat_jalan')}}" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
                <p>Data pasien rawat jalan</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('/')}}" class="nav-link">
            <i class="nav-icon fas fa-times"></i>
                <p>Perhitungan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview menu-close">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Pasien rawat inap
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('periode_pasien_rawat_inap')}}" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
                <p>Data pasien rawat inap</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('periode_p_pasien_rawat_inap')}}" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
                <p>Perhitungan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('dokter.index')}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar dokter</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('ruangan.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Daftar ruangan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('deskripsi_tindakan.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Daftar deskripsi tindakan</p>
    </a>
</li>
<!-- <li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Dokter
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('dokter.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar dokter</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('/')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Tarif dokter IGD</p>
            </a>
        </li>
    </ul>
</li> -->
<li class="nav-item">
    <a href="{{ route('deskripsi_tindakan.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Data pasien tahap 2</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('deskripsi_tindakan.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Rekap data</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('deskripsi_tindakan.index')}}" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Perhitungan 1 2 3 4</p>
    </a>
</li>