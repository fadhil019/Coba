<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header mb-n3">
    <?php if(\Session::has('alert-success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo e(Session::get('alert-success')); ?>

        </div>
    <?php endif; ?>
    <?php if(\Session::has('alert-failed')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo e(Session::get('alert-failed')); ?>

        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <div class="row pt-2 mb-2">
                <div class="col-sm-6">
                    <h1>Daftar upah karyawan admin periode <br>(<?php echo e($data_periodes->bulan); ?> - <?php echo e($data_periodes->tahun); ?>)</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
        <input type="hidden" value="<?php echo e($no = 1); ?>">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM AKHIR</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM AKHIR</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for($i=0; $i < count($data_upah_admins); $i++): ?>
                            <tr>
                                <td><?php echo e(($i+1)); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['nama']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['kredential']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['unit']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['posisi']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['performa']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['disiplin']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['komplain']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['pm']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['iku']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['iki']); ?></td>
                                <td><?php echo e($data_upah_admins[$i]['pm_proses']); ?></td>
                                <!-- <td>
                                    <a href="#"  class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td> -->
                            </tr>
                        <?php endfor; ?>
                    </tbody> 
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\JOKI\TA-FADHIL-NEW\resources\views/karyawan_admin/upah/upah.blade.php ENDPATH**/ ?>