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
                    <h1>Daftar karyawan perawat</h1>
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
                            <h4 class="modal-title">Buat data karyawan perawat baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?php echo e(route('karyawan_perawat.store')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="Name">Nama</label><br>
                                        <input type="text" class="form-control" name="nama" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Jabatan</label>
                                        <select class="form-control" name="jabatan">
                                            <?php $__currentLoopData = $data_jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($data_jabatan); ?>" ><?php echo e($data_jabatan); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>                                
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Ruang</label>
                                        <select class="form-control" name="id_ruangan">
                                            <?php $__currentLoopData = $data_ruangans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_ruangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($data_ruangan->id_ruangan); ?>" ><?php echo e($data_ruangan->nama_ruangan); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>                                
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
                            <th>Jabatan</th>
                            <th>Ruang</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Ruang</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_karyawan_perawats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_karyawan_perawat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_karyawan_perawat->nama); ?></td>
                                <td><?php echo e($data_karyawan_perawat->jabatan); ?></td>
                                <td><?php echo e($data_karyawan_perawat->nama_ruangan); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah data " <?php echo e($data_karyawan_perawat->nama); ?> " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('karyawan_perawat.update', $data_karyawan_perawat->id_karyawan_perawat)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('PUT')); ?>

                                        <div class="form-group">
                                            <label for="Name">Nama</label><br>
                                            <input type="text" class="form-control" name="nama" value="<?php echo e($data_karyawan_perawat->nama); ?>" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Jabatan</label>
                                            <select class="form-control" name="jabatan">
                                                <?php $__currentLoopData = $data_jabatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($data_jabatan); ?>" <?php if($data_karyawan_perawat->jabatan == $data_jabatan): ?> selected <?php endif; ?>><?php echo e($data_jabatan); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>                                
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Ruang</label>
                                            <select class="form-control" name="id_ruangan">
                                                <?php $__currentLoopData = $data_ruangans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_ruangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($data_ruangan->id_ruangan); ?>" <?php if($data_karyawan_perawat->id_ruangan == $data_ruangan->id_ruangan): ?> selected <?php endif; ?>><?php echo e($data_ruangan->nama_ruangan); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>                                
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

                            <div class="modal fade" id="delete<?php echo e($data_karyawan_perawat->id_karyawan_perawat); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus data " <?php echo e($data_karyawan_perawat->nama); ?> " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('karyawan_perawat.destroy', $data_karyawan_perawat->id_karyawan_perawat)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('delete')); ?>

                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus data " <?php echo e($data_karyawan_perawat->nama); ?> " ?</label>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL\resources\views/karyawan_perawat/index.blade.php ENDPATH**/ ?>