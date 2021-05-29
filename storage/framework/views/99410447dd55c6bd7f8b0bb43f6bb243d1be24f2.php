<?php $__env->startSection('content'); ?>
<?php
  function tanggal_indo($tanggal, $cetak_hari = false)
  {
      $bulan = array (1 =>   'Januari',
                  'Februari',
                  'Maret',
                  'April',
                  'Mei',
                  'Juni',
                  'Juli',
                  'Agustus',
                  'September',
                  'Oktober',
                  'November',
                  'Desember'
              );
      $tgl_indo = $bulan[$tanggal];
      return $tgl_indo;
  }
?>
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
                    <form method="POST" action="<?php echo e(url('dashboard_pilih_tahun')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="Nama">Tahun</label>
                                    <select class="form-control" name="dashboard_tahun">
                                        <?php $__currentLoopData = $data_periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data_periode->tahun); ?>" ><?php echo e($data_periode->tahun); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="Nama" class="text-white">Bagian</label>
                                    <button type="submit" class="form-control btn btn-primary">
                                        <?php echo e(__('Atur')); ?>

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
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h3>Data pendapatan " <?php echo e($tahun); ?> "</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- RATA -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h3>Data rata -rata pendapatan " <?php echo e($tahun); ?> "</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Pendapan rata - rata dokter yaitu " Rp. <?php echo e($data_dashboards['rata_rata_dokter']); ?> "
                    </p>
                    <p>
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Pendapan rata - rata admin yaitu " Rp. <?php echo e($data_dashboards['rata_rata_admin']); ?> "
                    </p>
                    <p>
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Pendapan rata - rata penunjang yaitu " Rp. <?php echo e($data_dashboards['rata_rata_penunjang']); ?> "
                    </p>
                    <p>
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Pendapan rata - rata perawat yaitu " Rp. <?php echo e($data_dashboards['rata_rata_perawat']); ?> "
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- PENDAPATAN TERBESAR -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h3>Data pendapatan terbesar " <?php echo e($tahun); ?> "</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>
                        <i class="fas fa-chart-line" aria-hidden="true"></i> Pendapan dokter terbesar yaitu pada bulan " <?php echo e(tanggal_indo($data_dashboards['terbesar_dokter'])); ?> "
                    </p>
                    <p>
                        <i class="fas fa-chart-line" aria-hidden="true"></i> Pendapan admin terbesar yaitu pada bulan " <?php echo e(tanggal_indo($data_dashboards['terbesar_admin'])); ?> "
                    </p>
                    <p>
                        <i class="fas fa-chart-line" aria-hidden="true"></i> Pendapan penunjang terbesar yaitu pada bulan " <?php echo e(tanggal_indo($data_dashboards['terbesar_penunjang'])); ?> "
                    </p>
                    <p>
                        <i class="fas fa-chart-line" aria-hidden="true"></i> Pendapan perawat terbesar yaitu pada bulan " <?php echo e(tanggal_indo($data_dashboards['terbesar_perawat'])); ?> "
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.

    var dataTampung = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Okteober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Dokter',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
                <?php for($i = 0; $i < count($data_dashboards['dokter']); $i++): ?>
                    <?php echo e($data_dashboards['dokter'][$i]); ?> ,
                <?php endfor; ?>
          ]
        },
        {
          label               : 'Perawat',
          backgroundColor     : 'rgba(252, 186, 3,0.9)',
          borderColor         : 'rgba(252, 186, 3,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(252, 186, 3,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(252, 186, 3,1)',
          data                : [
                <?php for($i = 0; $i < count($data_dashboards['perawat']); $i++): ?>
                    <?php echo e($data_dashboards['perawat'][$i]); ?> ,
                <?php endfor; ?>
          ]
        },
        {
          label               : 'Admin',
          backgroundColor     : 'rgba(8, 252, 0,0.9)',
          borderColor         : 'rgba(8, 252, 0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(8, 252, 0,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(8, 252, 0,1)',
          data                : [
                <?php for($i = 0; $i < count($data_dashboards['admin']); $i++): ?>
                    <?php echo e($data_dashboards['admin'][$i]); ?> ,
                <?php endfor; ?>
          ]
        },
        {
          label               : 'Penunjang',
          backgroundColor     : 'rgba(252, 0, 0,0.9)',
          borderColor         : 'rgba(252, 0, 0,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(252, 0, 0,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(252, 0, 0,1)',
          data                : [
                <?php for($i = 0; $i < count($data_dashboards['penunjang']); $i++): ?>
                    <?php echo e($data_dashboards['penunjang'][$i]); ?> ,
                <?php endfor; ?>
          ]
        },
        // {
        //   label               : 'Electronics',
        //   backgroundColor     : 'rgba(210, 214, 222, 1)',
        //   borderColor         : 'rgba(210, 214, 222, 1)',
        //   pointRadius         : false,
        //   pointColor          : 'rgba(210, 214, 222, 1)',
        //   pointStrokeColor    : '#c1c7d1',
        //   pointHighlightFill  : '#fff',
        //   pointHighlightStroke: 'rgba(220,220,220,1)',
        //   data                : [65, 59, 80, 81, 56, 55, 40]
        // },
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, dataTampung)
    // var temp0 = dataTampung.datasets[0]
    var temp_dokter = dataTampung.datasets[0]
    var temp_perawat = dataTampung.datasets[1]
    var temp_admin = dataTampung.datasets[2]
    var temp_penunjang = dataTampung.datasets[3]
    barChartData.datasets[0] = temp_dokter
    barChartData.datasets[1] = temp_perawat
    barChartData.datasets[2] = temp_admin
    barChartData.datasets[3] = temp_penunjang

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL-NEW\resources\views/dashboard/index.blade.php ENDPATH**/ ?>