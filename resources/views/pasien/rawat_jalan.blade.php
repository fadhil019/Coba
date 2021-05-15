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
                    <h1>Data pasien rawat jalan <br>ruangan " {{ $show_ruangans->nama_ruangan }} " periode " {{ $show_periodes->bulan }} - {{ $show_periodes->tahun }} "</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="{{ url('proses_perhitungan_rawat_jalan/' . $show_periodes->id_periode . '/' . $show_ruangans->id_ruangan) }}" class="btn btn-primary"><i class="fas fa-sync-alt" aria-hidden="true"></i> Proses</a></li>
                    </ol>
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#import_data" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Import Data Pasien</a></li>
                    </ol>
                </div>
                <div class="modal fade" id="import_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Import data pasien rawat jalan baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('data_pasien.importRj')}}" enctype="multipart/form-data">
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
                            <th>Tanggal masuk</th>
                            <th>Tanggal keluar</th>
                            {{-- <th>Klinik</th> --}}
                            {{-- <th>Ruangan</th> --}}
                            <th>Nama dokter</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal masuk</th>
                            <th>Tanggal keluar</th>
                            {{-- <th>Klinik</th> --}}
                            {{-- <th>Ruangan</th> --}}
                            <th>Nama dokter</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_pasien_rawat_jalans as $data_pasien_rawat_jalan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_pasien_rawat_jalan->nama_pasien }}</td>
                                <td>{{ $data_pasien_rawat_jalan->tgl_masuk }}</td>
                                <td>{{ $data_pasien_rawat_jalan->tgl_keluar }}</td>
                                {{-- <td>{{ $data_pasien_rawat_jalan->reg_type }}</td> --}}
                                {{-- <td>{{ $data_pasien_rawat_jalan->kategori_ruangan }}</td> --}}
                                <td>{{ $data_pasien_rawat_jalan->nama_dokter_perawat }}</td>
                                <td>
                                    <a href="{{ url('data_pasien_rawat_jalan_detail_tindakan/'.$data_pasien_rawat_jalan->id_data_pasien)}}"  class="btn btn-success"><i class="fa fa-bars" aria-hidden="true"></i> Detail</a>
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