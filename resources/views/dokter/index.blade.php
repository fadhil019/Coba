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
                    <h1>Daftar dokter</h1>
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
                            <h4 class="modal-title">Buat data dokter baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('dokter.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">Nama</label><br>
                                        <input type="text" class="form-control" name="nama_dokter" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Bagian</label>
                                        <select class="form-control" name="bagian">
                                            @foreach($data_bagians as $data_bagian)
                                                <option value="{{ $data_bagian}}" >{{ $data_bagian }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Ruang</label>
                                        <select class="form-control" name="id_ruangan">
                                            @foreach($data_ruangans as $data_ruangan)
                                                <option value="{{ $data_ruangan->id_ruangan }}" >{{ $data_ruangan->nama_ruangan }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Kategori tindakan</label>
                                        <select class="form-control" name="id_kategori_tindakan">
                                            @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                                                <option value="{{ $data_kategori_tindakan->id_kategori_tindakan }}" >{{ $data_kategori_tindakan->nama }}</option>
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
                            <th>Bagian</th>
                            <th>Tindakan khusus</th>
                            <th>Ruang</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Bagian</th>
                            <th>Tindakan khusus</th>
                            <th>Ruang</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_dokters as $data_dokter)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_dokter->nama_dokter }}</td>
                                <td>{{ $data_dokter->bagian }}</td>
                                <td>{{ $data_dokter->nama }}</td>
                                <td>{{ $data_dokter->nama_ruangan }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $data_dokter->id_dokter }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $data_dokter->id_dokter }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $data_dokter->id_dokter }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah data " {{ $data_dokter->nama_dokter }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('dokter.update', $data_dokter->id_dokter)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="Name">Nama</label><br>
                                            <input type="text" class="form-control" name="nama_dokter" value="{{ $data_dokter->nama_dokter }}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Bagian</label>
                                            <select class="form-control" name="bagian">
                                                @foreach($data_bagians as $data_bagian)
                                                    <option value="{{ $data_bagian }}" @if($data_dokter->bagian == $data_bagian) selected @endif>{{ $data_bagian }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Ruang</label>
                                            <select class="form-control" name="id_ruangan">
                                                @foreach($data_ruangans as $data_daftar_ruang_kelas)
                                                    <option value="{{ $data_daftar_ruang_kelas->id_ruangan }}" @if($data_dokter->id_ruangan == $data_daftar_ruang_kelas->id_ruangan) selected @endif>{{ $data_daftar_ruang_kelas->nama_ruangan }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Kategori tindakan</label>
                                            <select class="form-control" name="id_kategori_tindakan">
                                                @foreach($data_kategori_tindakans as $data_kategori_tindakan)
                                                    <option value="{{ $data_kategori_tindakan->id_kategori_tindakan }}" @if($data_dokter->id_kategori_tindakan == $data_kategori_tindakan->id_kategori_tindakan) selected @endif>{{ $data_kategori_tindakan->nama }}</option>
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

                            <div class="modal fade" id="delete{{ $data_dokter->id_dokter }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus data " {{ $data_dokter->nama_dokter }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('dokter.destroy', $data_dokter->id_dokter)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus data " {{ $data_dokter->nama_dokter }} " ?</label>
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