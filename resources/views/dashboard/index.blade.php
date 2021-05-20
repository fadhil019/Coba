@extends('layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header mb-n3">
    @if(\Session::has('alert-success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('alert-success')}}
        </div>
    @endif
    @if(\Session::has('alert-failed'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('alert-failed')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row pt-2 mb-2">
                <div class="col-sm-6">
                    <h1>Data tahun " {{ $tahun }} "</h1>
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
                    <form method="POST" action="{{ url('dashboard_pilih_tahun')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="Nama">Tahun</label>
                                    <select class="form-control" name="dashboard_tahun">
                                        @foreach($data_periodes as $data_periode)
                                            <option value="{{ $data_periode->tahun}}" >{{ $data_periode->tahun }}</option>
                                        @endforeach
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="Nama" class="text-white">Bagian</label>
                                    <button type="submit" class="form-control btn btn-primary">
                                        {{ __('Atur') }}
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
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
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
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
                @for($i = 0; $i < count($data_dashboards); $i++)
                    {{ $data_dashboards[$i]['total_pendapatan'] }} ,
                @endfor
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
    var temp1 = dataTampung.datasets[0]
    barChartData.datasets[0] = temp1
    // barChartData.datasets[1] = temp0

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
@endsection