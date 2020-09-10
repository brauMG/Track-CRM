@extends('layout.app')

@section('title', ' | Lista de Cotizaciones')

@section('content')

        <section class="content-header">
            <h1>
                Cotizaciones
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
                <li class="active">Cotizaciones</li>
            </ol>
        </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        @if(user_can('create-quotations'))
                            <a href="{{ url('/admin/quotation/create') }}" class="btn btn-success btn-sm pull-right" title="Add New Item">
                                <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nueva Cotización
                            </a>
                        @endif

                            <form method="GET" action="{{ url('/admin/quotation') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Contacto Asignado</th>
                                            <th>Creado Por</th>
                                            <th>PDF</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quotation as $item)
                                            <tr>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->id }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->name }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->description }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{$item->name}} {{$item->middle_name}} {{$item->last_name}}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->user }}</td>
                                                <td class="td td-center" style="vertical-align: middle"><a target="_blank" href="{{ URL::to('/') }}/uploads/quotation/{{$item->file}}">
                                                        @if(user_can('download-quotations'))
                                                            Ver
                                                        @endif
                                                    </a></td>
                                                <td class="td td-center" style="vertical-align: middle">
                                                    @if(user_can('delete-quotations'))
                                                        <form method="POST" action="{{ url('/admin/quotation' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete catalogue" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination-wrapper"> {!! $quotation->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
