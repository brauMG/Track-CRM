@extends('layout.app')

@section('title', ' | Lista de Patrocinadores')

@section('content')

    <section class="content-header">
        <h1>
            Patrocinadores
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li class="active">Patrocinadores</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ url('/admin/sponsors/create') }}" class="btn btn-success btn-sm pull-right" title="Add New Item">
                            <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nuevo Patrocinador
                        </a>

                        <form method="GET" action="{{ url('/admin/sponsors') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                        <th>Link</th>
                                        <th>En Inicio</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sponsors as $item)
                                        <tr>
                                            <td class="td td-center" style="vertical-align: middle">{{ $item->sponsorId }}</td>
                                            <td class="td td-center" style="text-align: center">
                                                <img src="{{ url('uploads/sponsors/' . $item->image) }}" width="100" height="100" />
                                            </td>
                                            <td class="td td-center" style="vertical-align: middle">{{ $item->name }}</td>
                                            <td class="td td-center" style="vertical-align: middle">{{ $item->description }}</td>
                                            <td class="td td-center" style="vertical-align: middle">{{ $item->link }}</td>
                                            <td class="td td-center" style="vertical-align: middle"><i class="fa fa-eye"></i><strong>@if($item->show == true) Si @else No @endif</strong></td>
                                            <td class="td td-center" style="vertical-align: middle">
                                                <a href="{{ url('/admin/sponsors/' . $item->sponsorId) }}" title="View inventory"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                <a href="{{ url('/admin/sponsors/' . $item->sponsorId . '/edit') }}" title="Edit inventory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                                <form method="POST" action="{{ url('/admin/sponsors' . '/' . $item->sponsorId) }}" accept-charset="UTF-8" style="display:inline">
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
                            <div class="pagination-wrapper"> {!! $sponsors->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

