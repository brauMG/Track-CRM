@extends('layout.app')

@section('title', ' | Mi Perfil')

@section('content')

    <section class="content-header">
        <h1>
            Mi Perfil
        </h1>
    </section>


    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        @if(user_can('edit_profile'))
                            <a href="{{ url('/admin/my-profile/edit') }}" title="Edit profile"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                @if(!empty($user->image))
                                    <tr>
                                        <td>
                                            <img src="{{ url('uploads/users/' . $user->image) }}" class="pull-right" width="200" height="200" />
                                        </td>
                                    </tr>
                                @endif

                                <tr><th> Nombre </th><td> {{ $user->name }} </td>
                                </tr><tr><th> Correo Electrónico </th><td> {{ $user->email }} </td></tr>
                                <tr><th> Posición </th><td> {{ $user->position_title }} </td></tr>
                                <tr><th> Teléfono </th><td> {{ $user->phone }} </td></tr>

                                </tbody>
                            </table>

                            <hr/>

                            @if(user_can('list_documents'))
                                <h3>Documentos asignados</h3>
                                @if($user->documents->count() > 0)
                                    <table class="table">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Ver</th>
                                        </tr>
                                        <tbody>
                                        @foreach($user->documents as $document)
                                            <tr>
                                                <td>{{ $document->name }}</td>
                                                <td>
                                                    @if(user_can("view_document"))
                                                        <a href="{{ url('/admin/documents/' . $document->id) }}"><i class="fa fa-camera"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No tienes documentos asignados</p>
                                @endif
                            @endif

                            @if(user_can('list_contacts'))
                                <h3>Contactos asignados</h3>
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#contacts">
                                                        Todos los contactos
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="contacts" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    @if($user->contacts->count() > 0)
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Ver</th>
                                                            </tr>
                                                            <tbody>
                                                            @foreach($user->contacts as $contact)
                                                                <tr>
                                                                    <td>{{ $contact->getName() }}</td>
                                                                    <td>
                                                                        @if(user_can("view_contact"))
                                                                            <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn btn-info btn-sm"><i class="fa fa-camera"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>Sin contactos asignados</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#my_leads">
                                                        Mis prospectos
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="my_leads" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @if($user->leads->count() > 0)
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Ver</th>
                                                            </tr>
                                                            <tbody>
                                                            @foreach($user->leads as $contact)
                                                                <tr>
                                                                    <td>{{ $contact->getName() }}</td>
                                                                    <td>
                                                                        @if(user_can("view_contact"))
                                                                            <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn btn-info btn-sm"><i class="fa fa-camera"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No tienes prospectos</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#my_opportunities">
                                                        Mis oportunidades
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="my_opportunities" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @if($user->opportunities->count() > 0)
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Ver</th>
                                                            </tr>
                                                            <tbody>
                                                            @foreach($user->opportunities as $contact)
                                                                <tr>
                                                                    <td>{{ $contact->getName() }}</td>
                                                                    <td>
                                                                        @if(user_can("view_contact"))
                                                                            <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn btn-info btn-sm"><i class="fa fa-camera"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No tienes contactos de oportunidad</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#my_customers">
                                                        Mis clientes
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="my_customers" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @if($user->customers->count() > 0)
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Ver</th>
                                                            </tr>
                                                            <tbody>
                                                            @foreach($user->customers as $contact)
                                                                <tr>
                                                                    <td>{{ $contact->getName() }}</td>
                                                                    <td>
                                                                        @if(user_can("view_contact"))
                                                                            <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn btn-info btn-sm"><i class="fa fa-camera"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No tienes clientes</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#my_archives">
                                                        Mis archivos / Cerrados
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="my_archives" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @if($user->archives->count() > 0)
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Ver</th>
                                                            </tr>
                                                            <tbody>
                                                            @foreach($user->archives as $contact)
                                                                <tr>
                                                                    <td>{{ $contact->getName() }}</td>
                                                                    <td>
                                                                        @if(user_can("view_contact"))
                                                                            <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn btn-info btn-sm"><i class="fa fa-camera"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>Sin archivos asignados</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(user_can('list_tasks'))
                                <h3>Tareas Asignadas</h3>
                                @if($user->tasks->count() > 0)
                                    <table class="table">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Ver</th>
                                        </tr>
                                        <tbody>
                                        @foreach($user->tasks as $task)
                                            <tr>
                                                <td>{{ $task->name }}</td>
                                                <td>
                                                    @if(user_can("view_task"))
                                                        <a href="{{ url('/admin/tasks/' . $task->id) }}"><i class="fa fa-camera"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Sin tareas asignadas</p>
                                @endif
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
