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
                    <h1>Data tahun " {{ $tahun }} "</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('dokter.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="Nama">Bagian</label>
                                    <select class="form-control" name="bagian">
                                        @foreach($data_periodes as $data_periode)
                                            <option value="{{ $data_periode->id_periode}}" >{{ $data_periode->id_periode }}</option>
                                        @endforeach
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="Nama" class="text-white">Bagian</label>
                                    <button type="submit" class="form-control btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('dokter.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="Nama">Bagian</label>
                                    <select class="form-control" name="bagian">
                                        @foreach($data_periodes as $data_periode)
                                            <option value="{{ $data_periode->id_periode}}" >{{ $data_periode->id_periode }}</option>
                                        @endforeach
                                    </select>                                
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="Nama" class="text-white">Bagian</label>
                                    <button type="submit" class="form-control btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('script')

@endsection