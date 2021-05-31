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
                    <h1>Daftar point karyawan admin periode <br>(<?php echo e($data_periodes->bulan); ?> - <?php echo e($data_periodes->tahun); ?>)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="<?php echo e(url('generate_data_karyawan_admin/'.$data_periodes->id_periode)); ?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Generate</a></li>
                    </ol>
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> Proses perhitungan upah</a></li>
                    </ol>
                </div>
                <div class="modal fade" id="create_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-warning">
                            <div class="modal-header">
                            <h4 class="modal-title">Proses perhitungan upah karyawan admin remunerasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?php echo e(url('/')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin memproses perhitungan upah karyawan admin remunerasi periode (<?php echo e($data_periodes->bulan); ?> - <?php echo e($data_periodes->tahun); ?>) ?</label>
                                        </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-dark">
                                            <?php echo e(__('Proses')); ?>

                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark pull-right" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
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
                        <?php $__currentLoopData = $data_karyawan_admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_karyawan_admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_karyawan_admin->nama); ?></td>
                                <td><?php echo e($data_karyawan_admin->kredential); ?></td>
                                <td><?php echo e($data_karyawan_admin->unit); ?></td>
                                <td><?php echo e($data_karyawan_admin->posisi); ?></td>
                                <td><?php echo e($data_karyawan_admin->performa); ?></td>
                                <td><?php echo e($data_karyawan_admin->disiplin); ?></td>
                                <td><?php echo e($data_karyawan_admin->komplain); ?></td>
                                <td><?php echo e($data_karyawan_admin->pm); ?></td>
                                <td><?php echo e($data_karyawan_admin->bulan); ?> - <?php echo e($data_karyawan_admin->tahun); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit<?php echo e($data_karyawan_admin->id_karyawan_admin); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit<?php echo e($data_karyawan_admin->id_karyawan_admin); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Perbarui point <br> " <?php echo e($data_karyawan_admin->nama); ?> " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(url('update_point_karyawan_admin/'. $data_karyawan_admin->id_point_karyawan)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('PUT')); ?>

                                        <input type="hidden" name="id_periode" value="<?php echo e($data_periodes->id_periode); ?>">
                                        <input type="hidden" name="id_karyawan_admin" value="<?php echo e($data_karyawan_admin->id_karyawan_admin); ?>">
                                        <div class="form-group">
                                            <label for="Name">Kreed</label><br>
                                            <input type="number" class="form-control" name="kredential" value="<?php echo e($data_karyawan_admin->kredential); ?>" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Unit</label><br>
                                            <input type="number" class="form-control" name="unit" value="<?php echo e($data_karyawan_admin->unit); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Posisi</label><br>
                                            <input type="number" class="form-control" name="posisi" value="<?php echo e($data_karyawan_admin->posisi); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Performa</label><br>
                                            <input type="number" class="form-control" name="performa" value="<?php echo e($data_karyawan_admin->performa); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Disiplin</label><br>
                                            <input type="number" class="form-control" name="disiplin" value="<?php echo e($data_karyawan_admin->disiplin); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Komplain</label><br>
                                            <input type="number" class="form-control" name="komplain" value="<?php echo e($data_karyawan_admin->komplain); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">PM</label><br>
                                            <input type="number" class="form-control" name="pm" value="<?php echo e($data_karyawan_admin->pm); ?>" required>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/karyawan_admin/point/point.blade.php ENDPATH**/ ?>