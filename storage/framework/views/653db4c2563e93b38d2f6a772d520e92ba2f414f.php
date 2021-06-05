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
                <div class="col">
                    <h1>Rekap data dokter " <?php echo e($rekap_data_dokters[0]['nama_dokter']); ?> " periode " <?php echo e($data_periodes->bulan); ?> - <?php echo e($data_periodes->tahun); ?> "</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                    </ol>
                </div> -->
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
                            <h4>Daftar nama dokter</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="mr-2" id="tombol_pdf_dokter"></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable_pdf_dokter" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Upah jasa pelayanan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?php echo e($rekap_data_dokters[0]['upah_jasa_total']); ?></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $__currentLoopData = $rekap_data_dokters[0]['ruangan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row); ?></td>
                                    <td><?php echo e($val); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($rekap_data_dokters[0]['nama_kategori_tindakan']); ?></td>
                                <td><?php echo e($rekap_data_dokters[0]['upah_jasa_kategori']); ?></td>
                            </tr>
                            <tr>
                                <td>JTL</td>
                                <td><?php echo e($rekap_data_dokters[0]['upah_jasa_jtl']); ?></td>
                            </tr>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\JOKI\TA-FADHIL-NEW\resources\views/rekap_data/detail_rekap_data_dokter.blade.php ENDPATH**/ ?>