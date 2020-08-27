@extends('layout.app')

@section('title', ' | Generar Reporte de Tareas')

@section('content')
    <section class="content-header">
        <h1>
            Reporte de Tareas
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
            <section class="col-lg-12 connectedSortable ui-sortable">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Filtros</h3>
                    </div>

                    <div class="row">

                        <div class="box-body table-responsive" style="border: none">

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

                            <div class="col-lg-4 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Asignada a Usuarios</strong></a></i></div>
                                        </div>
                                        <div class="form-group" style="justify-content: space-between;">
                                            <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;"
                                            @if(count($users) == 0)
                                                <a style="color: #c42623; font-size: 1.2em"><strong>No hay usuarios</strong></a>
                                            @else
                                                @foreach($users as $user)
                                                    @if($user->id == 2)
                                                    @else
                                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                                        <input style="position: relative;top: 2px;" type="checkbox" name="asignadas_a[]" value="{{$user->id}}"> {{$user->name}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Estados de Tarea</strong></a></i></div>
                                </div>
                                <div class="form-group" style="justify-content: space-between;">
                                    <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;"
                                    @if(count($status) == 0)
                                        <a style="color: #c42623; font-size: 1.2em"><strong>No hay estados</strong></a>
                                    @else
                                        @foreach($status as $item)
                                                <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                                <input style="position: relative;top: 2px;" type="checkbox" name="estados[]" value="{{$item->id}}"> {{$item->name}}
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Tipos de Tarea</strong></a></i></div>
                            </div>
                            <div class="form-group" style="justify-content: space-between;">
                                <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;"
                                @if(count($type) == 0)
                                    <a style="color: #c42623; font-size: 1.2em"><strong>No hay tipos de tarea</strong></a>
                                @else
                                    @foreach($type as $item)
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="tipos[]" value="{{$item->id}}"> {{$item->name}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Con Contactos</strong></a></i></div>
                            </div>
                            <div class="form-group" style="justify-content: space-between;">
                                <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;"
                                @if(count($contacts) == 0)
                                    <a style="color: #c42623; font-size: 1.2em"><strong>No hay contactos</strong></a>
                                @else
                                    @foreach($contacts as $item)
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="contactos[]" value="{{$item->id}}"> {{$item->first_name.' '.$item->last_name}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-users"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Con Tipos de Contacto</strong></a></i></div>
                            </div>
                            <div class="form-group" style="justify-content: space-between;">
                                <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;"
                                @if(count($contact_type) == 0)
                                    <a style="color: #c42623; font-size: 1.2em"><strong>No hay tipos de contactos</strong></a>
                                @else
                                    @foreach($contact_type as $item)
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="contactos_estado[]" value="{{$item->id}}"> {{$item->name}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>



                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-bell"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Prioridad</strong></a></i></div>
                                </div>
                                <div class="form-group" style="justify-content: space-between;">
                                    <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;">
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="prioridad[]" value="{{$priority[0]}}"> Baja
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="prioridad[]" value="{{$priority[1]}}"> Normal
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="prioridad[]" value="{{$priority[2]}}"> Alta
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="prioridad[]" value="{{$priority[3]}}"> Urgente
                                    </div>
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
