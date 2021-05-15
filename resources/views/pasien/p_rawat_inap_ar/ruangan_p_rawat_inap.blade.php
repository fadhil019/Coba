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
                    <h1>Daftar perhitungan ruangan rawat inap periode " {{ $data_periodes->bulan }} - {{ $data_periodes->tahun }} "</h1>
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
                            {{-- <th>Kategori</th> --}}
                            {{-- <th>Pembuat</th> --}}
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            {{-- <th>Kategori</th> --}}
                            {{-- <th>Pembuat</th> --}}
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_ruangans as $data_ruangan)
                            @if($data_ruangan->kategori_ruangan == "Rawat inap")
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data_ruangan->nama_ruangan }}</td>
                                    {{-- <td>{{ $data_ruangan->kategori_ruangan }}</td> --}}
                                    {{-- <td>{{ $data_ruangan->nama_user }}</td> --}}
                                    <td>
                                        <a href="{{ url('show_proses_perhitungan_rawat_inap/'.$data_periodes->id_periode.'/'.$data_ruangan->id_ruangan) }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Pilih ruangan</a>
                                    </td>
                                </tr>
                            @endif
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