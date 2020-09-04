@extends('layout.app')

@section('title', ' | Mostrar rol')

@section('content')

    <section class="content-header">
        <h1>
            rol #{{ $role->id }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/roles') }}">Roles</a></li>
            <li class="active">Mostrar</li>
        </ol>
    </section>


    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}" title="Edit role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/roles' . '/' . $role->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete role" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $role->id }}</td>
                                </tr>
                                <tr><th> Nombre </th><td> {{ $role->name }} </td></tr>
                                <tr>
                                    <th>Permisos</th>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <i class="btn bg-navy" style="margin: 2px">{{ ucfirst(str_replace("_", " ", $permission->name)) }}</i>
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
