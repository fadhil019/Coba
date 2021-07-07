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
                    <h1>Detail data karyawan " {{ $data_upah_perawats[0]['nama'] }} " periode " {{ $data_periodes->bulan }} - {{ $data_periodes->tahun }} "</h1>
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
            <input type="hidden" value="{{ $no = 1 }}">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h4>Detail</h4>
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
                                <th>Rp. {{ number_format($data_upah_perawats[0]['upah_jasa'],2,",",".") }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>IKU 1</td>
                                <td>Rp. {{ number_format($data_upah_perawats[0]['iku_1'],2,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>IKI 1</td>
                                <td>Rp. {{ number_format($data_upah_perawats[0]['iki_1'],2,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>PM 1</td>
                                <td>Rp. {{ number_format($data_upah_perawats[0]['pm_proses_1'],2,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>IKU 2</td>
                                <td>Rp. {{ number_format($data_upah_perawats[0]['iku_2'],2,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>IKI 2</td>
                                <td>Rp. {{ number_format($data_upah_perawats[0]['iki_2'],2,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>PM 2</td>
                                <td>Rp. {{ number_format($data_upah_perawats[0]['pm_proses_2'],2,",",".") }}</td>
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
@endsection
@section('script')

@endsection