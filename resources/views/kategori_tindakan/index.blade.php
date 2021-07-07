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
                    <h1>Daftar kategori tindakan</h1>
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
                            <h4 class="modal-title">Buat data kategori tindakan baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('kategori_tindakan.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">Keterangan</label><br>
                                        <input type="text" class="form-control" name="nama" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Kategori</label>
                                        <select class="form-control" name="kategori_data">
                                            @foreach($data_kategori_datas as $data_kategori_data)
                                                <option value="{{ $data_kategori_data}}" >{{ $data_kategori_data }}</option>
                                            @endforeach
                                        </select>     
                                        <!-- <input type="hidden" class="form-control" name="kategori_data" value="Penunjang" > -->                           
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Proses</label>
                                        <select class="form-control" name="tahapan_proses">
                                            @foreach($data_prosess as $data_proses)
                                                <option value="{{ $data_proses}}" >{{ $data_proses }}</option>
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
                            <th>Kategori data</th>
                            <th>Proses</th>
                            <th>Pembuat</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori data</th>
                            <th>Proses</th>
                            <th>Pembuat</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_kategori_tindakan->nama }}</td>
                                <td>{{ $data_kategori_tindakan->kategori_data }}</td>
                                <td>{{ $data_kategori_tindakan->tahapan_proses }}</td>
                                <td>{{ $data_kategori_tindakan->nama_user }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $data_kategori_tindakan->id_kategori_tindakan }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $data_kategori_tindakan->id_kategori_tindakan }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $data_kategori_tindakan->id_kategori_tindakan }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah data " {{ $data_kategori_tindakan->nama }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('kategori_tindakan.update', $data_kategori_tindakan->id_kategori_tindakan)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="Name">Keterangan</label><br>
                                            <input type="text" class="form-control" name="nama" value="{{ $data_kategori_tindakan->nama }}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Kategori</label>
                                            <select class="form-control" name="kategori_data">
                                                @foreach($data_kategori_datas as $data_kategori_data)
                                                    <option value="{{ $data_kategori_data }}" @if($data_kategori_tindakan->kategori_data == $data_kategori_data) selected @endif>{{ $data_kategori_data }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Proses</label>
                                            <select class="form-control" name="tahapan_proses">
                                                @foreach($data_prosess as $data_proses)
                                                    <option value="{{ $data_proses }}" @if($data_kategori_tindakan->tahapan_proses == $data_proses) selected @endif>{{ $data_proses }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="Nama">Pengguna</label>
                                            <select class="form-control" name="id_users">
                                                @foreach($data_users as $data_user)
                                                    <option value="{{ $data_user->id_users }}" @if($data_kategori_tindakan->id_users == $data_user->id_users) selected @endif>{{ $data_user->nama_user }}</option>
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

                            <div class="modal fade" id="delete{{ $data_kategori_tindakan->id_kategori_tindakan }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus data " {{ $data_kategori_tindakan->nama }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('kategori_tindakan.destroy', $data_kategori_tindakan->id_kategori_tindakan)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus data " {{ $data_kategori_tindakan->nama }} " ?</label>
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