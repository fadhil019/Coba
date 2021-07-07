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
                    <h1>Daftar keuangan pasien</h1>
                    <p>Untuk contoh format excel yang dapat diproses sistem dapat didownload : <u><a href="{{ url('download_format') }}" id="downloadexcel">Format Excel</a></u></p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="mr-2"><a href="#" data-toggle="modal" data-target="#create_data" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a></li> --}}
                        <li class="mr-2"><a href="#" data-toggle="modal" data-target="#import_data" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Import</a></li>
                    </ol>
                </div>
                <div class="modal fade" id="create_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Buat data keuangan pasien baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('data_keuangan_pasien.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">No SEP</label><br>
                                        <input type="text" class="form-control" name="no_sep_keuangan_pasien" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">Nominal</label><br>
                                        <input type="number" class="form-control" name="nominal_uang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Periode</label>
                                        <select class="form-control" name="id_periode">
                                            @foreach($data_periodes as $data_periode)
                                                <option value="{{ $data_periode->id_periode }}" >{{ $data_periode->bulan }} - {{ $data_periode->tahun }}</option>
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
                <div class="modal fade" id="import_data">
                    <div class="modal-dialog">
                        <div class="modal-content  bg-primary">
                            <div class="modal-header">
                            <h4 class="modal-title">Import data keuangan pasien baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('data_keuangan_pasien.import')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Name">Berkas</label><br>
                                        <input type="file" name="excel_data_keuangan_pasien" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama">Periode</label>
                                        <select class="form-control" name="id_periode">
                                            @foreach($data_periodes as $data_periode)
                                                <option value="{{ $data_periode->id_periode }}" >{{ $data_periode->bulan }} - {{ $data_periode->tahun }}</option>
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
                <table id="dataTable10" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No SEP</th>
                            <th>Nominal</th>
                            <th>Periode</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No SEP</th>
                            <th>Nominal</th>
                            <th>Periode</th>
                            <th>Tindakan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data_keuangan_pasiens as $data_keuangan_pasien)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data_keuangan_pasien->no_sep_keuangan_pasien }}</td>
                                <td>Rp {{ number_format($data_keuangan_pasien->nominal_uang, 0, ".", ".") }}</td>
                                <td>{{ $data_keuangan_pasien->bulan }} - {{ $data_keuangan_pasien->tahun }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $data_keuangan_pasien->id_data_keuangan_pasien }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Ubah</a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $data_keuangan_pasien->id_data_keuangan_pasien }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $data_keuangan_pasien->id_data_keuangan_pasien }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-primary">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ubah bulan " {{ $data_keuangan_pasien->bulan }} " dan tahun " {{ $data_keuangan_pasien->tahun }} "</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('data_keuangan_pasien.update', $data_keuangan_pasien->id_data_keuangan_pasien)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="Name">No SEP</label><br>
                                            <input type="text" class="form-control" name="no_sep_keuangan_pasien" value="{{ $data_keuangan_pasien->no_sep_keuangan_pasien }}" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Nominal</label><br>
                                            <input type="number" class="form-control" name="nominal_uang" value="{{ $data_keuangan_pasien->nominal_uang }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama">Periode</label>
                                            <select class="form-control" name="id_periode">
                                                @foreach($data_periodes as $data_periode)
                                                    <option value="{{ $data_periode->id_periode }}" @if($data_keuangan_pasien->id_periode == $data_periode->id_periode) selected @endif>{{ $data_periode->bulan }} - {{ $data_periode->tahun }}</option>
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

                            <div class="modal fade" id="delete{{ $data_keuangan_pasien->id_data_keuangan_pasien }}">
                                <div class="modal-dialog">
                                <div class="modal-content  bg-danger">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Hapus data " {{ $data_keuangan_pasien->no_sep_keuangan_pasien }} "</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('data_keuangan_pasien.destroy', $data_keuangan_pasien->id_data_keuangan_pasien)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <div class="form-group">
                                            <label for="Name">Apakah anda yakin ingin menghapus data " {{ $data_keuangan_pasien->no_sep_keuangan_pasien }} " ?</label>
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
                <div class="row no-print">
                    <div class="col-12">
                        <div class="float-right mt-4">
                            {{ $data_keuangan_pasiens->links() }}
                        </div>
                    </div>
                </div>
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