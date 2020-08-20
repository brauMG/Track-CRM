@extends('layout.app')

@section('title', ' | Lista de Campañas')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true" style="padding-top: 15%"></div>
    <section class="content-header">
        <h1>
            Campañas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li class="active">Lista de Campañas</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ url('/admin/campaigns/create') }}" class="btn btn-success btn-sm pull-right" title="Add New">
                            <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nueva Campaña
                        </a>

                        <form method="GET" action="{{ url('/admin/campaigns') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                    <th>Público Objetivo</th>
                                    <th>Inversión Realizada</th>
                                    <th>Fecha Final</th>
                                    <th>Contactos Alcanzados</th>
                                    <th>Formulario de Ingreso de Datos</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaigns as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->target_description }}</td>
                                        <td>{{ $item->investment }}</td>
                                        <td>{{ $item->last_day }}</td>
                                        <td>{{ $item->contacts_reached }}</td>
                                        <td>
                                            <a class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="bottom" title="Copia el vinculo que puedes compartir con los clientes" clave="{{$item->id}}" onclick="seeLink(this);"><i class="fa fa-clipboard" aria-hidden="true"></i> Ver Vinculo</a>
{{--                                            <textarea id="customerLink" class="form-group" type="text" style="opacity: 0.01; height: 0; position: absolute; z-index: -1">http://192.168.66.10/guest/campaigns/quiz/{{$item->id}}</textarea>--}}
{{--                                            <textarea id="customerLink" type="text" style="opacity: 0.01; height: 0; position: absolute; z-index: -1">https://crm-track.com/guest/campaigns/quiz/{{$item->id}}</textarea>--}}
                                            <a data-toggle="tooltip" data-placement="top" title="Mira el formulario (solo vista)" href="{{ url('/admin/campaigns/quiz/' . $item->id) }}"><button class="btn btn-warning btn-sm"><i class="fa fa-file-text" aria-hidden="true"></i> Formulario</button></a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/campaigns/' . $item->id) }}" title="View role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/campaigns/' . $item->id . '/edit') }}" title="Edit role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/campaigns/delete' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete role" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $campaigns->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function copy() {
            var copyText = document.getElementById("CopyURL");
            copyText.select();
            document.execCommand("copy");
            swal("Vinculo copiado","ahora puedes compartirlo con los contactos", "success");
        }

        function seeLink(button){
            var clave = $(button).attr('clave');
            $('#myModal').load( '{{ url('/admin/campaigns/seeLink') }}/'+clave,function(response, status){
                if ( status === "success" ) {
                    $('#myModal').modal('show');
                }
            } );
        }
    </script>
    </section>
@endsection
