@extends('layout.app')

@section('title', ' | Mostrar Documento')

@section('content')

    <section class="content-header">
        <h1>
            documento #{{ $document->id }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/documents') }}">Documentos</a></li>
            <li class="active">Mostrar</li>
        </ol>
    </section>


    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/documents') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>

                        @if(user_can('edit_document'))
                            <a href="{{ url('/admin/documents/' . $document->id . '/edit') }}" title="Edit document"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endif

                        @if(user_can('delete_document'))
                            <form method="POST" action="{{ url('admin/documents' . '/' . $document->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete document" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                            </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                @if(\Auth::user()->is_admin == 1)
                                    <tr>
                                        <th>ID</th><td>{{ $document->id }}</td>
                                    </tr>
                                @endif
                                <tr><th> Nombre </th><td> {{ $document->name }} </td></tr>
                                <tr><th> Archivo </th><td> @if(!empty($document->file)) <a href="{{ url('uploads/documents/' . $document->file) }}"> <i class="fa fa-download"></i> {{$document->file}}</a> @endif </td></tr>
                                <tr><th> Estado </th><td> {!! $document->status == 1?"<i class='label label-success'>Activo</i>":"<i class='label label-danger'>Inactivo</i>" !!} </td></tr>
                                <tr><th> Tipo </th><td>{{ $document->getType->name }}</td></tr>
                                <tr><th> Fecha de publicación </th><td>{{ $document->publish_date }}</td></tr>
                                <tr><th> Fecha de expiración </th><td>{{ $document->expiration_date }}</td></tr>
                                @if(\Auth::user()->is_admin == 1)
                                    <tr><th> Creado por </th><td>{{ $document->createdBy->name }}</td></tr>
                                    <tr><th> Modificado por </th><td>{{ isset($document->modifiedBy->name)?$document->modifiedBy->name:"" }}</td></tr>
                                @endif

                                <tr><th> Asignado a</th><td>{{ $document->assignedTo != null ?$document->assignedTo->name :"sin asignar" }}</td></tr>
                                <tr><th> Creado el </th><td>{{ $document->created_at }}</td></tr>
                                <tr><th> Modificado el </th><td>{{ $document->updated_at }}</td></tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
