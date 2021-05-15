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
                    <h1>Daftar karyawan penunjang</h1>
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
                            <h4 class="modal-title">Buat data karyawan penunjang baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('karyawan_penunjang.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">Nama</label><br>
                                        <input type="text" class="form-control" name="nama" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Jabatan</label>
                                        <select class="form-control" name="jabatan">
                                            @foreach($data_jabatans as $data_jabatan)
                                                <option value="{{ $data_jabatan}}" >{{ $data_jabatan }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Bagian</label>
                                        <select class="form-control" name="bagian">
                                            @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                                                <option value="{{ $data_kategori_tindakan->id_kategori_tindakan }}">{{ $data_kategori_tindakan->nama }}</option>
                                            @endforeach
                                        </select>                                
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
                            <th>Jabatan</th>
                            <th>Bagian</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Bagian</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_karyawan_penunjangs as $data_karyawan_penunjang)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_karyawan_penunjang->nama_karyawan }}</td>
                                <td>{{ $data_karyawan_penunjang->jabatan }}</td>
                                <td>{{ $data_karyawan_penunjang->nama_kategori }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $data_karyawan_penunjang->id_karyawan_penunjang }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $data_karyawan_penunjang->id_karyawan_penunjang }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $data_karyawan_penunjang->id_karyawan_penunjang }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah data " {{ $data_karyawan_penunjang->nama }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('karyawan_penunjang.update', $data_karyawan_penunjang->id_karyawan_penunjang)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="Name">Nama</label><br>
                                            <input type="text" class="form-control" name="nama" value="{{ $data_karyawan_penunjang->nama }}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Jabatan</label>
                                            <select class="form-control" name="jabatan">
                                                @foreach($data_jabatans as $data_jabatan)
                                                    <option value="{{ $data_jabatan }}" @if($data_karyawan_penunjang->jabatan == $data_jabatan) selected @endif>{{ $data_jabatan }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Bagian</label>
                                            <select class="form-control" name="bagian">
                                                @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                                                    <option value="{{ $data_kategori_tindakan->id_kategori_tindakan }}" @if($data_karyawan_penunjang->bagian == $data_kategori_tindakan->id_kategori_tindakan) selected @endif>{{ $data_kategori_tindakan->nama }}</option>
                                                @endforeach
                                            </select>                                
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

                            <div class="modal fade" id="delete{{ $data_karyawan_penunjang->id_karyawan_penunjang }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus data " {{ $data_karyawan_penunjang->nama }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('karyawan_penunjang.destroy', $data_karyawan_penunjang->id_karyawan_penunjang)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus data " {{ $data_karyawan_penunjang->nama }} " ?</label>
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