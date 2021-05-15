@extends('layouts.index')

@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('home')}}"><b>Lupa Password</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Lupa password anda? Silahkan masukkan email anda yang terdaftar dan anda akan mendapatkan password baru anda.</p>
            <form method="POST" action="{{ url('reset_password') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                </div>
                <!-- /.col -->
            </div>
            </form>

                <p class="mt-3 mb-1">
                    Masuk.<a href="{{ url('login') }}"> klik disini</a>
                </p>
                <p class="mb-0">
                    Belum punya akun?<a href="{{ route('user.create') }}" class="text-center"> klik disini</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection
@section('script')
@if(\Session::has('alert-success'))
    <input type="hidden" id="data-succes" value="{{Session::get('alert-success')}}">
    <script>
        var tmp = $('#data-succes').val();
        AlterDataCRUD(tmp, 'success');
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
