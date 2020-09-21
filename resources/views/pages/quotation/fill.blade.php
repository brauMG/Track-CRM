@extends('layout.app')

@section('title', ' | Crear Cotización')

@section('content')

    <section class="content-header">
        <h1>
            Crear nueva cotización - <strong>Ingresa la cantidad</strong>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/quotation') }}"> Cotizaciones </a></li>
            <li class="active">Crear</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/quotation') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                            <form method="POST" action="{{route('Filled')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="name" value="{{$name}}">
                            <input type="hidden" name="description" value="{{$description}}">
                            <input type="hidden" name="contact_id" value="{{$contact_id}}">

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Generar Catalogo">
                            </div>

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
                                            <th>Cantidad</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->id }}</td>
                                                <td class="td td-center" style="text-align: center">
                                                    <img class="pull-left" src="{{ url('uploads/inventory/' . $item->image) }}" width="100" height="100" />
                                                </td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->name }}</td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->description }}</td>
                                                <td class="td td-center" style="vertical-align: middle"><i class="fa fa-dollar"></i><strong>{{ $item->price }}</strong></td>
                                                <td class="td td-center" style="vertical-align: middle">{{ $item->stock }}</td>
                                                <td class="td td-center" style="vertical-align: middle">
                                                    <input type="hidden" name="items[]" value="{{$item->id}}">
                                                    <input class="form-control" name="quantities[]" type="number" max="{{$item->stock}}" min="1" value="1" required style="background-color: #013468; color: white; width: 100%; text-align: center; font-size: large; font-family: 'Arial Narrow'">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Generar Catalogo">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
