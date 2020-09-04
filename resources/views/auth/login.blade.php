@extends('layout.auth')

@section('content')
    @inject('sponsors', 'App\Services\Sponsors')
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

    @if(count($sponsors->get()->toArray()) == 0)
    @else
        <div class="sponsors-navbar-login">
            <ul class="sponsors-ul-login" id="c">
                @foreach($sponsors->get() as $sponsor)
                    <li class="sponsors-li-login">
                        <img data-toggle="modal" data-target="#info{{$sponsor->sponsorId}}" src="{{ URL::to('/') }}/uploads/sponsors/{{ $sponsor->image }}" class="sponsors-img-login"/>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @foreach($sponsors->get() as $sponsor)
        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="info{{$sponsor->sponsorId}}">
            <div class="modal-dialog padding-modal" role="document">
                <form target="_blank" action="https://{{$sponsor->link}}">
                    <div class="modal-content"style="background-color: #ffffff;color: white;">
                        <div class="modal-header ">
                            <h5 class="modal-title"  id="exampleModalLongTitle"><img src="{{ URL::to('/') }}/uploads/sponsors/{{ $sponsor->image }}" width="75"/></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 20% !important;">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div style="background-color: white;color: black;">
                            <div class="modal-body">
                                {{$sponsor->description}}
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: white;color: black;">
                            <input type="submit" class="btn btn-primary" value="Ir a su sitio web">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

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
