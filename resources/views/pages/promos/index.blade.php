@extends('layout.app')

@section('title', ' | Marketing de Campañas')

@section('content')

    <section class="content-header">
        <h1>
            Marketing de Promociones
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li class="active">Marketing de Campañas</li>
        </ol>
    </section>
    @if ( session('mensaje') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
        </div>
    @endif

    <section class="content">
        <form method="POST" action="{{ url('/admin/promos/send') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">Información Básica</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstP" class="control-label">{{ 'Primer Párrafo' }}</label>
                            <textarea class="form-control" name="firstP" type="text" id="firstP" placeholder="El texto que ingreses se vera reflejado en el primer párrafo del correo" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="secondP" class="control-label">{{ 'Segundo Párrafo' }}</label>
                            <textarea class="form-control" name="secondP" type="text" id="secondP" placeholder="El texto que ingreses se vera reflejado en el segundo párrafo del correo" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ 'Titulo' }}</label>
                            <input class="form-control" name="title" type="text" id="title" placeholder="Se vera reflejado en la parte superior del correo" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pdf" class="control-label">{{ 'Catalogo' }}</label>
                            <select class="form-control" name="pdf" type="text" id="pdf" required>
                                @foreach($catalogues as $catalogue)
                                    <option value="{{ URL::to('/') }}/uploads/catalogue/{{$catalogue->file}}">{{$catalogue->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="imageLink" class="control-label">{{ 'Vinculo a Imagen (de campaña)' }}</label>
                            <input class="form-control" name="imageLink" type="text" id="imageLink" placeholder="Ingresa el link de la imagen referente a la campaña" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-address-book"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Enviar a:</strong></a></i></div>
                                </div>
                            <div class="form-group" style="justify-content: space-between;">
                                <div style="margin-top: 3%; height: 110px; width: 200px; overflow-y: scroll;"
                                @if(count($contacts) == 0)
                                    <a style="color: #c42623; font-size: 1.2em"><strong>No hay contactos</strong></a>
                                @else
                                    @foreach($contacts as $contact)
                                        <label style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"></label>
                                        <input style="position: relative;top: 2px;" type="checkbox" name="emails[]" value="{{$contact->contactEmail}}"> {{$contact->first_name.' '.$contact->last_name.' - '.$contact->contactStatus}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Enviar Correos">
            <a href="{{url('/admin/promos/preview')}}" target="_blank" class="btn btn-info">Vista Referencial</a>
        </div>
        </form>
    </section>
@endsection
