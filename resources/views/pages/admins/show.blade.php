@extends('layout.app')

@section('title', ' | Mostrar Administrador')

@section('content')

    <section class="content-header">
        <h1>
            Administrador #{{ $user->id }}
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/admins') }}"> Lista de Administradores </a></li>
            <li class="active">Mostrar</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ URL::previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>

                        <a href="{{ url('/admin/admins/' . $user->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        @if($user->company_id != 2)
                            <form method="POST" action="{{ url('admin/admins' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete user" onclick="return confirm('Seguro?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                            </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                @if(!empty($user->image))
                                    <tr>
                                        <td>
                                            <img src="{{ url('uploads/users/' . $user->image) }}" class="pull-right" width="200" height="200" />
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <th>ID</th><td>{{ $user->id }}</td>
                                </tr>
                                <tr><th> Nombre </th><td> {{ $user->name }} </td>
                                </tr><tr><th> Correo electrónico </th><td> {{ $user->email }} </td></tr>
                                <tr><th> Posición </th><td> {{ $user->position_title }} </td></tr>
                                <tr><th> Teléfono </th><td> {{ $user->phone }} </td></tr>
                                <tr><th> Compañia </th><td> {{ $user->company }} </td></tr>
                                <tr><th> Es Administrador </th><td> {!! $user->is_admin == 1? '<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>' !!} </td></tr>
                                <tr><th> Esta Activo </th><td> {!! $user->is_active == 1? '<i class="fa fa-check"></i>':'<i class="fa fa-ban"></i>' !!} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
