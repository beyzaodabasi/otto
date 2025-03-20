@extends('layouts.guest')

@section('content')
 <style>
        .card {
            background-image: url("{{ asset('img/arkaplan.jpg') }}");
            background-size: cover;
        }
    </style>
<div class="text-center">
    <img src="{{ asset('img/otto.png') }}" alt="Logo" width="300">
</div>
&nbsp;
<div class="login-box">
    <div class="card" >
        <div class="card-body login-card-body">
            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Hata Oluştu!</h5>
                {{ Session::get('error_message') }}
            </div>

            @endif
            <form action="{{ route('loginpost') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="EPosta" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Parola" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            &nbsp;
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->
@endsection
