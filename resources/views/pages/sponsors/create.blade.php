@extends('layout.app')

@section('title', ' | Añadir Patrocinador')

@section('content')

    <section class="content-header">
        <h1>
            Añadir nuevo patrocinador
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/inventory') }}"> Patrocinadores </a></li>
            <li class="active">Añadir</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/sponsors') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/sponsors') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="control-label">{{ 'Nombre' }}</label>
                                <input class="form-control" name="name" type="text" id="name" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                <label for="image" class="control-label">{{ 'Imagen' }}</label>
                                <input class="form-control" name="image" type="file" id="image" required>
                                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Descripcion' }}</label>
                                <textarea rows="5" class="form-control" name="description" type="text" id="description" required></textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Sitio WEB' }}</label>
                                <input class="form-control" name="link" type="text" id="description" required>
                                {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group">
                                <th id='head' class="th-card"><i class="fa fa-check-circle"></i> Mostrar en Inicio</th>
                                <td class="td-card">
                                    <div class="form-check">
                                        <input class="form-check-input label-size" type="checkbox" name="show" value="1">
                                        <label class="form-check-label label-size" for="defaultCheck1">Si</label>
                                    </div>
                                </td>
                            </div>

                            <div class="form-group">
                                <th id='head' class="th-card"><i class="fa fa-check-circle"></i> Compañias Asignadas</th>
                                <td class="td-card">
                                @foreach ($companies as $company)
                                    @if($company->id == 2)
                                        <div class="form-check">
                                            <input class="form-check-input label-size" type="hidden" name="companies[{{$company->name}}]" value="{{ $company->id }}" checked>
                                        </div>
                                    @elseif($company->id == 1)
                                    @else
                                        <div class="form-check">
                                            <input class="form-check-input label-size" type="checkbox" name="companies[{{$company->name}}]" value="{{ $company->id }}">
                                            <label class="form-check-label label-size" for="defaultCheck1">{{ $company->name }}</label>
                                        </div>
                                    @endif
                                @endforeach
                                @error('companies')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Añadir">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
