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
                            {!! $errors->first('firstP', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="secondP" class="control-label">{{ 'Segundo Párrafo' }}</label>
                            <textarea class="form-control" name="secondP" type="text" id="secondP" placeholder="El texto que ingreses se vera reflejado en el segundo párrafo del correo" required></textarea>
                            {!! $errors->first('secondP', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ 'Titulo' }}</label>
                            <input class="form-control" name="title" type="text" id="title" placeholder="Se vera reflejado en la parte superior del correo" required>
                            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend" style="padding-bottom: 3%">
                                    <div class="input-group-text"><i class="fa fa-calendar"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Catalogo</strong></a></i></div>
                                </div>
                                <select class="selectpicker" name="pdf" type="text" id="pdf" data-live-search="true" data-style="btn-primary" data-width="fit" required>
                                    @foreach($catalogues as $catalogue)
                                        <option value="{{ URL::to('/') }}/uploads/catalogue/{{$catalogue->file}}">{{$catalogue->name}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('pdf', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="imageLink" class="control-label">{{ 'Vinculo a Imagen (de campaña)' }}</label>
                            <input class="form-control" name="imageLink" type="text" id="imageLink" placeholder="Ingresa el link de la imagen referente a la campaña" required>
                            {!! $errors->first('imageLink', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend" style="padding-bottom: 3%">
                                    <div class="input-group-text"><i class="fa fa-address-book"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Enviar a:</strong></a></i></div>
                                </div>
                                <select class="selectpicker" name="emails[]" type="text" multiple data-live-search="true" data-style="btn-success" data-width="fit" data-actions-box="true" required>
                                        @foreach($contacts as $contact)
                                            @if($contact->contactStatus == 'Prospecto')
                                                <optgroup label="Prospectos">
                                                    <option value="{{$contact->contactEmail}}"> {{$contact->first_name.' '.$contact->last_name.' - '.$contact->contactStatus}}</option>
                                                </optgroup>
                                            @endif
                                            @if($contact->contactStatus == 'Oportunidad')
                                                <optgroup label="Oportunidades">
                                                    <option value="{{$contact->contactEmail}}"> {{$contact->first_name.' '.$contact->last_name.' - '.$contact->contactStatus}}</option>
                                                </optgroup>
                                            @endif
                                            @if($contact->contactStatus == 'Cliente')
                                                <optgroup label="Clientes">
                                                    <option value="{{$contact->contactEmail}}"> {{$contact->first_name.' '.$contact->last_name.' - '.$contact->contactStatus}}</option>
                                                </optgroup>
                                            @endif
                                            @if($contact->contactStatus == 'Cerrado')
                                                <optgroup label="Cerrados">
                                                    <option value="{{$contact->contactEmail}}"> {{$contact->first_name.' '.$contact->last_name.' - '.$contact->contactStatus}}</option>
                                                </optgroup>
                                            @endif
                                        @endforeach
                                </select>
                                {!! $errors->first('emails', '<p class="help-block">:message</p>') !!}
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

        <script>
            $(function () {
                $('select').selectpicker();
            });
        </script>
    </section>
@endsection
