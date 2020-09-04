@extends('layout.app')

@section('title', ' | Crear Cotización')

@section('content')

    <section class="content-header">
        <h1>
            Crear nueva cotización
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/quotation') }}"> Cotizaciones </a></li>
            <li class="active">Crear</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/quotation') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form>
                            <div class="form-group">
                                <label for="">Seleccion el articulo:</label>
                                <select id="item" class="form-control" type="text">
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}. Cód. {{$item->id}}. en existencia: {{$item->stock}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Cantidad:</label>
                                <input id="quantity" class="form-control" type="number" min="0" value="0">
                            </div>

                            <div class="form-group text-left">
                                <button class="btn btn-success" type="button" onclick="add_fields();">
                                    Añadir Articulo
                                </button>
                                <button class="btn btn-danger" type="button" onclick="myDeleteFunction()">
                                    Eliminar Último Artículo
                                </button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/admin/quotation') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="control-label">{{ 'Nombre' }}</label>
                                <input class="form-control" name="name" type="text" id="name">
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Descripcion' }}</label>
                                <input class="form-control" name="description" type="text" id="description" >
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group">
                                <label for="">Selecciona el contacto al que pertenece la cotización:</label>
                                <select name="contact_id" class="form-control" type="text">
                                    @foreach($contacts as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->middle_name}} {{$item->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <table id="myTable" class="table table-bordered">
                                <tr>
                                    <th style="text-align: left; width: 15%">Código del Artículo</th>
                                    <th style="text-align: left">Cantidad</th>
                                </tr>
                            </table>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Crear">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function add_fields() {
        var code = document.getElementById("item");
        var value = code.value.trim();
        var quatity = document.getElementById("quantity");
        var value2 = quatity.value.trim();
        if (!value) {
            alert("El articulo es necesario");
        }
        if (value2 == 0) {
            alert("La cantidad no puede ser 0");
        }
        if (value !== '' & value2 > 0) {
            document.getElementById("myTable").insertRow(-1).innerHTML = '<tr>' +
                '<td>' +
                '<input style="text-align: center; width: 100%; background-color: transparent" name="items[]"  value="'+value+'" readonly>' +
                '</td>' +
                '<td>' +
                '<input style="text-align: center; width: 10%; background-color: transparent" name="quantities[]"  value="'+value2+'" readonly>' +
                '</td >' +
                '</tr>';
        }
    }

    function myDeleteFunction() {
        document.getElementById("myTable").deleteRow(-1);
    }
</script>
@endsection
