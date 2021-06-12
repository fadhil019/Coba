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
                    <h1>Rekap data periode " {{ $data_periodes->bulan }} - {{ $data_periodes->tahun }} "</h1>
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
                        <h4>Daftar nama dokter</h4>
                        <span>*klik pada nama dokter untuk melihat detail</span>
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
                            <th>No</th>
                            <th>Nama dokter</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama dokter</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i=0; $i < count($rekap_data_dokters); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td><a href="{{ url('detail_rekap_data_dokter/'. $data_periodes->id_periode . '/' . $rekap_data_dokters[$i]['id_dokter']) }}" class="text-dark">{{ $rekap_data_dokters[$i]['nama_dokter'] }}</a></td>
                                <td>{{ $rekap_data_dokters[$i]['upah_jasa'] }}</td>
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
                        <h4>Daftar kategori lainnya</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2" id="tombol_pdf_penunjang"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable_pdf_penunjang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Bagian</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Bagian</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i=0; $i < count($rekap_data_kategori_tindakans); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $rekap_data_kategori_tindakans[$i]['nama_kategori_tindakan'] }}</td>
                                <td>{{ $rekap_data_kategori_tindakans[$i]['bagian_kategori_tindakan'] }}</td>
                                @if($rekap_data_ruangans[$i]['upah_jasa'] == 0)
                                    <td>{{ $rekap_data_kategori_tindakans[$i]['upah_jasa'] }}</td>
                                @else
                                    <td>{{ $rekap_data_kategori_tindakans[$i]['upah_jasa'] + $rekap_data_jtls['JTL'][0]['upah_jasa'] }}</td>
                                @endif
                            </tr>
                        @endfor
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['nama_kategori'] }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['bagian'] }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['upah_jasa'] }}</td>
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
                        <h4>Daftar ruangan</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="mr-2" id="tombol_pdf_perawat"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable_pdf_perawat" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Bagian</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Bagian</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i=0; $i < count($rekap_data_ruangans); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $rekap_data_ruangans[$i]['nama_ruangan'] }}</td>
                                <td>{{ $rekap_data_ruangans[$i]['bagian'] }}</td>
                                @if($rekap_data_ruangans[$i]['upah_jasa'] == 0)
                                    <td>{{ $rekap_data_ruangans[$i]['upah_jasa'] }}</td>
                                @else
                                    <td>{{ $rekap_data_ruangans[$i]['upah_jasa'] + $rekap_data_jtls['JTL'][0]['upah_jasa'] }}</td>
                                @endif
                            </tr>
                        @endfor
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['nama_kategori'] }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['bagian'] }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['upah_jasa'] }}</td>
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
                        <h4>Daftar admin remunerasi</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="mr-2" id="tombol_pdf_admin"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable_pdf_admin" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Bagian</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama kategori</th>
                            <th>Bagian</th>
                            <th>Upah jasa pelayanan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i=0; $i < count($rekap_data_admin_remus); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $rekap_data_admin_remus[$i]['nama_kategori'] }}</td>
                                <td>{{ $rekap_data_admin_remus[$i]['bagian'] }}</td>
                                <td>{{ $rekap_data_admin_remus[$i]['upah_jasa'] + $rekap_data_jtls['JTL'][0]['upah_jasa'] }}</td>
                            </tr>
                        @endfor
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['nama_kategori'] }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['bagian'] }}</td>
                            <td>{{ $rekap_data_jtls['JTL'][0]['upah_jasa'] }}</td>
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