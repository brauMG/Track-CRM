@extends('layout.app')

@section('title', ' | Lista de Usuarios')

@section('content')

    <section class="content-header">
        <h1>
            Usuarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm pull-right" title="Add New user">
                            <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nuevo
                        </a>

                        <form method="GET" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Compañia</th>
                                    <th>Correo electrónico</th>
                                    <th>Posición</th>
                                    <th>Es Administrador</th>
                                    <th>Activo / Baneado</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->position_title }}</td>
                                        <td>{!! $item->is_admin == 1? '<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>' !!}</td>
                                        <td>{!! $item->is_active == 1? '<i class="fa fa-check"></i>':'<i class="fa fa-ban"></i>' !!}</td>
                                        <td>@if(isset($item->roles[0])) <span class="label label-success">{{ $item->roles[0]->name }}</span> @endif</td>
                                        <td>
                                            <a href="{{ url('/admin/users/' . $item->id) }}" title="View user"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            @if($item->is_admin == 0)
                                                @if($item->is_super_admin == 0)
                                                <a href="{{ url('/admin/users/role/' . $item->id) }}" title="Select role"><button class="btn bg-purple btn-sm"><i class="fa fa-user" aria-hidden="true"></i> Seleccionar rol</button></a>
                                                @endif
                                            @endif
                                            @if($item->is_admin == 0)
                                                @if($item->is_super_admin == 0)
                                                    <form method="POST" action="{{ url('/admin/users' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete user" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
