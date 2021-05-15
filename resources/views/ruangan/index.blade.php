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
                    <h1>Daftar ruangan</h1>
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
                            <h4 class="modal-title">Buat data ruangan baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('ruangan.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">Nama</label><br>
                                        <input type="text" class="form-control" name="nama_ruangan" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Kategori</label>
                                        <select class="form-control" name="kategori_ruangan">
                                            @foreach($data_kategori_ruangans as $data_kategori_ruangan)
                                                <option value="{{ $data_kategori_ruangan}}" >{{ $data_kategori_ruangan }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="Nama">Pengguna</label>
                                        <select class="form-control" name="id_users">
                                            @foreach($data_users as $data_user)
                                                <option value="{{ $data_user->id_users }}" >{{ $data_user->nama_user }}</option>
                                            @endforeach
                                        </select>                                
                                    </div> -->
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
                            <th>Kategori</th>
                            <th>Pembuat</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Pembuat</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_ruangans as $data_ruangan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_ruangan->nama_ruangan }}</td>
                                <td>{{ $data_ruangan->kategori_ruangan }}</td>
                                <td>{{ $data_ruangan->nama_user }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $data_ruangan->id_ruangan }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $data_ruangan->id_ruangan }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $data_ruangan->id_ruangan }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah ruangan " {{ $data_ruangan->nama_ruangan }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('ruangan.update', $data_ruangan->id_ruangan)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="Name">Nama</label><br>
                                            <input type="text" class="form-control" name="nama_ruangan" value="{{ $data_ruangan->nama_ruangan }}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Kategori</label>
                                            <select class="form-control" name="kategori_ruangan">
                                                @foreach($data_kategori_ruangans as $data_kategori_ruangan)
                                                    <option value="{{ $data_kategori_ruangan }}" @if($data_ruangan->kategori_ruangan == $data_kategori_ruangan) selected @endif>{{ $data_kategori_ruangan }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="Nama">Pengguna</label>
                                            <select class="form-control" name="id_users">
                                                @foreach($data_users as $data_user)
                                                    <option value="{{ $data_user->id_users }}" @if($data_ruangan->id_users == $data_user->id_users) selected @endif>{{ $data_user->nama_user }}</option>
                                                @endforeach
                                            </select>                                
                                        </div> -->
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

                            <div class="modal fade" id="delete{{ $data_ruangan->id_ruangan }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus ruangan " {{ $data_ruangan->nama_ruangan }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('ruangan.destroy', $data_ruangan->id_ruangan)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus ruangan " {{ $data_ruangan->nama_ruangan }} " ?</label>
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
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
@section('script')

@endsection