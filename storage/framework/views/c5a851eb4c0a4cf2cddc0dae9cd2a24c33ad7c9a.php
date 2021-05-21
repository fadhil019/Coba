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
                    <h1>Data tindakan pasien " <?php echo e($data_pasien_rawat_inaps[0]->nama_pasien); ?> "</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                    </ol>
                </div> -->
                <div class="modal fade" id="create_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Buat data tindakan baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?php echo e(route('data_tindakan_pasien.store')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="Name">Jp</label><br>
                                        <input type="number" class="form-control" name="jp" autofocus required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Name">Nama dokter / perawat</label><br>
                                        <input type="text" class="form-control" name="nama_dokter_perawat" required>
                                    </div>

                                    <input type="hidden" class="form-control" name="id_data_pasien" value="<?php echo e($data_pasien_rawat_inaps[0]->id_data_pasien); ?>" required>

                                    <div class="form-group">
                                        <label for="Nama">Deskripsi tindakan</label>
                                        <select class="form-control" name="id_deskripsi_tindakan">
                                            <?php $__currentLoopData = $data_deskripsi_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_deskripsi_tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($data_deskripsi_tindakan->id_deskripsi_tindakan); ?>" ><?php echo e($data_deskripsi_tindakan->deskripsi_tindakan); ?></option>
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
                            <th>Jp</th>
                            <th>Nama dokter</th>
                            <th>Deskripsi tindakan</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jp</th>
                            <th>Nama dokter</th>
                            <th>Deskripsi tindakan</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_tindakan_pasiens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_tindakan_pasien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_tindakan_pasien->jp); ?></td>
                                <td><?php echo e($data_tindakan_pasien->nama_dokter_perawat); ?></td>
                                <td><?php echo e($data_tindakan_pasien->deskripsi_tindakan); ?></td>
                                <!-- <td>
                                <a href="#" data-toggle="modal" data-target="#edit<?php echo e($data_tindakan_pasien->id_data_tindakan_pasien); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                <a href="#" data-toggle="modal" data-target="#delete<?php echo e($data_tindakan_pasien->id_data_tindakan_pasien); ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td> -->
                            </tr>
                            <div class="modal fade" id="edit<?php echo e($data_tindakan_pasien->id_data_tindakan_pasien); ?>">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah data " <?php echo e($data_tindakan_pasien->deskripsi_tindakan); ?> " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('data_tindakan_pasien.update', $data_tindakan_pasien->id_data_tindakan_pasien)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('PUT')); ?>

                                        <div class="form-group">
                                            <label for="Name">Jp</label><br>
                                            <input type="number" class="form-control" name="jp" value="<?php echo e($data_tindakan_pasien->jp); ?>" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Nama dokter / perawat</label><br>
                                            <input type="text" class="form-control" name="nama_dokter_perawat" value="<?php echo e($data_tindakan_pasien->nama_dokter_perawat); ?>" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Deskripsi tindakan</label>
                                            <select class="form-control" name="id_deskripsi_tindakan">
                                                <?php $__currentLoopData = $data_deskripsi_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_deskripsi_tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($data_deskripsi_tindakan->id_deskripsi_tindakan); ?>" <?php if($data_tindakan_pasien->id_deskripsi_tindakan == $data_deskripsi_tindakan->id_deskripsi_tindakan): ?> selected <?php endif; ?>><?php echo e($data_deskripsi_tindakan->deskripsi_tindakan); ?></option>
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

                            <div class="modal fade" id="delete<?php echo e($data_tindakan_pasien->id_data_tindakan_pasien); ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content  bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus " <?php echo e($data_tindakan_pasien->deskripsi_tindakan); ?> "</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?php echo e(route('data_tindakan_pasien.destroy', $data_tindakan_pasien->id_data_tindakan_pasien)); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo e(method_field('delete')); ?>

                                                <div class="form-group">
                                                    <label for="Name">Apakah anda yakin ingin menghapus " <?php echo e($data_tindakan_pasien->deskripsi_tindakan); ?> " ?</label>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/pasien/rawat_inap_tindakan.blade.php ENDPATH**/ ?>