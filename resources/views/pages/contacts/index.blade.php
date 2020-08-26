@extends('layout.app')

@section('title', ' | Lista de Contactos')

@section('content')

    <section class="content-header">
        <h1>
            Contactos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li class="active">Contactos</li>
        </ol>
    </section>

    @if ( session('danger') )
        <div class="container-edits" style="margin-top: 2%">
            <div class="alert alert-danger" class='message' id='message'>{{ session('danger') }}</div>
        </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                            <form method="POST" action="{{ url('/admin/contacts/import') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row" style="width: 50%">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                            <span data-toggle="tooltip" data-placement="right" title="Selecciona un archivo excel que contenga las siguientes columnas, en el siguiente orden: Nombre, Apellido Paterno, Apellido Materno, Correo, Telefono" style="padding-left: 0.5%; padding-bottom: 0.5%">Archivo</span>
                                            <input class="form-control" type="file" name="file" id="file" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <span data-toggle="tooltip" data-placement="right" title="Si los usuarios pertenecen a alguna campaña, seleccionala de la lista" style="padding-left: 0.5%; padding-bottom: 0.5%">Campaña</span>
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <select type="text" class="form-control" id="campaign" name="campaign">
                                                    <option selected value="{{null}}">Ninguna</option>
                                                    @foreach($campaigns as $campaign)
                                                        <option value="{{$campaign->id}}">{{$campaign->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning btn-sm" title="Importar Contactos" style="margin-left: 5px !important;">
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar Contactos de Excel
                                </button>
                            </form>

                        @if(user_can("create_contact"))
                        <a href="{{ url('/admin/contacts/create') }}" class="btn btn-success btn-sm pull-right" title="Add New contact">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Añadir Nuevo
                                </a>
                        @endif

                        <form method="GET" action="{{ url('/admin/contacts') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                    @if(\Auth::user()->is_admin == 1)
                                        <th>#</th>
                                    @endif
                                        <th>Campaña</th>
                                        <th>Primer Nombre</th>
                                        <th>Segundo Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Estado</th>
                                    @if(\Auth::user()->is_admin == 1)
                                        <th>Creado por</th>
                                    @endif
                                        <th>Asignado a</th>
                                        <th>Creado el</th>
                                        <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $item)
                                    <tr>
                                        @if(\Auth::user()->is_admin == 1)
                                            <td>{{ $item->id }}</td>
                                        @endif
                                        <td>@if($item->getCampaign != null) {{ $item->getCampaign->name }}@else Sin Asignar @endif</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->middle_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td><i class="btn bg-maroon">{{ $item->getStatus->name }}</i></td>
                                        @if(\Auth::user()->is_admin == 1)
                                            <td>{{ $item->createdBy->name }}</td>
                                        @endif
                                        <td>{{ $item->assignedTo != null ? $item->assignedTo->name : "sin asignar" }}</td>

                                        <td>{{ $item->created_at }}</td>
                                        <td>

                                            @if(user_can('view_contact'))
                                                <a href="{{ url('/admin/contacts/' . $item->id) }}" title="View contact"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            @endif

                                            @if(user_can('edit_contact'))
                                                <a href="{{ url('/admin/contacts/' . $item->id . '/edit') }}" title="Edit contact"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            @endif

                                            @if(user_can('assign_contact'))
                                                <a href="{{ url('/admin/contacts/' . $item->id . '/assign') }}" title="Assign contact"><button class="btn btn-primary btn-sm"><i class="fa fa-envelope-o" aria-hidden="true"></i> Asignar</button></a>
                                            @endif

                                            @if(user_can('delete_contact'))
                                                <form method="POST" action="{{ url('/admin/contacts' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete contact" onclick="return confirm('Seguro?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $contacts->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
