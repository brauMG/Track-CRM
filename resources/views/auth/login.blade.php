@extends('layout.auth')

@section('content')
    <div class="wrapper-less">
        <div class="container-less">
    <div class="login-box">
        <div class="login-logo" style="color: #001015; font-size: 45px !important;">
            <b style="color: white">Track</b>CRM
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="position: relative !important; z-index: 5 !important; background: #00313a14 !important;">
            <p class="login-box-msg">Debes estar registrado para iniciar sesión</p>

            <form action="{{ route('login') }}" method="post" aria-label="{{ __('Login') }}">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo Electrónico') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-login" style="background-color: #5dbaef !important;">
                            {{ __('Iniciar ') }}
                        </button>
                    </div>
                </div>
                <div class='form-group'>
                    @if (Route::has('password.request'))
                        <a class="btn-login-forget btn btn-link restore login-forget" href="{{ route('password.request') }}" style="color: #0000003d !important;">{{ __('Restablecer mi contraseña.') }}</a>
                    @endif
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
        </div>
    </div>

    <script>
        if ($(window).width() > 799) {
            var timer = 4000;

            var i = 0;
            var max = $('#c > li').length;

            $("#c > li").eq(i).addClass('sponsors-active').css('left','0');
            $("#c > li").eq(i + 1).addClass('sponsors-active').css('left','20%');
            $("#c > li").eq(i + 2).addClass('sponsors-active').css('left','40%');
            $("#c > li").eq(i + 3).addClass('sponsors-active').css('left','60%');
            $("#c > li").eq(i + 4).addClass('sponsors-active').css('left','80%');



            setInterval(function(){

                $("#c > li").removeClass('sponsors-active');

                $("#c > li").eq(i).css('transition-delay','0.25s');
                $("#c > li").eq(i + 1).css('transition-delay','0.5s');
                $("#c > li").eq(i + 2).css('transition-delay','0.75s');
                $("#c > li").eq(i + 3).css('transition-delay','1s');
                $("#c > li").eq(i + 4).css('transition-delay','1.25s');

                if (i < max-5) {
                    i = i+5;
                }

                else {
                    i = 0;
                }

                $("#c > li").eq(i).css('left','0').addClass('sponsors-active').css('transition-delay','1.25s');
                $("#c > li").eq(i + 1).css('left','20%').addClass('sponsors-active').css('transition-delay','1.5s');
                $("#c > li").eq(i + 2).css('left','40%').addClass('sponsors-active').css('transition-delay','1.75s');
                $("#c > li").eq(i + 3).css('left','60%').addClass('sponsors-active').css('transition-delay','2s');
                $("#c > li").eq(i + 4).css('left','80%').addClass('sponsors-active').css('transition-delay','2.25s');

            }, timer);
        }

        else {
            var timer = 4000;

            var i = 0;
            var max = $('#c > li').length;

            $("#c > li").eq(i).addClass('sponsors-active').css('left','0');
            $("#c > li").eq(i + 1).addClass('sponsors-active').css('left','33%');
            $("#c > li").eq(i + 2).addClass('sponsors-active').css('left','66%');



            setInterval(function(){

                $("#c > li").removeClass('sponsors-active');

                $("#c > li").eq(i).css('transition-delay','0.25s');
                $("#c > li").eq(i + 1).css('transition-delay','0.5s');
                $("#c > li").eq(i + 2).css('transition-delay','0.75s');

                if (i < max-3) {
                    i = i+3;
                }

                else {
                    i = 0;
                }

                $("#c > li").eq(i).css('left','0').addClass('sponsors-active').css('transition-delay','1.25s');
                $("#c > li").eq(i + 1).css('left','33%').addClass('sponsors-active').css('transition-delay','1.5s');
                $("#c > li").eq(i + 2).css('left','66%').addClass('sponsors-active').css('transition-delay','1.75s');

            }, timer);
        }
    </script>

    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
@endsection
