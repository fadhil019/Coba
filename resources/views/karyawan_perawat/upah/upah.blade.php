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
                    <h1>Daftar upah karyawan perawat periode <br>({{ $data_periodes->bulan }} - {{ $data_periodes->tahun }})</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
        <input type="hidden" value="{{ $no = 1 }}">
        <div class="card">
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <!-- <h4>Daftar nama dokter</h4> -->
                        <span>*klik pada nama karyawan untuk melihat detail</span>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2" id="tombol_pdf_dokter"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="dataTable_pdf_dokter" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <!-- <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th> -->
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM</th>
                            <th>Total Upah jasa Pelayanan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <!-- <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th> -->
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM</th>
                            <th>Total Upah jasa Pelayanan</th>                           
                        </tr>
                    </tfoot>
                    <tbody>
                        @for($i=0; $i < count($data_upah_perawats); $i++)
                            <tr>
                                <td>{{ ($i+1) }}</td>
                                <td>
                                <a href="{{ url('detail_upah_karyawan_perawat/'. $data_periodes->id_periode . '/' . $data_upah_perawats[$i]['id_karyawan_perawat'] ) }}"  class="text-dark">{{ $data_upah_perawats[$i]['nama'] }}</a>
                                    
                                </td>
                                <!-- <td>{{ $data_upah_perawats[$i]['kredential'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['unit'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['posisi'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['performa'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['disiplin'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['komplain'] }}</td> -->
                                <!-- <td>{{ $data_upah_perawats[$i]['pm'] }}</td> -->
                                <td>Rp. {{ number_format($data_upah_perawats[$i]['iku'],2,",",".") }}</td>
                                <td>Rp. {{ number_format($data_upah_perawats[$i]['iki'],2,",",".") }}</td>
                                <td>Rp. {{ number_format($data_upah_perawats[$i]['pm_proses'],2,",",".") }}</td>
                                <td>Rp. {{ number_format($data_upah_perawats[$i]['iku'] + $data_upah_perawats[$i]['iki'] + $data_upah_perawats[$i]['pm_proses'],2,",",".") }}</td>
                            </tr>
                        @endfor
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
@endsection
@section('script')

@endsection