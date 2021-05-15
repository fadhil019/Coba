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
                    <h1>Daftar variable kategori</h1>
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
                            <th>Nama</th>
                            <th>Rumus</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Tindakan</th>
                            <th>Rumus</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @foreach($variable_kategori as $row)
                        <tr>
                            <td>{{ $row }}</td>
                            <td>
                                @if(isset($show_varieble_rumuss[$row])) {{$show_varieble_rumuss[$row]}} @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#create_data_{{ strtolower(str_replace(' ', '', $row)) }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Rumus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="create_data_{{ strtolower(str_replace(' ', '', $row)) }}">
                            <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Buat data rumus " {{ $row }} "</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('variable_rumus.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <p>
                                            Berikut meurupakan contoh dalam penulisan rumus variable dengan variable atau dengan angka.
                                            <br>
                                            Perawat IGD = ((PERAWAT IGD)) * 40%
                                            <br>
                                            Penjelasan : 
                                            LOL .. :v
                                            </p>
                                            <p>
                                                <b><u>Varible rumus:</u></b><br>
                                                @foreach($variable_kategori as $row_ket)
                                                    {{ $row_ket }}<br>
                                                @endforeach
                                                @foreach($data_kategori_tindakans as $data_kategori_tindakan_ket)
                                                    {{ $data_kategori_tindakan_ket->nama }}<br>
                                                @endforeach
                                            </p>
                                            
                                            
                                            <input type="hidden" name="nama_variabel" value="{{ $row }}">
                                            <div class="form-group">
                                                <label for="Name">Rumus</label><br>                                  
                                                <input type="text" class="form-control" name="rumus" value=" @if(isset($show_varieble_rumuss[$row])) {{$show_varieble_rumuss[$row]}} @endif"  autofocus required>
                                            </div>
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
                    @endforeach
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
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Rumus</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Rumus</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_kategori_tindakan->nama }}</td>
                                <td>@if(isset($show_varieble_rumuss[$data_kategori_tindakan->nama])) {{$show_varieble_rumuss[$data_kategori_tindakan->nama]}} @endif</td>
                                <td>
                                    <!-- <a href="{{ url('daftar_rumus_kategori/'. $data_kategori_tindakan->id_kategori_tindakan ) }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Rumus</a> -->
                                    <a href="#" data-toggle="modal" data-target="#create_data{{ $data_kategori_tindakan->id_kategori_tindakan }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Rumus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="create_data{{$data_kategori_tindakan->id_kategori_tindakan}}">
                                <div class="modal-dialog">
                                    <div class="modal-content  bg-danger">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Buat data rumus " {{ $data_kategori_tindakan->nama }} "</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('variable_rumus.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                <p>
                                                Berikut meurupakan contoh dalam penulisan rumus variable dengan variable atau dengan angka.
                                                <br>
                                                Perawat IGD = ((PERAWAT IGD)) * 40%
                                                <br>
                                                Penjelasan : 
                                                LOL .. :v
                                                </p>
                                                <p>
                                                    <b><u>Varible rumus:</u></b><br>
                                                    @foreach($variable_kategori as $row)
                                                        {{ $row }}<br>
                                                    @endforeach
                                                    @foreach($data_kategori_tindakans as $data_kategori_tindakan_ket)
                                                        {{ $data_kategori_tindakan_ket->nama }}<br>
                                                    @endforeach
                                                </p>
                                                
                                                <input type="text" name="nama_variabel" value="{{ $data_kategori_tindakan->nama }}">
                                                <div class="form-group">
                                                    <label for="Name">Rumus</label><br>
                                                    <input type="text" class="form-control" name="rumus" value=" @if(isset($show_varieble_rumuss[$data_kategori_tindakan->nama])) {{$show_varieble_rumuss[$data_kategori_tindakan->nama]}} @endif"  autofocus required>
                                                </div>
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