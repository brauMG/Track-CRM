@extends('layout.guest')
@section('title', ' | Ingreso de Datos')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<div class="wrapper-less">
    <div class="container">
        <div class="login-box" style="width: 100% !important;">
            <div class="login-logo" style="color: #001015; font-size: 45px !important;">
                @if($company_name == 'CRM')
                    <b style="color: white">Track</b>CRM
                @else
                    <b style="color: white">Track</b>{{$company_name}}
                @endif
            </div>
            <!-- /.login-logo -->
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-8 col-lg-6 pb-5" style="z-index: 20">
                            <form method="POST" action="{{ url('/guest/campaigns/storeQuiz') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card border-primary rounded-0">
                                    <div class="card-header p-0">
                                        <div class="bg-info text-white text-center py-2">
                                            <h3><i class="fa fa-phone-square"></i> Ingreso de Datos</h3>
                                            @if($company_name == 'CRM')
                                                <p class="m-0">Pronto un ejecutivo de Track CRM se pondrá en contacto contigo.</p>
                                            @else
                                                <p class="m-0">Pronto un ejecutivo de Track {{$company_name}} se pondrá en contacto contigo.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$id}}" name="campaign_id">
                                    <input type="hidden" value="{{$company_name}}" name="company_name">
                                    <div class="card-body p-3">

                                        <div class="row">

                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa tu nombre</a></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user-plus text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa tu apellido paterno</a></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="middle_name" name="middle_name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user-plus text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa tu apellido materno</a></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-bell text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">¿Cómo te enteraste de nuestra campaña?</a></i></div>
                                                        </div>
                                                        <select type="text" class="form-control" id="referral_source" name="referral_source" style="padding: 0" required>
                                                            <option value="Anuncio de Facebook">Anuncio de Facebook</option>
                                                            <option value="Anuncio de Google">Anuncio de Google</option>
                                                            <option value="Anuncio de Youtube">Anuncio de Youtube</option>
                                                            <option value="Contactado Por Empleado">Contactado Por Empleado</option>
                                                            <option value="Redes Sociales">Redes Sociales</option>
                                                            <option value="Otro">Otro</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-envelope text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa tu correo eléctronico</a></i></div>
                                                        </div>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@gmail.com" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-phone text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa tu número telefónico</a></i></div>
                                                        </div>
                                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-comment text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Comentario adicional</a></i></div>
                                                        </div>
                                                        <textarea name="description" class="form-control" placeholder="Comentario adicional para la persona que te vaya a contactar"></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info btn-block rounded-0 py-2">Enviar</button>
                                            </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
        </div>
    </div>
</div>

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
