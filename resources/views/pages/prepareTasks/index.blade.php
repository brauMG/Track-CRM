@extends('layout.app')

@section('title', ' | Generar Reporte de Tareas')

@section('content')
    <section class="content-header">
        <h1>
            Filtros - Reporte de Tareas
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Generar Reporte de Tareas</li>
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
        <form method="POST" action="{{route('TasksPDF')}}">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Fecha de Creación</strong></a></i></div>
                            </div>
                            <div class="form-group" style="padding-top: 1%">
                                <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Desde el: </label>
                                <input class="form-control date-mod" type="date" id="desde" name="desde" style="background-color: white !important; color: black !important;">
                            </div>
                            <div class="form-group">
                                <label for="creacion" style="margin-top: 1% !important;" class="label-mod">Hasta el: </label>
                                <input class="form-control date-mod" type="date" id="hasta" name="hasta" style="background-color: white !important; color: black !important;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="input-group-prepend" style="padding-bottom: 1%;">
                <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Asignada a Usuarios</strong></a></i></div>
            </div>
            <div class="form-group">
                <select class="selectpicker pull-left" name="asignadas_a[]" type="text" multiple data-live-search="true" data-style="btn-success" data-width="50%" data-actions-box="true">
                    @foreach($users as $user)
                        @if($user->id == 2)
                        @else
                            <option value="{{$user->id}}"> {{$user->name}} - {{$user->email}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <br>
            <br>

            <div class="input-group-prepend" style="padding-bottom: 1%">
                <div class="input-group-text"><i class="fa fa-gears"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Estados de Tarea</strong></a></i></div>
            </div>
            <div class="form-group">
                <select class="selectpicker pull-left" name="estados[]" type="text" multiple data-live-search="true" data-style="btn-success" data-width="50%" data-actions-box="true">
                    @foreach($status as $item)
                        <option value="{{$item->id}}"> {{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <br>


            <div class="input-group-prepend" style="padding-bottom: 1%">
                <div class="input-group-text"><i class="fa fa-tasks"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Tipos de Tarea</strong></a></i></div>
            </div>
            <div class="form-group">
                <select class="selectpicker pull-left" name="tipos[]" type="text" multiple data-live-search="true" data-style="btn-success" data-width="50%" data-actions-box="true">
                    @foreach($type as $item)
                        <option value="{{$item->id}}"> {{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <br>

            <div class="input-group-prepend" style="padding-bottom: 1%">
                <div class="input-group-text"><i class="fa fa-book"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Con Contactos</strong></a></i></div>
            </div>
            <div class="form-group">
                <select class="selectpicker pull-left" name="contactos[]" type="text" multiple data-live-search="true" data-style="btn-primary" data-width="50%" data-actions-box="true">
                    @foreach($contacts as $item)
                        <option value="{{$item->id}}"> {{$item->first_name.' '.$item->last_name}}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <br>

            <div class="input-group-prepend" style="padding-bottom: 1%">
                <div class="input-group-text"><i class="fa fa-bookmark"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Con Tipos de Contactos</strong></a></i></div>
            </div>
            <div class="form-group">
                <select class="selectpicker pull-left" name="contactos_estado[]" type="text" multiple data-live-search="true" data-style="btn-primary" data-width="50%" data-actions-box="true">
                    @foreach($contact_type as $item)
                        <option value="{{$item->id}}"> {{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <br>

            <div class="input-group-prepend" style="padding-bottom: 1%">
                <div class="input-group-text"><i class="fa fa-bell"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Prioridad</strong></a></i></div>
            </div>
            <div class="form-group">
                <select class="selectpicker pull-left" name="prioridad[]" type="text" multiple data-live-search="true" data-style="btn-primary" data-width="50%" data-actions-box="true">
                    <option value="{{$priority[0]}}">Baja</option>
                    <option value="{{$priority[1]}}">Normal</option>
                    <option value="{{$priority[2]}}">Alta</option>
                    <option value="{{$priority[3]}}">Urgente</option>
                </select>
            </div>


            <div class="container" style="text-align: center; padding-top: 2%">
                <button type="submit" class="btn btn-info" onclick="myFunction()">Generar Reporte</button>
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

        $(function () {
            $('select').selectpicker();
        });
    </script>
@endsection
