@extends('layout.app')

@section('title', ' | Generar Reporte de Campañas')

@section('content')
    <section class="content-header">
        <h1>
            Reporte de Campañas
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Generar Reporte de Campañas</li>
        </ol>
    </section>
    @if (session('danger') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-danger" class='message' id='message'>{{ session('danger') }}</div>
        </div>
    @endif
    @if (session('success') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-success" class='message' id='message'>{{ session('success') }}</div>
        </div>
    @endif

    <section class="content">
        <form method="POST" action="{{route('CampaignsPDF')}}">
            @csrf
            <section class="col-lg-12 connectedSortable ui-sortable">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Filtros</h3>
                    </div>

                    <div class="row">

                        <div class="box-body table-responsive" style="border: none">

                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-calendar"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Fechas</strong></a></i></div>
                                        </div>
                                        <div class="form-group" style="padding-top: 1%">
                                            <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Creadas desde: </label>
                                            <input class="form-control date-mod" type="date" id="desde" name="creada" style="background-color: white !important; color: black !important;">
                                        </div>
                                        <div class="form-group">
                                            <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Vencidas hasta: </label>
                                            <input class="form-control date-mod" type="date" id="hasta" name="vence" style="background-color: white !important; color: black !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Contactos Alcanzados</strong></a></i></div>
                                        </div>
                                        <div class="form-group" style="padding-top: 1%">
                                            <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Desde: </label>
                                            <input class="form-control date-mod" type="number" min="0" name="contactos_desde" style="background-color: white !important; color: black !important;">
                                        </div>
                                        <div class="form-group">
                                            <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Hasta: </label>
                                            <input class="form-control date-mod" type="number" min="0" name="contactos_hasta" style="background-color: white !important; color: black !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-cubes"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Inversion Realizada</strong></a></i></div>
                                        </div>
                                        <div class="form-group" style="padding-top: 1%">
                                            <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Desde: </label>
                                            <input class="form-control date-mod" type="number" min="0" name="inversion_desde" style="background-color: white !important; color: black !important;">
                                        </div>
                                        <div class="form-group">
                                            <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Hasta: </label>
                                            <input class="form-control date-mod" type="number" min="0" name="inversion_hasta" style="background-color: white !important; color: black !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </section>
            <div class="container" style="text-align: center; padding-top: 2%">
                <button type="submit" class="btn btn-primary" onclick="myFunction()">Generar Reporte</button>
                <button type="reset" class="btn btn-warning" onclick="myFunction2()">Limpiar Campos</button>
                <div id="mySpan" style="text-align: center; padding-top: 1%; color: #16a817; text-transform: uppercase; display: none">
                    <span><strong>El reporte se esta generando y se descargara automaticamente al finalizar</strong></span>
                </div>
            </div>
        </form>
    </section>

    <script>
        function myFunction() {
            var x = document.getElementById("mySpan");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        function myFunction2() {
            var x = document.getElementById("mySpan");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection

