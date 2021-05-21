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
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
        <div class="card">
        <input type="hidden" value="<?php echo e($no = 1); ?>">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: white;">No</th>
                            <th style="background-color: white;">Pasien</th>
                            <th style="background-color: white;">DPJP</th>
                            <th style="background-color: red;">ADM</th>
                            <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: green;"><?php echo e($row->nama); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: blue;">Perawat IGD</th>
                            <?php $__currentLoopData = $data_dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: yellow;"><?php echo e($row->nama_dokter); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: orange;">Tindakan<br>Perawat ICCU</th>
                            <th style="background-color: orange;">Tindakan<br>Perawat RPP</th>
                            <?php $__currentLoopData = $data_dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: pink;"><?php echo e($row->nama_dokter); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: brown;">Gizi</th>
                            <th style="background-color: grey;">Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="background-color: white;">No</th>
                            <th style="background-color: white;">Pasien</th>
                            <th style="background-color: white;">DPJP</th>
                            <th style="background-color: red;">ADM</th>
                            <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: green;"><?php echo e($row->nama); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: blue;">Perawat IGD</th>
                            <?php $__currentLoopData = $data_dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: yellow;"><?php echo e($row->nama_dokter); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: orange;">Tindakan<br>Perawat ICCU</th>
                            <th style="background-color: orange;">Tindakan<br>Perawat RPP</th>
                            <?php $__currentLoopData = $data_dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: pink;"><?php echo e($row->nama_dokter); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="background-color: brown;">Gizi</th>
                            <th style="background-color: grey;">Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $data_pasiens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_data_pasiens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($no++); ?>

                                </td>
                                <td>
                                    <?php echo e($row_data_pasiens->nama_pasien); ?>

                                </td>
                                <td>
                                    <?php if($row_data_pasiens->id_dokter_dpjp != null): ?>
                                        <?php echo e($row_data_pasiens->nama_dokter); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['adm']['adm']); ?>

                                </td>
                                <?php $__currentLoopData = $data_kategori_tindakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php if(isset($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row->id_kategori_tindakan])): ?>
                                        <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$row->id_kategori_tindakan]); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['perawat_igd']); ?>

                                </td>
                                <?php $__currentLoopData = $data_dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php if(isset($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['dokter'][$row->id_dokter])): ?>
                                        <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['dokter'][$row->id_dokter]); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php if(isset($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['perawat_iccu'])): ?>
                                        <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['perawat_iccu']); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                    
                                </td>
                                <td>
                                    <?php if(isset($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['perawat_rpp'])): ?>
                                        <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['perawat_rpp']); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <?php $__currentLoopData = $data_dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php if(isset($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['visite'][$row->id_dokter])): ?>
                                        <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['visite'][$row->id_dokter]); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td> 
                                    <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['gizi']['gizi']); ?>

                                </td>
                                <td>
                                    <?php echo e($hasil[$row_data_pasiens->id_data_pasien]['Ke 1']['total']); ?>

                                </td>
                                <td>
                                    <a href="<?php echo e(url('show_detail_proses_perhitungan_rawat_inap/'.$id_periode.'/'.$id_ruangan.'/'.$row_data_pasiens->id_data_pasien )); ?>"  class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i> Detail</a>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/proses_perhitungan/proses_perhitungan_rawat_inap.blade.php ENDPATH**/ ?>