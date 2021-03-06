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
                    <h1>Rekap data Kategori Tindakan " {{ $nama_kategori }} " periode " {{ $data_periodes->bulan }} - {{ $data_periodes->tahun }} "</h1>
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
                                <li class="mr-2" id="tombol_pdf_kategori"></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable_pdf_kategori" class="table table-bordered table-striped">
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
                                @if(isset($rekap_data_kategori_tindakans[0]['sep_pasien']))
                                <td></td>
                                <td>
                                <th>Rp. {{ number_format(round($rekap_data_kategori_tindakans[0]['total_jp'] + $rekap_data_jtls['JTL'][0]['upah_jasa']),2,",",".") }}</th>
                                @else
                                <td></td>
                                <td></td>
                                <th>0</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                                @if(isset($rekap_data_kategori_tindakans[0]['sep_pasien']))
                                @for ($i=0; $i < count($rekap_data_kategori_tindakans); $i++)
                                    <tr>
                                        <td>{{ $rekap_data_kategori_tindakans[$i]['sep_pasien'] }}</td>  
                                        <td>{{ $rekap_data_kategori_tindakans[$i]['nama_pasien'] }}</td>  
                                        <td>{{ $rekap_data_kategori_tindakans[$i]['ruangan'] }}</td>                        
                                        <td>Rp. {{ number_format($rekap_data_kategori_tindakans[$i]['nominal'],2,",",".") }}</td>
                                    </tr>
                                @endfor
                                <tr>
                                        <td>JTL</td>
                                        <td></td>
                                        <td></td>                           
                                        <td>Rp. {{ number_format(round($rekap_data_jtls['JTL'][0]['upah_jasa']),2,",",".") }}</td>
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