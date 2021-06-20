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
                    <h1>Daftar upah karyawan penunjang periode <br>({{ $data_periodes->bulan }} - {{ $data_periodes->tahun }})</h1>
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
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM AKHIR</th>
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
                            <th>IKU</th>
                            <th>IKI</th>
                            <th>PM AKHIR</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        @for($i=0; $i < count($data_upah_penunjangs); $i++)
                            <tr>
                                <td>{{ ($i+1) }}</td>
                                <td><a href="{{ url('detail_upah_karyawan_penunjang/'. $data_periodes->id_periode . '/' . $data_upah_penunjangs[$i]['id_karyawan_penunjang']) }}" class="text-dark">{{ $data_upah_penunjangs[$i]['nama'] }}</a></td>
                                <td>{{ $data_upah_penunjangs[$i]['kredential'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['unit'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['posisi'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['performa'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['disiplin'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['komplain'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['pm'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['iku'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['iki'] }}</td>
                                <td>{{ $data_upah_penunjangs[$i]['pm_proses'] }}</td>
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