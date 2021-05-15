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
                    <h1>Rumus variable " <?php echo e($show_data_kategori_tindakans->nama); ?> "</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-header">
    <div class="row">
        <div class="col-12">
        <input type="hidden" value="<?php echo e($no = 1); ?>">
        <div class="card">
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h1>Tabel list variable</h1>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_kategori_tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($data_kategori_tindakan->id_kategori_tindakan); ?></td>
                                <td><?php echo e($data_kategori_tindakan->nama); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody> 
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h1>Penjelasan isi rumus</h1>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>
                    Berikut meurupakan contoh dalam penulisan rumus variable dengan variable atau dengan angka.
                    <br>
                    Perawat IGD = <?php echo e(1); ?> x 40%
                    <br>
                    Penjelasan : 
                    LOL .. :v
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h1>Isi rumus variable</h1>
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
                                    <h4 class="modal-title">Buat data rumus baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="<?php echo e(route('variable_rumus.store')); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id_variable_rumus" value="<?php if(isset($show_varieble_rumuss)): ?> <?php echo e($show_varieble_rumuss->id_variable_rumus); ?> <?php else: ?> 0 <?php endif; ?>">
                                            <input type="hidden" name="id_kategori_tindakan" value="<?php echo e($show_data_kategori_tindakans->id_kategori_tindakan); ?>">
                                            <input type="hidden" name="nama_variabel" value="<?php echo e($show_data_kategori_tindakans->nama); ?>">
                                            <div class="form-group">
                                                <label for="Nama">Kategori</label>
                                                <select class="form-control" name="id_kategori_tindakan_detail">
                                                    <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_kategori_tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($data_kategori_tindakan->id_kategori_tindakan); ?>"><?php echo e($data_kategori_tindakan->nama); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>                                
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Nilai</label><br>
                                                <input type="number" class="form-control" name="nilai" required>
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
                <!-- /.card-header -->
                <div class="card-body">
                    <input type="hidden" value="<?php echo e($no = 1); ?>">
                    <table id="dataTable2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIlai</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Tindakan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $__currentLoopData = $show_varieble_rumus_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $show_varieble_rumus_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($show_varieble_rumus_detail->nama); ?></td>
                                    <td>x<?php echo e($show_varieble_rumus_detail->nilai); ?>%</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit<?php echo e($show_varieble_rumus_detail->id_variable_rumus_detail); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                        <a href="#" data-toggle="modal" data-target="#delete<?php echo e($show_varieble_rumus_detail->id_variable_rumus_detail); ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit<?php echo e($show_varieble_rumus_detail->id_variable_rumus_detail); ?>">
                                    <div class="modal-dialog">
                                    <div class="modal-content  bg-primary">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Ubah rumus " <?php echo e($show_varieble_rumus_detail->nama); ?> "</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="<?php echo e(route('variable_rumus_detail.update', $show_varieble_rumus_detail->id_variable_rumus_detail)); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php echo e(method_field('PUT')); ?> 
                                            <input type="hidden" name="id_variable_rumus" value="<?php if(isset($show_varieble_rumuss)): ?> <?php echo e($show_varieble_rumuss->id_variable_rumus); ?> <?php else: ?> 0 <?php endif; ?>">
                                            <div class="form-group">
                                                <label for="Nama">Kategori</label>
                                                <select class="form-control" name="id_kategori_tindakan_detail">
                                                    <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_kategori_tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($data_kategori_tindakan->id_kategori_tindakan); ?>" <?php if($data_kategori_tindakan->id_kategori_tindakan == $show_varieble_rumus_detail->id_kategori_tindakan): ?> selected <?php endif; ?>><?php echo e($data_kategori_tindakan->nama); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>                                
                                            </div>                                           
                                            <div class="form-group">
                                                <label for="Name">Nilai</label><br>
                                                <input type="number" class="form-control" name="nilai" value="<?php echo e($show_varieble_rumus_detail->nilai); ?>" required>
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

                                <div class="modal fade" id="delete<?php echo e($show_varieble_rumus_detail->id_variable_rumus_detail); ?>">
                                    <div class="modal-dialog">
                                    <div class="modal-content  bg-danger">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Hapus rumus " <?php echo e($show_varieble_rumus_detail->nama); ?> "</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="<?php echo e(route('variable_rumus_detail.destroy', $show_varieble_rumus_detail->id_variable_rumus_detail)); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php echo e(method_field('delete')); ?>

                                            <div class="form-group">
                                                <label for="Name">Apakah anda yakin ingin menghapus rumus  ?</label>
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
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL\resources\views/variable_rumus/detail.blade.php ENDPATH**/ ?>