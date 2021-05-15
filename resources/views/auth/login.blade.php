@extends('layouts.auth')

@section('content')
<div class="login-page" style="margin-top: -5%;">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('home')}}"><b>Masuk</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required oninvalid="this.setCustomValidity('Username tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required oninvalid="this.setCustomValidity('Password tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

                <p class="mb-1">
                    Lupa Password?<a href="{{ url('/') }}"> klik disini</a>
                </p>
                <p class="mb-0">
                    Belum punya akun?<a href="{{ url('/') }}" class="text-center"> klik disini</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection
@section('script')
@error('username')
    <input type="hidden" id="data-succes" value="{{ $message }}">
    <script>
        var tmp = $('#data-succes').val();
        AlterDataCRUD(tmp, 'error');
    </script>
@enderror
@endsection