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
                    <h1>Data pasien rawat jalan <br>ruangan " <?php echo e($show_ruangans->nama_ruangan); ?> " periode " <?php echo e($show_periodes->bulan); ?> - <?php echo e($show_periodes->tahun); ?> "</h1>
                </div>
                <div class="col-sm-6">
                    <?php if(count($data_pasien_rawat_jalans) > 0): ?>
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="<?php echo e(url('proses_perhitungan_rawat_jalan/' . $show_periodes->id_periode . '/' . $show_ruangans->id_ruangan)); ?>" class="btn btn-primary"><i class="fas fa-sync-alt" aria-hidden="true"></i> Proses</a></li>
                        </ol>
                    <?php else: ?>
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" data-toggle="modal" data-target="#import_data" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Import Data Pasien</a></li>
                        </ol>
                    <?php endif; ?>
                </div>
                <div class="modal fade" id="import_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Import data pasien rawat jalan baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?php echo e(route('data_pasien.importRj')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="Name">Berkas</label><br>
                                        <input type="file" name="excel_data_pasien" autofocus required>
                                    </div>
                                    <input type="hidden" name="id_periode" value="<?php echo e($show_periodes->id_periode); ?>">
                                    <input type="hidden" name="id_ruangan" value="<?php echo e($show_ruangans->id_ruangan); ?>">
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
                            <th>Nama dokter</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama dokter</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_pasien_rawat_jalans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_pasien_rawat_jalan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($data_pasien_rawat_jalan->nama_pasien); ?></td>
                                <td><?php echo e($data_pasien_rawat_jalan->nama_dokter_perawat); ?></td>
                                <td>
                                    <a href="<?php echo e(url('data_pasien_rawat_jalan_detail_tindakan/'.$data_pasien_rawat_jalan->id_data_pasien)); ?>"  class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i> Detail</a>
                                </td>
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
    <!-- /.row -->
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/pasien/rawat_jalan.blade.php ENDPATH**/ ?>