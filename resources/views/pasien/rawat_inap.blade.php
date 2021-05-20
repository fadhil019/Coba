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
                    <h1>Data pasien rawat inap</h1>
                </div>
                <div class="col-sm-6">
                <input type="hidden" value="{{ $cek_hasil = 0 }}">
                @if(count($data_pasien_rawat_inaps) > 0)
                    @if($hasil == null)
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="{{ url('proses_perhitungan_rawat_inap/' . $show_periodes->id_periode . '/' . $show_ruangans->id_ruangan) }}" class="btn btn-primary"><i class="fas fa-sync-alt" aria-hidden="true"></i> Proses</a></li>
                        </ol>
                    @else
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" class="btn btn-success"><i class="fas fa-sync-alt" aria-hidden="true"></i> Telah Proses</a></li>
                        </ol>
                        {{ $cek_hasil = 1 }}
                    @endif
                @else
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#import_data" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Import Data Pasien</a></li>
                    </ol>
                @endif
                    
                </div>
                <div class="modal fade" id="import_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Import data pasien rawat inap baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('data_pasien.import')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">Berkas</label><br>
                                        <input type="file" name="excel_data_pasien" autofocus required>
                                    </div>
                                    <input type="hidden" name="id_periode" value="{{ $show_periodes->id_periode }}">
                                    <input type="hidden" name="id_ruangan" value="{{ $show_ruangans->id_ruangan }}">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-light">
                                            {{ __('Simpan') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-light pull-right" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
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
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Penjamin</th>
                            <th>DPJP</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Penjamin</th>
                            <th>DPJP</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_pasien_rawat_inaps as $data_pasien_rawat_inap)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_pasien_rawat_inap->nama_pasien }}</td>
                                <td>{{ $data_pasien_rawat_inap->penjamin }}</td>
                                <td>
                                    @if($data_pasien_rawat_inap->nama_dokter == "")
                                        
                                    @else
                                        {{ $data_pasien_rawat_inap->nama_dokter }}
                                    @endif
                                </td>
                                <td>
                                    <!-- <a href="#" data-toggle="modal" data-target="#edit{{ $data_pasien_rawat_inap->id_data_pasien }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah data pelengkap</a> -->
                                    @if( $cek_hasil == 0 )
                                        <a href="{{ url('data_pasien_rawat_inap_tambah_detail_tindakan/'.$data_pasien_rawat_inap->id_data_pasien )}}"  class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>  Tambah data pelengkap</a>
                                    @endif
                                    <a href="{{ url('data_pasien_rawat_inap_detail_tindakan/'.$data_pasien_rawat_inap->id_data_pasien )}}"  class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i> Detail</a>
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