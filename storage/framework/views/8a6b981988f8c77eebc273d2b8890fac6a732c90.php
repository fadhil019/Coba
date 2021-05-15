<li class="nav-item has-treeview menu-open">
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
</li>
<li class="nav-item">
    <a href="<?php echo e(url('/')); ?>" class="nav-link">
    <i class="nav-icon fas fa-star"></i>
        <p>Perhitungan upah</p>
    </a>
</li><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL\resources\views/perawat/nav_sidebar.blade.php ENDPATH**/ ?>