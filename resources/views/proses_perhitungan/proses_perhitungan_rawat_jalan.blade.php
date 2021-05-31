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
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
        <div class="card">
        <input type="hidden" value="{{ $no = 1 }}">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: white;">No</th>
                            <th style="background-color: white;">Pasien</th>
                            <th style="background-color: red;">ADM</th>
                            <th style="background-color: pink;">TINDAKAN</th>
                            @foreach($data_kategori_tindakans as $row)
                            <th style="background-color: green;">{{ $row->nama }}</th>
                            @endforeach
                            @foreach($data_dokters as $row)
                            <th style="background-color: yellow;">{{ $row->nama_dokter }}</th>
                            @endforeach
                            <th style="background-color: grey;">Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="background-color: white;">No</th>
                            <th style="background-color: white;">Pasien</th>
                            <th style="background-color: red;">ADM</th>
                            <th style="background-color: pink;">TINDAKAN</th>
                            @foreach($data_kategori_tindakans as $row)
                            <th style="background-color: green;">{{ $row->nama }}</th>
                            @endforeach
                            @foreach($data_dokters as $row)
                            <th style="background-color: yellow;">{{ $row->nama_dokter }}</th>
                            @endforeach
                            <th style="background-color: grey;">Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_pasiens as $row_data_pasiens)
                            <tr>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $row_data_pasiens->nama_pasien }}
                                </td>
                                <td>
                                    @if(isset($hasil[$row_data_pasiens->id_transaksi]['Ke 1']['adm']['adm']))
                                        {{ $hasil[$row_data_pasiens->id_transaksi]['Ke 1']['adm']['adm'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hasil[$row_data_pasiens->id_transaksi]['Ke 1']['hasil_tindakan']))
                                        {{ $hasil[$row_data_pasiens->id_transaksi]['Ke 1']['hasil_tindakan'] }}
                                    @else
                                        -
                                    @endif
                                    
                                </td>
                                @foreach($data_kategori_tindakans as $row)
                                <td>
                                    @if(isset($hasil[$row_data_pasiens->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row->id_kategori_tindakan]))
                                        {{ $hasil[$row_data_pasiens->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$row->id_kategori_tindakan] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                @endforeach
                                @foreach($data_dokters as $row)
                                <td>
                                    @if(isset($hasil[$row_data_pasiens->id_transaksi]['Ke 1']['dokter'][$row->id_dokter]))
                                        {{ $hasil[$row_data_pasiens->id_transaksi]['Ke 1']['dokter'][$row->id_dokter] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                @endforeach
                                <td>
                                    @if(isset($hasil[$row_data_pasiens->id_transaksi]['Ke 1']['total']))
                                        {{ $hasil[$row_data_pasiens->id_transaksi]['Ke 1']['total'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('show_detail_proses_perhitungan_rawat_jalan/'.$id_periode.'/'.$id_ruangan.'/'.$row_data_pasiens->id_transaksi )}}"  class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
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