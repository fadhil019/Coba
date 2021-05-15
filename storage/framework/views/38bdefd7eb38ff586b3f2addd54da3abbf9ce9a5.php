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
                    <h1>Daftar variable kategori</h1>
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
                            <th>Nama</th>
                            <th>Rumus</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Tindakan</th>
                            <th>Rumus</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php $__currentLoopData = $variable_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row); ?></td>
                            <td>
                                <?php if(isset($show_varieble_rumuss[$row])): ?> <?php echo e($show_varieble_rumuss[$row]); ?> <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#create_data_<?php echo e(strtolower(str_replace(' ', '', $row))); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Rumus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="create_data_<?php echo e(strtolower(str_replace(' ', '', $row))); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Buat data rumus " <?php echo e($row); ?> "</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="<?php echo e(route('variable_rumus.store')); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <p>
                                            Berikut meurupakan contoh dalam penulisan rumus variable dengan variable atau dengan angka.
                                            <br>
                                            Perawat IGD = ((PERAWAT IGD)) * 40%
                                            <br>
                                            Penjelasan : 
                                            LOL .. :v
                                            </p>
                                            <p>
                                                <b><u>Varible rumus:</u></b><br>
                                                <?php $__currentLoopData = $variable_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_ket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($row_ket); ?><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_kategori_tindakan_ket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($data_kategori_tindakan_ket->nama); ?><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </p>
                                            
                                            
                                            <input type="hidden" name="nama_variabel" value="<?php echo e($row); ?>">
                                            <div class="form-group">
                                                <label for="Name">Rumus</label><br>                                  
                                                <input type="text" class="form-control" name="rumus" value=" <?php if(isset($show_varieble_rumuss[$row])): ?> <?php echo e($show_varieble_rumuss[$row]); ?> <?php endif; ?>"  autofocus required>
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
                            <th>Rumus</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Rumus</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_kategori_tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_kategori_tindakan->nama); ?></td>
                                <td><?php if(isset($show_varieble_rumuss[$data_kategori_tindakan->nama])): ?> <?php echo e($show_varieble_rumuss[$data_kategori_tindakan->nama]); ?> <?php endif; ?></td>
                                <td>
                                    <!-- <a href="<?php echo e(url('daftar_rumus_kategori/'. $data_kategori_tindakan->id_kategori_tindakan )); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Rumus</a> -->
                                    <a href="#" data-toggle="modal" data-target="#create_data<?php echo e($data_kategori_tindakan->id_kategori_tindakan); ?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Rumus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="create_data<?php echo e($data_kategori_tindakan->id_kategori_tindakan); ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content  bg-danger">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Buat data rumus " <?php echo e($data_kategori_tindakan->nama); ?> "</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?php echo e(route('variable_rumus.store')); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <p>
                                                Berikut meurupakan contoh dalam penulisan rumus variable dengan variable atau dengan angka.
                                                <br>
                                                Perawat IGD = ((PERAWAT IGD)) * 40%
                                                <br>
                                                Penjelasan : 
                                                LOL .. :v
                                                </p>
                                                <p>
                                                    <b><u>Varible rumus:</u></b><br>
                                                    <?php $__currentLoopData = $variable_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($row); ?><br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_kategori_tindakan_ket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($data_kategori_tindakan_ket->nama); ?><br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </p>
                                                
                                                <input type="text" name="nama_variabel" value="<?php echo e($data_kategori_tindakan->nama); ?>">
                                                <div class="form-group">
                                                    <label for="Name">Rumus</label><br>
                                                    <input type="text" class="form-control" name="rumus" value=" <?php if(isset($show_varieble_rumuss[$data_kategori_tindakan->nama])): ?> <?php echo e($show_varieble_rumuss[$data_kategori_tindakan->nama]); ?> <?php endif; ?>"  autofocus required>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL\resources\views/variable_rumus/index.blade.php ENDPATH**/ ?>