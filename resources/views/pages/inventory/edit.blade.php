@extends('layout.app')

@section('title', ' | Editar Artículo')

@section('content')


    <section class="content-header">
        <h1>
            Editar articulo #{{ $inventory->id }}
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/inventory') }}"> Inventario </a></li>
            <li class="active">Editar</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/inventory') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>

                        <br />
                        <br />

                        <form method="POST" action="{{ url('/admin/inventory/' . $inventory->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('pages.inventory.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
