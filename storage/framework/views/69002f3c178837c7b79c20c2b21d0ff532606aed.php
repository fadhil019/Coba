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
                    <h1>Daftar point karyawan perawat periode <br>(<?php echo e($data_periodes->bulan); ?> - <?php echo e($data_periodes->tahun); ?>)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="<?php echo e(url('generate_data_karyawan_perawat/'.$data_periodes->id_periode)); ?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Generate</a></li>
                    </ol>
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="<?php echo e(url('/')); ?>" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> Proses perhitungan upah</a></li>
                    </ol>
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
                            <th>Periode</th>
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
                            <th>Periode</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_karyawan_perawats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_karyawan_perawat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_karyawan_perawat->nama); ?></td>
                                <td><?php echo e($data_karyawan_perawat->kredential); ?></td>
                                <td><?php echo e($data_karyawan_perawat->unit); ?></td>
                                <td><?php echo e($data_karyawan_perawat->posisi); ?></td>
                                <td><?php echo e($data_karyawan_perawat->performa); ?></td>
                                <td><?php echo e($data_karyawan_perawat->disiplin); ?></td>
                                <td><?php echo e($data_karyawan_perawat->komplain); ?></td>
                                <td><?php echo e($data_karyawan_perawat->pm); ?></td>
                                <td><?php echo e($data_karyawan_perawat->bulan); ?> - <?php echo e($data_karyawan_perawat->tahun); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Perbarui point <br> " <?php echo e($data_karyawan_perawat->nama); ?> " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(url('update_point_karyawan_perawat/'. $data_karyawan_perawat->id_point_karyawan)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('PUT')); ?>

                                        <input type="hidden" name="id_periode" value="<?php echo e($data_periodes->id_periode); ?>">
                                        <input type="hidden" name="id_karyawan_perawat" value="<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>">
                                        <div class="form-group">
                                            <label for="Name">Kreed</label><br>
                                            <input type="number" class="form-control" name="kredential" value="<?php echo e($data_karyawan_perawat->kredential); ?>" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Unit</label><br>
                                            <input type="number" class="form-control" name="unit" value="<?php echo e($data_karyawan_perawat->unit); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Posisi</label><br>
                                            <input type="number" class="form-control" name="posisi" value="<?php echo e($data_karyawan_perawat->posisi); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Performa</label><br>
                                            <input type="number" class="form-control" name="performa" value="<?php echo e($data_karyawan_perawat->performa); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Disiplin</label><br>
                                            <input type="number" class="form-control" name="disiplin" value="<?php echo e($data_karyawan_perawat->disiplin); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Komplain</label><br>
                                            <input type="number" class="form-control" name="komplain" value="<?php echo e($data_karyawan_perawat->komplain); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">PM</label><br>
                                            <input type="number" class="form-control" name="pm" value="<?php echo e($data_karyawan_perawat->pm); ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-light">
                                                <?php echo e(__('Simpan')); ?>

                                            </button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-light pull-right" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/karyawan_perawat/point/point.blade.php ENDPATH**/ ?>