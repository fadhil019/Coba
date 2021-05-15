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
                    <h1>Tambah data tindakan pasien " {{ $data_pasien_rawat_inaps[0]->nama_pasien }} "</h1>
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
                        <h4>Tambah data DPJP</h4>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                        </ol>
                    </div> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nama</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>DPJP</td>
                                <td>
                                    @if(isset($data_pasien_rawat_inaps[0]->nama_dokter))
                                        {{ $data_pasien_rawat_inaps[0]->nama_dokter }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit_dpjp" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit_dpjp">
                                <div class="modal-dialog">
                                    <div class="modal-content  bg-primary">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Tambah data DPJP " {{ $data_pasien_rawat_inaps[0]->nama_pasien }} " </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('data_pasien.update', $data_pasien_rawat_inaps[0]->id_data_pasien)}}" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="form-group">
                                                <label for="Nama">Nama dokter DPJP</label>
                                                <select class="form-control" name="id_dpjp">
                                                    @foreach($data_dokters as $data_dokter)
                                                        <option value="{{ $data_dokter->id_dokter }}" @if($data_pasien_rawat_inaps[0]->id_dpjp == $data_dokter->id_dokter) selected @endif>{{ $data_dokter->nama_dokter }}</option>
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
                        <h4>Tambah data gizi</h4>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                        </ol>
                    </div> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gizi</td>
                            <td>
                                @if(isset($show_gizi_pasiens->jumlah_jp))
                                    {{ $show_gizi_pasiens->jumlah_jp }}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#edit_gizi_pasien" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit_gizi_pasien">
                            <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Tambah data Gizi " {{ $data_pasien_rawat_inaps[0]->nama_pasien }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ url('buat_data_gizi_pasien')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_data_pasien" value="{{ $data_pasien_rawat_inaps[0]->id_data_pasien }}">
                                        <div class="form-group">
                                            <label for="Name">Jp</label><br>
                                            <input type="number" class="form-control" name="jumlah_jp" autofocus required>
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
                        <h4>Tambah admin rekam medis</h4>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                        </ol>
                    </div> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admin rekam medis</td>
                            <td>
                                @if(isset($show_adm_pasiens->jumlah_jp))
                                    {{ $show_adm_pasiens->jumlah_jp }}
                                @else
                                    0
                                @endif</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#edit_adm_pasien" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit_adm_pasien">
                            <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Tambah data ADM " {{ $data_pasien_rawat_inaps[0]->nama_pasien }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ url('buat_data_adm_pasien')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_data_pasien" value="{{ $data_pasien_rawat_inaps[0]->id_data_pasien }}">
                                        <div class="form-group">
                                            <label for="Name">Jp</label><br>
                                            <input type="number" class="form-control" name="jumlah_jp" autofocus required>
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
                        <h4>Tambah data dokter visite</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data_dokter_visite" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li>
                        </ol>
                    </div>
                    <div class="modal fade" id="create_data_dokter_visite">
                        <div class="modal-dialog">
                            <div class="modal-content  bg-primary">
                                <div class="modal-header">
                                <h4 class="modal-title">Tambah data dokter visite</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ url('buat_data_visite_pasien')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_data_pasien" value="{{ $data_pasien_rawat_inaps[0]->id_data_pasien }}">
                                        <div class="form-group">
                                            <label for="Nama">Nama dokter visite</label>
                                            <select class="form-control" name="id_dokter">
                                                @foreach($data_dokters as $data_dokter)
                                                    <option value="{{ $data_dokter->id_dokter }}">{{ $data_dokter->nama_dokter }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Jp</label><br>
                                            <input type="number" class="form-control" name="jumlah_jp" required>
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
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jp</th>
                            <th>Nama dokter</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jp</th>
                            <th>Nama dokter</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($show_visite_pasiens as $show_visite_pasien)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $show_visite_pasien->jumlah_jp }}</td>
                                <td>{{ $show_visite_pasien->nama_dokter }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $show_visite_pasien->id_proses_perhitungan }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $show_visite_pasien->id_proses_perhitungan }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit{{ $show_visite_pasien->id_proses_perhitungan }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah data " {{ $show_visite_pasien->nama_dokter }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ url('delete_visite_pasien/'.  $show_visite_pasien->id_proses_perhitungan)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="Name">Jumlah jp</label><br>
                                            <input type="number" class="form-control" name="jumlah_jp" value="{{ $show_visite_pasien->jumlah_jp }}" autofocus required>
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

                            <div class="modal fade" id="delete{{ $show_visite_pasien->id_proses_perhitungan }}">
                                <div class="modal-dialog">
                                    <div class="modal-content  bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus " {{ $show_visite_pasien->nama_dokter }} "</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('delete_visite_pasien/'. $show_visite_pasien->id_proses_perhitungan)}}" enctype="multipart/form-data">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <div class="form-group">
                                                    <label for="Name">Apakah anda yakin ingin menghapus " {{ $show_visite_pasien->nama_dokter }} " ?</label>
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