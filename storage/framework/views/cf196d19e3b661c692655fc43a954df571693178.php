<li class="nav-item">
    <a href="<?php echo e(route('periode.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Periode</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('data_keuangan_pasien.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Data keuangan pasien</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('variable_rumus.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Rumus - rumus</p>
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
            <a href="<?php echo e(url('periode_pasien_rawat_jalan')); ?>" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
                <p>Data pasien rawat jalan</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('periode_p_pasien_rawat_jalan')); ?>" class="nav-link">
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
            <a href="<?php echo e(url('periode_pasien_rawat_inap')); ?>" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
                <p>Data pasien rawat inap</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('periode_p_pasien_rawat_inap')); ?>" class="nav-link">
            <i class="nav-icon far fa-circle"></i>
                <p>Perhitungan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('dokter.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar dokter</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('ruangan.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar ruangan</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('kategori_tindakan.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar kategori tindakan</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(route('deskripsi_tindakan.index')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Daftar deskripsi tindakan</p>
    </a>
</li>
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
            <a href="<?php echo e(route('karyawan_admin.index')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data admin remunerasi</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('karyawan_admin_point')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Point admin remunerasi</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('karyawan_admin_upah')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Perhitungan upah</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview menu-close">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Penunjang
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(route('karyawan_penunjang.index')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data karyawan penunjang</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('karyawan_penunjang_point')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Point karyawan penunjang</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('karyawan_penunjang_upah')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Perhitungan upah</p>
            </a>
        </li>
    </ul>
</li>
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
            <a href="<?php echo e(route('karyawan_perawat.index')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data karyawan perawat</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('karyawan_perawat_point')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Point karyawan perawat</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(url('karyawan_perawat_upah')); ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Perhitungan upah</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="<?php echo e(url('daftar_dashboard/'. date('Y') )); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Dasboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo e(url('periode_rekap_data')); ?>" class="nav-link">
    <i class="nav-icon fas fa-check"></i>
        <p>Rekap data</p>
    </a>
</li>
<hr>
<hr>
<hr>
<?php /**PATH D:\PROJECT\KERJAAN\JOKI\TA-FADHIL-NEW\resources\views/admin_sistem/nav_sidebar.blade.php ENDPATH**/ ?>