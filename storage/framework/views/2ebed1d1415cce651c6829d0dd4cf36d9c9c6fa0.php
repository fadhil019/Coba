<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Sport">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo e(config('app.name', 'Laravel')); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <link href="<?php echo e(asset('css/open-iconic/font/css/open-iconic-foundation.css')); ?>" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/jqvmap/jqvmap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/summernote-bs4.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/toastr/toastr.min.css')); ?>">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar/main.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar-daygrid/main.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar-timegrid/main.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar-bootstrap/main.min.css')); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
			 	integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
			 	crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
  integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
  crossorigin=""></script>
  <!-- Google Font -->
  <style>
    .img-data-photo
    {
      height:20%;
      text-align: right;
    }
    .img-detail 
    {
      border: 4px solid #ddd;
      border-radius: 4px;
    }
    #mapid { 
      height: 500px; 
      width: 100%;
    }
    #mapid img { 
      height: 100px; 
      width: 120px;
    }
  </style>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- Select2 -->
<script src="<?php echo e(asset('plugins/select2/js/select2.full.min.js')); ?>"></script>
<!-- DataTables -->
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo e(asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo e(asset('plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo e(asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>
<!-- Toastr -->
<script src="<?php echo e(asset('plugins/toastr/toastr.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-daygrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-timegrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-interaction/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-bootstrap/main.min.js')); ?>"></script>
<!-- InputMask -->
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
      "responsive": true,
    })
  });
  function AlterDataCRUD(data, ket) {
    Swal.fire({
        position: 'top',
        showConfirmButton: false,
        timer: 1300,
        icon: ket,
        title: data
    })
  }
  function ErrorData(data, ket) {
    Swal.fire({
        position: 'top',
        showConfirmButton: false,
        timer: 1300,
        icon: ket,
        title: data
    })
  }
  function ModalPayment(data, ket) {
    Swal.fire({
        position: 'top',
        showConfirmButton: false,
        timer: 5000,
        icon: ket,
        title: data
    })
  }
  $("#input_username").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
    },
    keyup: function(){
    this.value = this.value.toLowerCase();
    },
    change: function() {
      this.value = this.value.replace(/\s/g, "", "/^[a-zA-Z0-9]*$/");
      
    }
  });
  //Timepicker
  $('#timepicker').datetimepicker({
      format: 'HH:mm'
  });
  $('#timepicker2').datetimepicker({
      format: 'HH:mm'
  });
</script>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html><?php /**PATH D:\PROJECT\KERJAAN\TA-FADHIL\resources\views/layouts/auth.blade.php ENDPATH**/ ?>