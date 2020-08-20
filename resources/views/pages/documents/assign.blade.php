@extends('layout.app')

@section('title', ' | Asignar a contacto')

@section('content')

    <section class="content-header">
        <h1>
            Asignar documento
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/documents') }}">Documentos</a></li>
            <li class="active">Asignar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/documents') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/documents/' . $document->id . '/assign') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            {{ method_field("put") }}

                            <div class="form-group {{ $errors->has('assigned_user_id') ? 'has-error' : ''}}">
                                <label for="assigned_user_id" class="control-label">{{ 'Usuario Asignado' }}</label>
                                <select name="assigned_user_id" id="assigned_user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                {!! $errors->first('assigned_user_id', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Asignar">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
