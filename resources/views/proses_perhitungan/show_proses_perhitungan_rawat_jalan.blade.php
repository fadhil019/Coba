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
                    <!-- <div class="row pt-2 mb-2">
                    <div class="col-sm-6"> -->
                        <h3>Proses Perhitungan Penjumlahan Jasa Pelayanan Setaip Kategori</h3>
                        <p>*Ketetangan : Proses perhitungan untuk mendapatkan jumlah upah jasa pelayanan <br>dari nominal tindakan yang termasuk pada setiap kategori tindakan.</p>
                 <!--    </div>
                </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
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
                                    @php
                                        $index = 'PERAWAT ' . $data_ruangan_pasien->nama_ruangan;
                                    @endphp
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 1'][$index]))
                                <tr>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1'][$index],2,",",".") }}</td>
                                </tr>
                            @endif
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan']))
                                @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan']); $i++)
                                    <tr>
                                        <td>KATEGORI TINDAKAN</td>
                                        <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                        <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['hasil_kategori_tindakan'][$i]['jumlah_jp'],2,",",".") }}</td>
                                    </tr>
                                @endfor
                            @endif
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 1']['dokter'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        </tbody> 
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="hidden" value="{{ $no = 1 }}">
            <div class="card">
                <div class="card-header">
                     <!-- <div class="row pt-2 mb-2">
                    <div class="col-sm-6"> -->
                        <h3>Proses Menghitunga Persentase Kontribusi Setiap Kategori atau Variabel</h3>
                        <p>*Ketetangan : Proses perhitungan untuk mencari persentase dari setiap kategori atau variabel, <br>Variabel yang dipakai dalam perhitungan yaitu nominal dibagi dengna total. Contoh :  'nominal ADM / Total' </p>
                   <!--  </div>
                </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
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
                                <th>{{ round($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['total']) * 100 }}%</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>ADM</td>
                                <td>ADM</td>
                                <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['adm']['adm'] }}</td>
                            </tr>
                                    @php
                                        $index = 'PERAWAT ' . $data_ruangan_pasien->nama_ruangan;
                                    @endphp
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 2'][$index]))
                                <tr>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 2'][$index],2,",",".") }}</td>
                                </tr>
                            @endif
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan']))
                                @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan']); $i++)
                                    <tr>
                                        <td>KATEGORI TINDAKAN</td>
                                        <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                        <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['hasil_kategori_tindakan'][$i]['jumlah_jp'] }}</td>
                                    </tr>
                                @endfor
                            @endif
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 2']['dokter'][$i]['jumlah_jp'] }}</td>
                                </tr>
                            @endfor
                        </tbody> 
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="hidden" value="{{ $no = 1 }}">
            <div class="card">
                <div class="card-header">
                    <!-- <div class="row pt-2 mb-2">
                    <div class="col-sm-6"> -->
                       <h3>Proses Menghitung Nominal Rupiah Setiap Kategori.</h3>
                       <p>*Keterangan : Pada proses ini akan mengguankan nominal pada setiap proses sebelumnya dikali dengan nominal keuangan pasien BPJS tersebut.
                       <br>Pada pasien ini nominal keuangan BPJS adalah : Rp. {{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['total'],2,",",".") }}</p>
                    <!-- </div>
                </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
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
                                    @php
                                        $index = 'PERAWAT ' . $data_ruangan_pasien->nama_ruangan;
                                    @endphp
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 3'][$index]))
                                <tr>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3'][$index],2,",",".") }}</td>
                                </tr>
                            @endif
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan']))
                                @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan']); $i++)
                                    <tr>
                                        <td>KATEGORI TINDAKAN</td>
                                        <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                        <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['hasil_kategori_tindakan'][$i]['jumlah_jp'],2,",",".") }}</td>
                                    </tr>
                                @endfor
                            @endif
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 3']['dokter'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        </tbody> 
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- perhitungan ke 4 -->
    <div class="row">
        <div class="col-12">
            <input type="hidden" value="{{ $no = 1 }}">
            <div class="card">
                <div class="card-header">
                    <!-- <div class="row pt-2 mb-2">
                    <div class="col-sm-6"> -->
                        <h3>Proses Menghitung Upah Jasa Pelayanan Setiap Variabel atau Kategori</h3>
                        <p>*Keterangan : Pada proses ini akan memproses perhitungan berdasarkan rumus yang telah ditambah oleh karaywan pada menu "Rumus-rumus".</p>
                    <!-- </div>
                </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
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
                                    @php
                                        $index = 'PERAWAT ' . $data_ruangan_pasien->nama_ruangan;
                                    @endphp
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 4'][$index]))
                                <tr>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>PERAWAT {{ $data_ruangan_pasien->nama_ruangan }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4'][$index],2,",",".") }}</td>
                                </tr>
                            @endif
                            @if(isset($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan']))
                                @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan']); $i++)
                                    <tr>
                                        <td>KATEGORI TINDAKAN</td>
                                        <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$i]['nama_kategori'] }}</td>
                                        <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['hasil_kategori_tindakan'][$i]['jumlah_jp'],2,",",".") }}</td>
                                    </tr>
                                @endfor
                            @endif
                            @for($i=0; $i < count($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter']); $i++)
                                <tr>
                                    <td>DOKTER</td>
                                    <td>{{ $hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter'][$i]['nama_dokter'] }}</td>
                                    <td>{{ number_format($hasil[$data_pasiens[0]->id_transaksi]['Ke 4']['dokter'][$i]['jumlah_jp'],2,",",".") }}</td>
                                </tr>
                            @endfor
                        </tbody> 
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
@section('script')

@endsection