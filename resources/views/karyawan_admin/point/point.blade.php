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
                    <h1>Daftar point karyawan admin periode <br>({{ $data_periodes->bulan }} - {{ $data_periodes->tahun }})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="{{ url('generate_data_karyawan_admin/'.$data_periodes->id_periode) }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Generate</a></li>
                    </ol>
                    <ol class="breadcrumb float-sm-right">
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> Proses perhitungan upah</a></li>
                    </ol>
                </div>
                <div class="modal fade" id="create_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-warning">
                            <div class="modal-header">
                            <h4 class="modal-title">Proses perhitungan upah karyawan admin remunerasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="GET" action="{{ url('proses_upah_admin/'. $data_periodes->id_periode ) }}" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin memproses perhitungan upah karyawan admin remunerasi periode ({{ $data_periodes->bulan }} - {{ $data_periodes->tahun }}) ?</label>
                                        </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-dark">
                                            {{ __('Proses') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark pull-right" data-dismiss="modal">Tutup</button>
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
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <th>Periode</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kreed</th>
                            <th>Unit</th>
                            <th>Posisi</th>
                            <th>Performa</th>
                            <th>Disiplin</th>
                            <th>Komplain</th>
                            <th>PM</th>
                            <th>Periode</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_karyawan_admins as $data_karyawan_admin)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_karyawan_admin->nama }}</td>
                                <td>{{ $data_karyawan_admin->kredential }}</td>
                                <td>{{ $data_karyawan_admin->unit }}</td>
                                <td>{{ $data_karyawan_admin->posisi }}</td>
                                <td>{{ $data_karyawan_admin->performa }}</td>
                                <td>{{ $data_karyawan_admin->disiplin }}</td>
                                <td>{{ $data_karyawan_admin->komplain }}</td>
                                <td>{{ $data_karyawan_admin->pm }}</td>
                                <td>{{ $data_karyawan_admin->bulan }} - {{ $data_karyawan_admin->tahun }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $data_karyawan_admin->id_karyawan_admin }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $data_karyawan_admin->id_karyawan_admin }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Perbarui point <br> " {{ $data_karyawan_admin->nama }} " </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ url('update_point_karyawan_admin/'. $data_karyawan_admin->id_point_karyawan)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <input type="hidden" name="id_periode" value="{{ $data_periodes->id_periode }}">
                                        <input type="hidden" name="id_karyawan_admin" value="{{ $data_karyawan_admin->id_karyawan_admin }}">
                                        <div class="form-group">
                                            <label for="Name">Kreed</label><br>
                                            <input type="number" class="form-control" name="kredential" value="{{ $data_karyawan_admin->kredential }}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Unit</label><br>
                                            <input type="number" class="form-control" name="unit" value="{{ $data_karyawan_admin->unit }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Posisi</label><br>
                                            <input type="number" class="form-control" name="posisi" value="{{ $data_karyawan_admin->posisi }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Performa</label><br>
                                            <input type="number" class="form-control" name="performa" value="{{ $data_karyawan_admin->performa }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Disiplin</label><br>
                                            <input type="number" class="form-control" name="disiplin" value="{{ $data_karyawan_admin->disiplin }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Komplain</label><br>
                                            <input type="number" class="form-control" name="komplain" value="{{ $data_karyawan_admin->komplain }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">PM</label><br>
                                            <input type="number" class="form-control" name="pm" value="{{ $data_karyawan_admin->pm }}" required>
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