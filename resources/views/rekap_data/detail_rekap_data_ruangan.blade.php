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
                    <h1>Rekap data " PERAWAT {{ $rekap_data_ruangans[0]['pilih_ruangan'] }} " periode " {{ $data_periodes->bulan }} - {{ $data_periodes->tahun }} "</h1>
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
                                <li class="mr-2" id="tombol_pdf_ruangan"></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable_pdf_ruangan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SEP</th>
                                <th>Nama Pasien</th>
                                <th>Ruangan</th>
                                <th>Upah jasa pelayanan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                @if(isset($rekap_data_ruangans[0]['sep_pasien']) && $rekap_data_ruangans[0]['total_jp'] != 0)
                                <td></td>
                                <td></td>
                                <th>{{ round($rekap_data_ruangans[0]['total_jp'] + $rekap_data_jtls['JTL'][0]['upah_jasa']) }}</th>
                                @else
                                <td></td>
                                <td></td>
                                <th>0</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                                @if(isset($rekap_data_ruangans[0]['sep_pasien']) && $rekap_data_ruangans[0]['total_jp'] != 0)
                                @for ($i=0; $i < count($rekap_data_ruangans); $i++)
                                    <tr>
                                        <td>{{ $rekap_data_ruangans[$i]['sep_pasien'] }}</td>  
                                        <td>{{ $rekap_data_ruangans[$i]['nama_pasien'] }}</td>                          
                                        <td>{{ $rekap_data_ruangans[$i]['ruangan'] }}</td>
                                        <td>{{ $rekap_data_ruangans[$i]['nominal'] }}</td>
                                    </tr>
                                @endfor
                                <tr>
                                        <td>JTL</td>
                                        <td></td>           
                                        <td></td>                 
                                        <td>{{ round($rekap_data_jtls['JTL'][0]['upah_jasa']) }}</td>
                                </tr>
                                @else
                                @endif
                                
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