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
                <div class="col">
                    <h1>Detail upah karyawan perawat " {{ $data_upah_perawats[0]['nama'] }} " <br> periode ({{ $data_periodes->bulan }} - {{ $data_periodes->tahun }})</h1>
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
                        <h4>Point karyawan</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        @for($i=0; $i < count($data_upah_perawats); $i++)
                            <tr>
                                <td>{{ ($i+1) }}</td>
                                <td>{{ $data_upah_perawats[$i]['nama'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['kredential'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['unit'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['posisi'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['performa'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['disiplin'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['komplain'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['pm'] }}</td>
                                <!-- <td>
                                    <a href="#"  class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td> -->
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

    <div class="row">
        <div class="col-12">
        <input type="hidden" value="{{ $no = 1 }}">
        <div class="card">
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h4>Tahap 1</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        @for($i=0; $i < count($data_upah_perawats); $i++)
                            <tr>
                                <td>{{ $data_upah_perawats[$i]['iku_1'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['iki_1'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['pm_proses_1'] }}</td>
                                <!-- <td>
                                    <a href="#"  class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td> -->
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

    <div class="row">
        <div class="col-12">
        <input type="hidden" value="{{ $no = 1 }}">
        <div class="card">
            <div class="card-header">
                <div class="row pt-2 mb-2">
                    <div class="col-sm-6">
                        <h4>Tahap 2</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        @for($i=0; $i < count($data_upah_perawats); $i++)
                            <tr>
                                <td>{{ $data_upah_perawats[$i]['iku_2'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['iki_2'] }}</td>
                                <td>{{ $data_upah_perawats[$i]['pm_proses_2'] }}</td>
                                <!-- <td>
                                    <a href="#"  class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td> -->
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