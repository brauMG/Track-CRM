@extends('layout.app')

@section('title', ' | Actualizar el estado de una tarea')

@section('content')

    <section class="content-header">
        <h1>
            Actualizar estado de una tarea
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/tasks') }}">Tarea</a></li>
            <li class="active">Actualizar tarea</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/tasks') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/tasks/' . $task->id . '/update-status') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            {{ method_field("put") }}

                            <div class="form-group {{ $errors->has('assigned_user_id') ? 'has-error' : ''}}">
                                <label for="status" class="control-label">{{ 'Estado' }}</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach($statuses as $status)
                                        @if($status->id != $task->status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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
