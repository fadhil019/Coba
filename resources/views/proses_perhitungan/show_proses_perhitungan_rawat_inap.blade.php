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
                    <h1>Detail perhitungan pasien " {{ $data_pasiens[0]->nama_pasien }} "</h1>
                </div>
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
                                    @if(isset($data_pasiens[0]->nama_dokter))
                                        {{ $data_pasiens[0]->nama_dokter }}
                                    @else
                                        -
                                    @endif
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
        <input type="hidden" value="{{ $no = 1 }}">
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
                <table id="dataTable20" class="table table-bordered table-striped">
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
                            <th>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['total'],2,",",".") }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['adm']['adm'],2,",",".") }}</td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['gizi']['gizi'],2,",",".") }}</td>
                        </tr>

                        @foreach($data_ruangans as $ruangan)
                        <tr>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>     
                            <td>
                                @php
                                    $index = 'perawat_' . $ruangan->nama_ruangan;
                                @endphp
                                @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 1'][$index]))
                                    {{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1'][$index],2,",",".") }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan']); $i++)
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$i]['jumlah_jp'],2,",",".") }}</td>
                            </tr>
                        @endfor
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>DOKTER</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['visite']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['visite']); $i++)
                                <tr>
                                    <td>VISITE</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['visite'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['visite'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        
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
                        <h4>Proses perhitungan ke 2</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable20" class="table table-bordered table-striped">
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
                            <th>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['total'] }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['adm']['adm'] }}</td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['gizi']['gizi'] }}</td>
                        </tr>

                        @foreach($data_ruangans as $ruangan)
                        <tr>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>     
                            <td>
                                @php
                                    $index = 'perawat_' . $ruangan->nama_ruangan;
                                @endphp
                                @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 2'][$index]))
                                    {{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2'][$index] }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan']); $i++)
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][$i]['jumlah_jp'] }}</td>
                            </tr>
                        @endfor
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter'][$i]['jumlah_jp'] }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>DOKTER</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['visite']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['visite']); $i++)
                                <tr>
                                    <td>VISITE</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['visite'][$i]['nama_dokter'] }}</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['visite'][$i]['jumlah_jp'] }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        
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
                        <h4>Proses perhitungan ke 3</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable20" class="table table-bordered table-striped">
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
                            <th>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['total'],2,",",".") }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['adm']['adm'],2,",",".") }}</td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['gizi']['gizi'],2,",",".") }}</td>
                        </tr>

                        @foreach($data_ruangans as $ruangan)
                        <tr>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>     
                            <td>
                                @php
                                    $index = 'perawat_' . $ruangan->nama_ruangan;
                                @endphp
                                @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 3'][$index]))
                                    {{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3'][$index],2,",",".") }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan']); $i++)
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][$i]['jumlah_jp'],2,",",".") }}</td>
                            </tr>
                        @endfor
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>DOKTER</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['visite']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['visite']); $i++)
                                <tr>
                                    <td>VISITE</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['visite'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['visite'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        
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
                        <h4>Proses perhitungan ke 4</h4>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="dataTable20" class="table table-bordered table-striped">
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
                            <th>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['total'],2,",",".") }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>ADM</td>
                            <td>ADM</td>
                            <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['adm']['adm'],2,",",".") }}</td>
                        </tr>
                        <tr>
                            <td>GIZI</td>
                            <td>GIZI</td>
                            <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['gizi']['gizi'],2,",",".") }}</td>
                        </tr>
                        
                        @foreach($data_ruangans as $ruangan)
                        <tr>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>
                            <td>PERAWAT {{ $ruangan->nama_ruangan }}</td>     
                            <td>
                                @php
                                    $index = 'perawat_' . $ruangan->nama_ruangan;
                                @endphp
                                @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 4'][$index]))
                                    {{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4'][$index],2,",",".") }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan']); $i++)
                            <tr>
                                <td>KATEGORI TINDAKAN</td>
                                <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$i]['jumlah_jp'],2,",",".") }}</td>
                            </tr>
                        @endfor
                       @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>DOKTER</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        @endif
                        @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['visite']))
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['visite']); $i++)
                                <tr>
                                    <td>VISITE</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['visite'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['visite'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td>VISITE</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
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