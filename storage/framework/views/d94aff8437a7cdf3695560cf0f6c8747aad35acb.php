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
                    <h1>Detail perhitungan pasien " <?php echo e($data_pasiens[0]->nama_pasien); ?> "</h1>
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
                        <h4>Dokter DPJP</h4>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                        </ol>
                    </div> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>DPJP</td>
                                <td>
                                    <?php if(isset($data_pasiens[0]->nama_dokter)): ?>
                                        <?php echo e($data_pasiens[0]->nama_dokter); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
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
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h4>Proses perhitungan ke 1</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['total']); ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['adm']['adm']); ?></td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['gizi']['gizi']); ?></td>
                        </tr>
                        <tr>
                            <td>PERAWAT IGD</td>
                            <td>PERAWAT IGD</td>     
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['perawat_igd'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['perawat_igd']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>PERAWAT ICCU</td>
                            <td>PERAWAT ICCU</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['perawat_iccu'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['perawat_iccu']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>                           
                        </tr>
                        <tr>
                            <td>PERAWAT RPP</td>
                            <td>PERAWAT RPP</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['perawat_rpp'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['perawat_rpp']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td> 
                        </tr>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['hasil_kategori_tindakan']); $i++): ?>
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$i]['nama_kategori']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['hasil_kategori_tindakan'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['dokter']); $i++): ?>
                            <tr>
                                <td>DOKTER</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['dokter'][$i]['nama_dokter']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['dokter'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['visite'])): ?>
                            <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['visite']); $i++): ?>
                                <tr>
                                    <td>VISITE</td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['visite'][$i]['nama_dokter']); ?></td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 1']['visite'][$i]['jumlah_jp']); ?></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        <?php endif; ?>
                        
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
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h4>Proses perhitungan ke 2</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['total']); ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['adm']['adm']); ?></td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['gizi']['gizi']); ?></td>
                        </tr>
                        <tr>
                            <td>PERAWAT IGD</td>
                            <td>PERAWAT IGD</td>     
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['perawat_igd'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['perawat_igd']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>PERAWAT ICCU</td>
                            <td>PERAWAT ICCU</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['perawat_iccu'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['perawat_iccu']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>                           
                        </tr>
                        <tr>
                            <td>PERAWAT RPP</td>
                            <td>PERAWAT RPP</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['perawat_rpp'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['perawat_rpp']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td> 
                        </tr>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['hasil_kategori_tindakan']); $i++): ?>
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][$i]['nama_kategori']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['hasil_kategori_tindakan'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['dokter']); $i++): ?>
                            <tr>
                                <td>DOKTER</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['dokter'][$i]['nama_dokter']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['dokter'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['visite'])): ?>
                            <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['visite']); $i++): ?>
                                <tr>
                                    <td>VISITE</td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['visite'][$i]['nama_dokter']); ?></td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 2']['visite'][$i]['jumlah_jp']); ?></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        <?php endif; ?>
                        
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
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h4>Proses perhitungan ke 3</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['total']); ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['adm']['adm']); ?></td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['gizi']['gizi']); ?></td>
                        </tr>
                        <tr>
                            <td>PERAWAT IGD</td>
                            <td>PERAWAT IGD</td>     
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['perawat_igd'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['perawat_igd']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>PERAWAT ICCU</td>
                            <td>PERAWAT ICCU</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['perawat_iccu'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['perawat_iccu']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>                           
                        </tr>
                        <tr>
                            <td>PERAWAT RPP</td>
                            <td>PERAWAT RPP</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['perawat_rpp'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['perawat_rpp']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td> 
                        </tr>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['hasil_kategori_tindakan']); $i++): ?>
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'][$i]['nama_kategori']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['hasil_kategori_tindakan'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['dokter']); $i++): ?>
                            <tr>
                                <td>DOKTER</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['dokter'][$i]['nama_dokter']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['dokter'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['visite'])): ?>
                            <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['visite']); $i++): ?>
                                <tr>
                                    <td>VISITE</td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['visite'][$i]['nama_dokter']); ?></td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 3']['visite'][$i]['jumlah_jp']); ?></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        <?php endif; ?>
                        
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
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h4>Proses perhitungan ke 4</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['total']); ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['adm']['adm']); ?></td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['gizi']['gizi']); ?></td>
                        </tr>
                        <tr>
                            <td>PERAWAT IGD</td>
                            <td>PERAWAT IGD</td>     
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['perawat_igd'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['perawat_igd']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>PERAWAT ICCU</td>
                            <td>PERAWAT ICCU</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['perawat_iccu'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['perawat_iccu']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>                           
                        </tr>
                        <tr>
                            <td>PERAWAT RPP</td>
                            <td>PERAWAT RPP</td>
                            <td>
                                <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['perawat_rpp'])): ?>
                                    <?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['perawat_rpp']); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td> 
                        </tr>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['hasil_kategori_tindakan']); $i++): ?>
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][$i]['nama_kategori']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['hasil_kategori_tindakan'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['dokter']); $i++): ?>
                            <tr>
                                <td>DOKTER</td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['dokter'][$i]['nama_dokter']); ?></td>
                                <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['dokter'][$i]['jumlah_jp']); ?></td>
                            </tr>
                        <?php endfor; ?>
                        <?php if(isset($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['visite'])): ?>
                            <?php for($i=0; $i < count($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['visite']); $i++): ?>
                                <tr>
                                    <td>VISITE</td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['visite'][$i]['nama_dokter']); ?></td>
                                    <td><?php echo e($hasil[$data_pasiens[0]->id_data_pasien]['Ke 4']['visite'][$i]['jumlah_jp']); ?></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        <?php endif; ?>
                        
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/proses_perhitungan/show_proses_perhitungan_rawat_inap.blade.php ENDPATH**/ ?>