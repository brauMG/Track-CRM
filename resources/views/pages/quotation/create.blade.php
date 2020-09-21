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

                        <form method="POST" action="{{ url('/admin/quotation/fill') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">Seleccion el articulo:</label>
                                <br>
                                <select id="item" name="items[]" class="selectpicker pull-left" data-width="50%" data-live-search="true" data-style="btn-success" type="text" multiple required data-actions-box="true">
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">#{{$item->id}} - {{$item->name}} - {{$item->stock}} en existencia</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <br>

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

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Siguiente">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
