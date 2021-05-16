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
                    <h1>Data tahun " <?php echo e($tahun); ?> "</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('dokter.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="Nama">Bagian</label>
                                    <select class="form-control" name="bagian">
                                        <?php $__currentLoopData = $data_periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data_periode->id_periode); ?>" ><?php echo e($data_periode->id_periode); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="Nama" class="text-white">Bagian</label>
                                    <button type="submit" class="form-control btn btn-primary">
                                        <?php echo e(__('Simpan')); ?>

                                    </button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('dokter.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="Nama">Bagian</label>
                                    <select class="form-control" name="bagian">
                                        <?php $__currentLoopData = $data_periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data_periode->id_periode); ?>" ><?php echo e($data_periode->id_periode); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="Nama" class="text-white">Bagian</label>
                                    <button type="submit" class="form-control btn btn-primary">
                                        <?php echo e(__('Simpan')); ?>

                                    </button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/dashboard/index.blade.php ENDPATH**/ ?>