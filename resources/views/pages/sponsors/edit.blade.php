@extends('layout.app')

@section('title', ' | Editar Patrocinador')

@section('content')

    <section class="content-header">
        <h1>
            Editar patrocinador
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/sponsors') }}"> Patrocinadores </a></li>
            <li class="active">Editar</li>
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

                        <form method="POST" action="{{ url('/admin/sponsors/' . $sponsor->sponsorId) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="control-label">{{ 'Nombre' }}</label>
                                <input type="text" name="name" id="nameS" class="form-control @error('name') is-invalid @enderror" value="{{ $sponsor->name }}" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                <input class="adjust-file2 form-control @error('image') is-invalid @enderror" type="file" name="image" />
                                    <label for="image" class="control-label">{{ 'Imagen' }}</label>
                                    <img src="{{ URL::to('/') }}/uploads/sponsors/{{ $sponsor->image }}" class="img-thumbnail" width="100" />
                                    <input type="hidden" name="hidden_image" value="{{ $sponsor->image }}" />
                                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Descripcion' }}</label>
                                <textarea rows="5" style="background-color: #eff0ee" name="description" id="descriptionS"  class="form-control @error('description') is-invalid @enderror" required>{{ $sponsor->description }}</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Sitio WEB' }}</label>
                                <input type="text" name="link" id="linkS"  class="form-control @error('link') is-invalid @enderror" value="{{ $sponsor->link }}" required>
                                {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group">
                                <th id='head' class="th-card"><i class="fa fa-check-circle"></i> Mostrar en Inicio</th>
                                <td class="td-card">
                                    <div class="form-check">
                                        @if($sponsor['show'] == true)
                                            <input class="form-check-input label-size" type="checkbox" name="show" value="1" checked>
                                        @else
                                            <input class="form-check-input label-size" type="checkbox" name="show" value="1">
                                        @endif
                                        <label class="form-check-label label-size" for="defaultCheck1">Si</label>
                                    </div>
                                </td>
                            </div>

                            <div class="form-group">
                                <th id='head' class="th-card"><i class="fa fa-check-circle"></i> Compañias Asignadas</th>
                                <td class="td-card">
                                    @foreach ($array_companies as $company)
                                        @if($company['id'] == 2)
                                            <div class="form-check">
                                                <input class="form-check-input label-size" type="hidden" name="companies[{{$company['name']}}]" value="{{ $company['id'] }}" checked>
                                            </div>
                                        @elseif($company['id'] == 1)
                                        @else
                                            @if ($company['valid'])
                                                <div class="form-check">
                                                    <input class="form-check-input label-size" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['id'] }}" checked>
                                                    <label class="form-check-label label-size" for="defaultCheck1">{{ $company['name'] }}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input label-size" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['id'] }}">
                                                    <label class="form-check-label label-size" for="defaultCheck1">{{ $company['name'] }}</label>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                    @error('companies')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Actualizar">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
