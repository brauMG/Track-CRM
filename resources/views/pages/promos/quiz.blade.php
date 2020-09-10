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
                            <form method="POST" action="{{ url('/guest/promos/storeQuiz') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card border-primary rounded-0">
                                    <div class="card-header p-0">
                                        <div class="bg-info text-white text-center py-2">
                                            <h3><i class="fa fa-phone-square"></i> Comunícate Con Nosotros</h3>
                                            @if($company_name == 'CRM')
                                                <p class="m-0">Pronto un ejecutivo de Track CRM se pondrá en contacto contigo.</p>
                                            @else
                                                <p class="m-0">Pronto un ejecutivo de Track {{$company_name}} se pondrá en contacto contigo.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$id}}" name="catalogue_id">
                                    <input type="hidden" value="{{$user_phone}}" name="user_phone">
                                    <input type="hidden" value="{{$catalogue}}" name="catalogue">
                                    <input type="hidden" value="{{$username}}" name="username">
                                    <input type="hidden" value="{{$company_name}}" name="company_name">
                                    <div class="card-body p-3">

                                        <div class="row">

                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Correo Eléctronico del Ejecutivo</a></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="user_email" name="user_email" value="{{$user_email}}" readonly>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user-plus text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa Tu Nombre</a></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" id="my_name" name="my_name" placeholder="Roberto Hernandez" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-user-plus text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Ingresa Tu Correo Eléctronico</a></i></div>
                                                        </div>
                                                        <input type="email" class="form-control" id="my_email" name="my_email" placeholder="ejemplo@gmail.com" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-comment text-info"> <a style="color: #07585c; font-family: 'Source Sans Pro', sans-serif; font-size: 12px">Interés en Servicios y/o Productos</a></i></div>
                                                        </div>
                                                        <textarea name="commentary" class="form-control" placeholder="¿Qué productos o servicios de Track CRM fueron de tu interes? Escríbenos y uno de nuestros ejecutivos te brindará mas información al respecto."></textarea>
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
