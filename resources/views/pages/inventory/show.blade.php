@extends('layout.app')

@section('title', ' | Mostrar articulo')

@section('content')

    <section class="content-header">
        <h1>
            Artículo #{{ $inventory->id }}
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/inventory') }}"> Inventario </a></li>
            <li class="active">Mostrar</li>
        </ol>
    </section>


    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ URL::previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>

                        @if(user_can('edit-articles'))
                        <a href="{{ url('/admin/inventory/' . $inventory->id . '/edit') }}" title="Edit item"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endif

                        @if(user_can('delete-articles'))
                        <form method="POST" action="{{ url('admin/inventory' . '/' . $inventory->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete item" onclick="return confirm('Seguro?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                @if(!empty($inventory->image))
                                    <div class="container">
                                        <tr>
                                            <td>
                                                <img src="{{ url('uploads/inventory/' . $inventory->image) }}" width="200" height="200" />
                                            </td>
                                        </tr>
                                    </div>
                                @endif

                                <tr>
                                    <th>ID</th><td>{{ $inventory->id }}</td>
                                </tr>
                                <tr><th> Nombre </th><td> {{ $inventory->name }} </td>
                                <tr><th> Descripción </th><td> {{ $inventory->description }} </td>
                                <tr><th> Precio </th><td><i class="fa fa-dollar"></i><strong>{{ $inventory->price }}</strong> </td>
                                </tr><tr><th> Stock </th><td> {{ $inventory->stock }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
