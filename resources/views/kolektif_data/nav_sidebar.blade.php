<li class="nav-item">
    <a href="{{ route('periode.index')}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Periode</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('data_keuangan_pasien.index')}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
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
            <a href="{{ url('periode_p_pasien_rawat_jalan')}}" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
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
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar ruangan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('deskripsi_tindakan.index')}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar deskripsi tindakan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('periode_rekap_data')}}" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Rekap data</p>
    </a>
</li>