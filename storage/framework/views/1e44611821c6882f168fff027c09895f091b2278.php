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
                    <h1>Daftar upah karyawan perawat periode <br>(<?php echo e($data_periodes->bulan); ?> - <?php echo e($data_periodes->tahun); ?>)</h1>
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
                            <th>Tindakan</th>
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
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for($i=0; $i < count($data_upah_perawats); $i++): ?>
                            <tr>
                                <td><?php echo e(($i+1)); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['nama']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['kredential']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['unit']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['posisi']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['performa']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['disiplin']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['komplain']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['pm']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['iku']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['iki']); ?></td>
                                <td><?php echo e($data_upah_perawats[$i]['pm_proses']); ?></td>
                                <td>
                                    <a href="<?php echo e(url('detail_upah_karyawan_perawat/'. $data_periodes->id_periode . '/' . $data_upah_perawats[$i]['id_karyawan_perawat'] )); ?>"  class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i> Detail</a>
                                </td>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\JOKI\TA-FADHIL-NEW\resources\views/karyawan_perawat/upah/upah.blade.php ENDPATH**/ ?>