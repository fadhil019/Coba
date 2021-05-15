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
                    <h1>Rumus variable " {{ $show_data_kategori_tindakans->nama }} "</h1>
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
                        <h1>Tabel list variable</h1>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                            <tr>
                                <td>{{ $data_kategori_tindakan->id_kategori_tindakan }}</td>
                                <td>{{ $data_kategori_tindakan->nama }}</td>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h1>Penjelasan isi rumus</h1>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>
                    Berikut meurupakan contoh dalam penulisan rumus variable dengan variable atau dengan angka.
                    <br>
                    Perawat IGD = {{1}} x 40%
                    <br>
                    Penjelasan : 
                    LOL .. :v
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row pt-2 mb-2">
                        <div class="col-sm-6">
                            <h1>Isi rumus variable</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                            </ol>
                        </div>
                        <div class="modal fade" id="create_data">
                            <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Buat data rumus baru</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('variable_rumus.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id_variable_rumus" value="@if(isset($show_varieble_rumuss)) {{ $show_varieble_rumuss->id_variable_rumus }} @else 0 @endif">
                                            <input type="hidden" name="id_kategori_tindakan" value="{{ $show_data_kategori_tindakans->id_kategori_tindakan }}">
                                            <input type="hidden" name="nama_variabel" value="{{ $show_data_kategori_tindakans->nama }}">
                                            <div class="form-group">
                                                <label for="Nama">Kategori</label>
                                                <select class="form-control" name="id_kategori_tindakan_detail">
                                                    @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                                                        <option value="{{ $data_kategori_tindakan->id_kategori_tindakan }}">{{ $data_kategori_tindakan->nama }}</option>
                                                    @endforeach
                                                </select>                                
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Nilai</label><br>
                                                <input type="number" class="form-control" name="nilai" required>
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
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <input type="hidden" value="{{ $no = 1 }}">
                    <table id="dataTable2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIlai</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Tindakan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($show_varieble_rumus_details as $show_varieble_rumus_detail)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $show_varieble_rumus_detail->nama }}</td>
                                    <td>x{{ $show_varieble_rumus_detail->nilai }}%</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit{{ $show_varieble_rumus_detail->id_variable_rumus_detail }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                        <a href="#" data-toggle="modal" data-target="#delete{{ $show_varieble_rumus_detail->id_variable_rumus_detail }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit{{ $show_varieble_rumus_detail->id_variable_rumus_detail }}">
                                    <div class="modal-dialog">
                                    <div class="modal-content  bg-primary">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Ubah rumus " {{ $show_varieble_rumus_detail->nama }} "</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('variable_rumus_detail.update', $show_varieble_rumus_detail->id_variable_rumus_detail)}}" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }} 
                                            <input type="hidden" name="id_variable_rumus" value="@if(isset($show_varieble_rumuss)) {{ $show_varieble_rumuss->id_variable_rumus }} @else 0 @endif">
                                            <div class="form-group">
                                                <label for="Nama">Kategori</label>
                                                <select class="form-control" name="id_kategori_tindakan_detail">
                                                    @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                                                        <option value="{{ $data_kategori_tindakan->id_kategori_tindakan }}" @if($data_kategori_tindakan->id_kategori_tindakan == $show_varieble_rumus_detail->id_kategori_tindakan) selected @endif>{{ $data_kategori_tindakan->nama }}</option>
                                                    @endforeach
                                                </select>                                
                                            </div>                                           
                                            <div class="form-group">
                                                <label for="Name">Nilai</label><br>
                                                <input type="number" class="form-control" name="nilai" value="{{ $show_varieble_rumus_detail->nilai }}" required>
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

                                <div class="modal fade" id="delete{{ $show_varieble_rumus_detail->id_variable_rumus_detail }}">
                                    <div class="modal-dialog">
                                    <div class="modal-content  bg-danger">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Hapus rumus " {{ $show_varieble_rumus_detail->nama }} "</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('variable_rumus_detail.destroy', $show_varieble_rumus_detail->id_variable_rumus_detail)}}" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <div class="form-group">
                                                <label for="Name">Apakah anda yakin ingin menghapus rumus  ?</label>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-light">
                                                    {{ __('Hapus') }}
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
</section>
<!-- /.content -->
@endsection
@section('script')

@endsection