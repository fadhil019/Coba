@extends('layouts.index')

@section('content')
<div class="content-header">
    <div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <a href="{{ url('/')}}"><i class="fas fa-arrow-left"></i></a> Kembali</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<br>
<center>
    @if(count($sportfields)<=0)
        <h1><i class="fas fa-frown text-primary"></i></h1>
        <p class="data-kosong">Maaf lapangan tidak tersedia !</p>
    @endif
</center>
<!-- Main content -->
<div class="content">
  <div class="container">
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-search"></i>
                Hasil pencarian!
            </h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                @for($i = 0; $i < count($sportfields); $i++)
                    <div class="col-lg-4">
                        <div class="card card-primary card-outline">
                            <img src="{{  asset('images/sport_field/'.$sportfields[$i]['sport_field_photo']) }}" style="width:100%;" alt="Images">
                            <div class="card-body">               
                                <h5 class="card-title">{{ $sportfields[$i]['sport_field_name'] }}</h5>
                                <br>
                                <a class="card-text"><span class="badge badge-primary">{{ $sportfields[$i]['sport_name'] }}</span></a>
                                <br>
                                @if($sportfields[$i]['sport_field_status'] != 'Off' && $sportfields[$i]['sport_field_tax_status'] == 'Aktif')
                                    @if($sportfields[$i]['sport_field_price'] == false)
                                        <a class="card-text text-danger">
                                        <u>Tidak terdapat jadwal untuk hari ini!</u>
                                        </a>
                                    @else
                                        <a class="card-text">
                                            Rp {{ number_format($sportfields[$i]['sport_field_price'], 0, ".", ".") }} / jam
                                        </a>
                                    @endif
                                    <p class="card-text">
                                        <i class="fas fa-star text-warning"></i> {{ $sportfields[$i]['sport_field_rating'] }}
                                    </p>
                                    <p class="card-text">
                                    @if(strlen($sportfields[$i]['sport_field_detail']) <= 200)
                                    {{substr($sportfields[$i]['sport_field_detail'],0,200)}}
                                    @else
                                    {{substr($sportfields[$i]['sport_field_detail'],0,200)}} <br> 
                                    <u><a href="{{ route('lapangan_olahraga.show',$sportfields[$i]['sport_field_id'])}}" class="card-link text-dark"><b>Baca selengkapnya </b> <i class="fas fa-arrow-right"></i></a></u>
                                    @endif
                                    </p>
                                    <a href="{{ route('lapangan_olahraga.show',$sportfields[$i]['sport_field_id'])}}" class="card-link"><b>Lihat</b> <i class="fas fa-arrow-right"></i></a>
                                @else
                                    <a class="card-text text-danger">
                                        <h3><u>Lapangan tidak aktif</u></h3>
                                    </a>
                                    <p class="card-text">
                                        {{ $sportfields[$i]['sport_field_status_description'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection
@section('script')

@endsection