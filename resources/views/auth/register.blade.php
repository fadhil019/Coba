@extends('layouts.index')

@section('content')
<div class="register-box mx-auto" style="padding-bottom:20%;">
    <div class="register-logo">
        <a href="{{ url('home')}}"><b>Registrasi</b></a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">

        <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="hidden" name="user_role" id="input_username" class="form-control @error('user_role') is-invalid @enderror" value="Penyewa">
                    <input type="text" name="username" id="input_username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror" placeholder="Nama" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="number" name="user_phone" class="form-control @error('user_phone') is-invalid @enderror" placeholder="Telepon" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="user_address" class="form-control @error('user_address') is-invalid @enderror" placeholder="Alamat" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-map-marker-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <select name="city_id" class="form-control @error('city_id') is-invalid @enderror">
                        <option value="-">-- Pilih Kota --</option>
                        @foreach($citys as $city)
                            <option value="{{ $city->city_id}}">{{ $city->city_name}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <select name="user_sex" class="form-control @error('user_sex') is-invalid @enderror">
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" data-error="Password harus diisi.">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <p class="login-box-msg"><i>*Silahkan mengisi tingkat kesukaan olahraga</i></p>
                <p class="login-box-msg"><i>1= Sangat tidak suka  &nbsp;&nbsp;&nbsp;2 = Tidak Suka <br>  3 = Netral &nbsp;&nbsp;&nbsp;4 = Suka  <br> 5 = Sangat Suka</i></p>
                @foreach($sports as $sport)
                    <input type="hidden" name="sport_id[]" value="{{ $sport->sport_id }}">
                    <div class="form-group">
                        <label for="Name">{{ $sport->sport_name}}</label>
                        <select name="sport_value[]" class="form-control @error('sport_value') is-invalid @enderror">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3" selected>3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-8">
                        <!-- <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                            </label>
                        </div> -->
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>

@endsection
@section('script')
@if(\Session::has('alert-success'))
    <input type="hidden" id="data-succes" value="{{Session::get('alert-success')}}">
    <script>
        var tmp = $('#data-succes').val();
        AlterDataCRUD(tmp + '<br> Silahkan login untuk memesan lapangan yang kamu inginkan :)', 'success');
    </script>
@endif
@if(\Session::has('alert-failed'))
    <input type="hidden" id="data-error" value="{{Session::get('alert-failed')}}">
    <script>
        var tmp = $('#data-error').val();
        AlterDataCRUD(tmp, 'error');
    </script>
@endif
@endsection