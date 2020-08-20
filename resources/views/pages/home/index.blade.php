@extends('layout.app')

@section('title', ' | Tablero')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tablero
            <small>Panel de Control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Tablero</li>
        </ol>
    </section>

    <section class="content">

    @if(\Auth::user()->is_admin == 1)
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Cuentas Generales</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                        @if(count(getContacts()) > 0)
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>{{ count(getContacts()) }}</h3>

                                        <p>Contactos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag" style="padding-top: 16%"></i>
                                    </div>
                                    <a href="{{ url('admin/contacts') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        @endif

                        @if(count(getContacts('Lead')) > 0)
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{count(getContacts('Lead'))}}</h3>

                                        <p>Prospectos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars" style="padding-top: 16%"></i>
                                    </div>
                                    <a href="{{ url('admin/contacts?status_name=Prospecto') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        @endif

                        @if(count(getContacts('Opportunity')) > 0)
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>{{count(getContacts('Opportunity'))}}</h3>

                                        <p>Oportunidades</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add" style="padding-top: 16%"></i>
                                    </div>
                                    <a href="{{ url('admin/contacts?status_name=Oportunidad') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        @endif

                        @if(count(getContacts('Customer')) > 0)
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>{{count(getContacts('Customer'))}}</h3>

                                        <p>Clientes</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph" style="padding-top: 16%"></i>
                                    </div>
                                    <a href="{{ url('admin/contacts?status_name=Cliente') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        @endif
                    </div>
                    </div>
                </section>
            </div>

            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>

                            <h3 class="box-title">Mis Cuentas</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                        @if(user_can("list_contacts"))

                            @if(\Auth::user()->contacts->count() > 0)
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-aqua" style="background-color: #004863 !important;">
                                        <div class="inner">
                                            <h3>{{ \Auth::user()->contacts->count() }}</h3>

                                            <p>Mis Contactos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag" style="padding-top: 16%; color: rgba(255,255,255,0.47) !important;"></i>
                                        </div>
                                        <a href="{{ url('admin/contacts') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            @endif

                            @if(\Auth::user()->leads->count() > 0)
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-green" style="background-color: #006331 !important;">
                                        <div class="inner">
                                            <h3>{{ \Auth::user()->leads->count() }}</h3>

                                            <p>Mis Prospectos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars" style="padding-top: 16%; color: rgba(255,255,255,0.47) !important;"></i>
                                        </div>
                                        <a href="{{ url('admin/contacts?status_name=Prospecto') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            @endif

                            @if(\Auth::user()->opportunities->count() > 0)
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-yellow" style="background-color: #f38219 !important;">
                                        <div class="inner">
                                            <h3>{{ \Auth::user()->opportunities->count() }}</h3>

                                            <p>Mis Oportunidades</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add" style="padding-top: 16%; color: rgba(255,255,255,0.47) !important;"></i>
                                        </div>
                                        <a href="{{ url('admin/contacts?status_name=Oportunidad') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            @endif

                            @if(\Auth::user()->customers->count() > 0)
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-red" style="background-color: #5a0000  !important;">
                                        <div class="inner">
                                            <h3>{{ \Auth::user()->customers->count() }}</h3>

                                            <p>Mis Clientes</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph" style="padding-top: 16%; color: rgba(255,255,255,0.47) !important;"></i>
                                        </div>
                                        <a href="{{ url('admin/contacts?status_name=Cliente') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            @endif

                        @endif
                        </div>
                    </div>
                </section>
            </div>

            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>

                            @if(\Auth::user()->is_super_admin == 1)
                                <h3 class="box-title">Usuarios del Sistema</h3>
                            @else
                                <h3 class="box-title">Mi Equipo</h3>
                            @endif

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Id. Compañia</th>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Posición</th>
                                    <th>Contactos</th>
                                    <th>Tareas</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(\Auth::user()->is_super_admin == 1)
                                @foreach(getUsers() as $user)
                                    <tr>
                                        <td>{{ $user->company_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->position_title }}</td>
                                        <td><a href="{{ url('admin/contacts?assigned_user_id=' . $user->id) }}">{{ $user->contacts->count() }}</a></td>
                                        <td><a href="{{ url('admin/tasks?assigned_user_id=' . $user->id) }}">{{ $user->tasks->count() }}</a></td>
                                        <td><a href="{{ url('admin/users/' . $user->id) }}" data-toggle="tooltip" title="ver detalles"><i class="fa fa-cog"></i></a></td>
                                    </tr>
                                @endforeach
                                @else
                                    @foreach(getUsersAdmin() as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->position_title }}</td>
                                            <td><a href="{{ url('admin/contacts?assigned_user_id=' . $user->id) }}">{{ $user->contacts->count() }}</a></td>
                                            <td><a href="{{ url('admin/tasks?assigned_user_id=' . $user->id) }}">{{ $user->tasks->count() }}</a></td>
                                            <td><a href="{{ url('admin/users/' . $user->id) }}" data-toggle="tooltip" title="view details"><i class="fa fa-cog"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.box -->
                </section>
            </div>

            @if(user_can("list_tasks"))
                <div class="row">
                    <section class="col-lg-12 connectedSortable ui-sortable">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">Mis Tareas</h3>

                            </div>

                            <div class="box-body table-responsive">
                                <ul class="todo-list">
                                    @foreach(\Auth::user()->tasks as $task)
                                        <li>
                                            <span class="handle ui-sortable-handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <span class="text">{{ $task->name }}</span>


                                            @if($task->getStatus->name == 'Not Started')
                                                <small class="label label-warning">Sin empezar</small>
                                            @elseif($task->getStatus->name == 'Started')
                                                <small class="label label-info">Empezadas</small>
                                            @elseif($task->getStatus->name == 'Completed')
                                                <small class="label label-success">Completadas</small>
                                            @else
                                                <small class="label label-danger">Canceladas</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            @endif

        @else
            <div class="row">
                @if(user_can("list_contacts"))

                    @if(\Auth::user()->contacts->count() > 0)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ \Auth::user()->contacts->count() }}</h3>

                                    <p>Mis Contactos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    @endif

                    @if(\Auth::user()->leads->count() > 0)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{ \Auth::user()->leads->count() }}</h3>

                                    <p>Mis Prospectos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Prospecto') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    @endif

                    @if(\Auth::user()->opportunities->count() > 0)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>{{ \Auth::user()->opportunities->count() }}</h3>

                                    <p>Mis Oportunidades</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Oportunidad') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    @endif

                    @if(\Auth::user()->customers->count() > 0)
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{ \Auth::user()->customers->count() }}</h3>

                                    <p>Mis Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph" style="padding-top: 16%"></i>
                                </div>
                                <a href="{{ url('admin/contacts?status_name=Cliente') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    @endif

                @endif
            </div>

            @if(user_can("list_tasks"))
                <div class="row">
                    <section class="col-lg-12 connectedSortable ui-sortable">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">Tareas</h3>

                            </div>

                            <div class="box-body table-responsive">
                                <ul class="todo-list">
                                    @foreach(\Auth::user()->tasks as $task)
                                        <li>
                                            <span class="handle ui-sortable-handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <span class="text">{{ $task->name }}</span>


                                            @if($task->getStatus->name == 'Not Started')
                                                <small class="label label-warning">Sin empezar</small>
                                            @elseif($task->getStatus->name == 'Started')
                                                <small class="label label-info">Empezadas</small>
                                            @elseif($task->getStatus->name == 'Completed')
                                                <small class="label label-success">Completadas</small>
                                            @else
                                                <small class="label label-danger">Canceladas</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
        @endif

    </section>
@stop
