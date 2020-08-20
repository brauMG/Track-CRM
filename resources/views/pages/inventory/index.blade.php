@extends('layout.app')

@section('title', ' | Lista de Artículoss')

@section('content')

        <section class="content-header">
            <h1>
                Inventario
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
                <li class="active">Inventario</li>
            </ol>
        </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                            <a href="{{ url('/admin/inventory/create') }}" class="btn btn-success btn-sm pull-right" title="Add New Item">
                                <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nuevo Artículo
                            </a>

                            <form method="GET" action="{{ url('/admin/inventory') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                <div class="col text-center">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Identificador</th>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($inventory as $item)
                                            <tr>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->id }}</td>
                                                <td class="td td-center" style="text-align: center">
                                                    <img src="{{ url('uploads/inventory/' . $item->image) }}" width="100" height="100" />
                                                </td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->name }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->description }}</td>
                                                <td class="td td-center" style="vertical-align: middle"><i class="fa fa-dollar"></i><strong>{{ $item->price }}</strong></td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->stock }}</td>
                                                <td class="td td-center" style="vertical-align: middle">
                                                    <a href="{{ url('/admin/inventory/' . $item->id) }}" title="View inventory"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                    <a href="{{ url('/admin/inventory/' . $item->id . '/edit') }}" title="Edit inventory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                                    <form method="POST" action="{{ url('/admin/inventory' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete item" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination-wrapper"> {!! $inventory->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
