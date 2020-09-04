@extends('layout.app')

@section('title', ' | Mostrar Campaña')

@section('content')

    <section class="content-header">
        <h1>
            Campaña #{{ $campaign->id }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/campaigns') }}">Campañas</a></li>
            <li class="active">Mostrar</li>
        </ol>
    </section>


    <div class="row">
        <section class="col-lg-12 connectedSortable ui-sortable">
            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Cuentas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $total_contacts_reached }}</h3>

                                    <p>Contactos - Alcanzados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{ $leads_contacts_reached }}</h3>

                                    <p>Contactos - Prospectos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Prospecto') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>{{ $opportunity_contacts_reached }}</h3>

                                    <p>Contactos - Oportunidad</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Oportunidad') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{ $customers_contacts_reached }}</h3>

                                    <p>Contactos - Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Cliente') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{ $close_contacts_reached }}</h3>

                                    <p>Contactos - Cerrados/Fallidos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-close-circled" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Cerrado') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                </div>
            </div>
        </section>
    </div>
    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/campaigns') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <a href="{{ url('/admin/campaigns/' . $campaign->id . '/edit') }}" title="Edit campaign"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/campaigns/delete' . '/' . $campaign->id) }}" accept-charset="UTF-8" style="display:inline">
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
                                    <th>ID</th>
                                    <td>
                                        {{ $campaign->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <td>
                                        {{ $campaign->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Público Objetivo</th>
                                    <td>
                                        {{ $campaign->target_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha Final</th>
                                    <td>
                                        {{ $campaign->last_day }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Inversión Realizada</th>
                                    <td>
                                        {{ $campaign->investment }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Creada el</th>
                                    <td>
                                        {{ $campaign->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Actualizada el</th>
                                    <td>
                                        {{ $campaign->updated_at }}
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
