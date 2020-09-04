@extends('layout.app')

@section('title', ' | Lista de Catalogos')

@section('content')

        <section class="content-header">
            <h1>
                Catalogos
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
                <li class="active">Catalogos</li>
            </ol>
        </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                            <a href="{{ url('/admin/catalogue/create') }}" class="btn btn-success btn-sm pull-right" title="Add New Item">
                                <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nuevo Catalogo
                            </a>

                            <form method="GET" action="{{ url('/admin/catalogue') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                        <div class="container">
                            <div class="table-responsive">
                                <div class="col text-center">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Identificador</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>PDF</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($catalogue as $item)
                                            <tr>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->id }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->name }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->description }}</td>
                                                <td class="td td-center" style="vertical-align: middle"><a target="_blank" href="{{ URL::to('/') }}/uploads/catalogue/{{$item->file}}">Ver</a></td>
                                                <td class="td td-center" style="vertical-align: middle">
                                                    <form method="POST" action="{{ url('/admin/catalogue' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete catalogue" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination-wrapper"> {!! $catalogue->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
