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
                    <h1>Daftar periode</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                    </ol>
                </div>
                <div class="modal fade" id="create_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Buat data periode baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?php echo e(route('periode.store')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="Name">Bulan</label><br>
                                        <input type="number" class="form-control" name="bulan" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">Tahun</label><br>
                                        <input type="number" class="form-control" name="tahun" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="Nama">Pengguna</label>
                                        <select class="form-control" name="id_users">
                                            <?php $__currentLoopData = $data_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($data_user->id_users); ?>" ><?php echo e($data_user->nama_user); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>                                
                                    </div> -->
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
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Pembuat</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Pembuat</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_periode->bulan); ?></td>
                                <td><?php echo e($data_periode->tahun); ?></td>
                                <td><?php echo e($data_periode->nama_user); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit<?php echo e($data_periode->id_periode); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete<?php echo e($data_periode->id_periode); ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit<?php echo e($data_periode->id_periode); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah bulan " <?php echo e($data_periode->bulan); ?> " dan tahun " <?php echo e($data_periode->tahun); ?> "</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('periode.update', $data_periode->id_periode)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('PUT')); ?>

                                        <div class="form-group">
                                            <label for="Name">Bulan</label><br>
                                            <input type="number" class="form-control" name="bulan" value="<?php echo e($data_periode->bulan); ?>" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Tahun</label><br>
                                            <input type="number" class="form-control" name="tahun" value="<?php echo e($data_periode->tahun); ?>" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="Nama">Pengguna</label>
                                            <select class="form-control" name="id_users">
                                                <?php $__currentLoopData = $data_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($data_user->id_users); ?>" <?php if($data_periode->id_users == $data_user->id_users): ?> selected <?php endif; ?>><?php echo e($data_user->nama_user); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>                                
                                        </div> -->
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

                            <div class="modal fade" id="delete<?php echo e($data_periode->id_periode); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus bulan " <?php echo e($data_periode->bulan); ?> " dan tahun " <?php echo e($data_periode->tahun); ?> "</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('periode.destroy', $data_periode->id_periode)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('delete')); ?>

                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus bulan " <?php echo e($data_periode->bulan); ?> " dan tahun " <?php echo e($data_periode->tahun); ?> " ?</label>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-light">
                                                <?php echo e(__('Hapus')); ?>

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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/periode/index.blade.php ENDPATH**/ ?>