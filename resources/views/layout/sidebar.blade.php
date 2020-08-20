<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(\Auth::user()->image != null)
                    <img src="{{ url('uploads/users/' . \Auth::user()->image) }}" class="img-circle" alt="User Image">
                @else
                    <img src="{{ url('theme/dist/img/image_placeholder.png') }}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">NAVEGADOR PRINCIPAL</li>
            <li class="{{ Request::segment(2) == ""?"active":"" }}">
                <a href="{{ url('/admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Tablero</span>
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->is_super_admin == 1)
                <li class="{{ in_array(Request::segment(2), ['companies', 'admins'])?"active":"" }} treeview">
                    <a href="#">
                        <i class="fa fa-trademark"></i> <span>Compañias</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(2) == "companies"?"active":"" }}">
                            <a href="{{ url('/admin/companies') }}"><i class="fa fa-list"></i> Lista de Compañias</a>
                        </li>

                        <li class="{{ Request::segment(2) == "admins"?"active":"" }}">
                            <a href="{{ url('/admin/admins') }}"><i class="fa fa-address-book"></i> Lista de Administradores</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(user_can('list_contacts'))
                <li class="treeview {{ Request::segment(2) == 'contacts'? 'active':'' }}">
                    <a href="#">
                        <i class="fa fa-address-card"></i> <span>Cuentas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(2) == "contacts" && request('status_name') == null?"active":"" }}">
                            <a href="{{ url('/admin/contacts') }}"><i class="fa fa-list"></i> Todos los contactos</a>
                        </li>
                        <li class="{{ Request::segment(2) == "contacts" && request('status_name') == 'Prospecto'?"active":"" }}">
                            <a href="{{ url('/admin/contacts?status_name=Prospecto') }}"><i class="fa fa-leaf"></i> Prospectos</a>
                        </li>
                        <li class="{{ Request::segment(2) == "contacts" && request('status_name') == 'Oportunidad'?"active":"" }}">
                            <a href="{{ url('/admin/contacts?status_name=Oportunidad') }}"><i class="fa fa-flag"></i> De Oportunidad</a>
                        </li>
                        <li class="{{ Request::segment(2) == "contacts" && request('status_name') == 'Cliente'?"active":"" }}">
                            <a href="{{ url('/admin/contacts?status_name=Cliente') }}"><i class="fa fa-user-circle"></i> Clientes</a>
                        </li>
                        <li class="{{ Request::segment(2) == "contacts" && request('status_name') == 'Cerrado'?"active":"" }}">
                            <a href="{{ url('/admin/contacts?status_name=Cerrado') }}"><i class="fa fa-ban"></i> Cerrados / Fallidos</a>
                        </li>
                    </ul>
                </li>
            @endif

{{--            @if(user_can('list_contacts'))--}}
                <li class="{{ in_array(Request::segment(2), ['inventory', 'catalogue', 'quotation'])?"active":"" }} treeview">
                    <a href="#">
                        <i class="fa fa-shopping-bag"></i> <span>Inventario</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(2) == "inventory"?"active":"" }}">
                            <a href="{{ url('/admin/inventory') }}"><i class="fa fa-archive"></i> Lista de Artículoss</a>
                        </li>

                        <li class="{{ Request::segment(2) == "catalogue"?"active":"" }}">
                            <a href="{{ url('/admin/catalogue') }}"><i class="fa fa-shopping-cart"></i> Lista de Catalogos</a>
                        </li>

                        <li class="{{ Request::segment(2) == "quotation"?"active":"" }}">
                            <a href="{{ url('/admin/quotation') }}"><i class="fa fa-money"></i> Cotizaciones</a>
                        </li>
                    </ul>
                </li>
{{--            @endif--}}

            {{--            @if(user_can('list_contacts'))--}}
            <li class="{{ in_array(Request::segment(2), ['campaigns', 'marketing', 'import'])?"active":"" }} treeview">
                <a href="#">
                    <i class="fa fa-dollar"></i> <span>Campañas y Marketing</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(2) == "campaigns"?"active":"" }}">
                        <a href="{{ url('/admin/campaigns') }}"><i class="fa fa-balance-scale"></i> Lista de Campañas</a>
                    </li>

                    <li class="{{ Request::segment(2) == "marketing"?"active":"" }}">
                        <a href="{{ url('/admin/marketing') }}"><i class="fa fa-mail-forward"></i> Marketing de Campañas</a>
                    </li>

                    <li class="{{ Request::segment(2) == "import"?"active":"" }}">
                        <a href="{{ url('/admin/import') }}"><i class="fa fa-users"></i> Importar Cuentas</a>
                    </li>
                </ul>
            </li>
            {{--            @endif--}}

            @if(user_can('list_documents'))
                <li class="{{ Request::segment(2) == "documents"?"active":"" }}">
                    <a href="{{ url('/admin/documents') }}">
                        <i class="fa fa-file-word-o"></i> <span>Documentos</span>
                    </a>
                </li>
            @endif

            @if(user_can('list_tasks'))
                <li class="{{ Request::segment(2) == "tasks"?"active":"" }}">
                    <a href="{{ url('/admin/tasks') }}">
                        <i class="fa fa-tasks"></i> <span>Tareas</span>
                    </a>
                </li>
            @endif

            @if(user_can('list_emails') || user_can('compose_email'))
                <li class="treeview {{ Request::segment(2) == 'mailbox' || strpos(Request::segment(2), "mailbox")!==FALSE? 'active':'' }}">
                    <a href="#">
                        <i class="fa fa-envelope"></i> <span>Correos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(user_can('list_emails'))
                            <li class="{{ Request::segment(2) == "mailbox"?"active":"" }}">
                                <a href="{{ url('/admin/mailbox') }}">
                                    Bandeja de Entrada
                                    @if(count(getUnreadMessages()) > 0)
                                        <span class="pull-right-container">
                                            <span class="label label-primary pull-right">{{count(getUnreadMessages())}}</span>
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if(user_can('compose_email'))
                            <li class="{{ Request::segment(2) == "mailbox-create"?"active":"" }}">
                                <a href="{{ url('/admin/mailbox-create') }}">
                                    Crear Nuevo Mensaje
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(user_can('show_calendar'))
                <li class="{{ Request::segment(2) == "calendar"?"active":"" }}">
                    <a href="{{ url('/admin/calendar') }}">
                        <i class="fa fa-calendar"></i> <span>Calendario</span>
                    </a>
                </li>
            @endif

            @if(\Auth::user()->is_admin == 1)
                <li class="{{ in_array(Request::segment(2), ['users', 'permissions', 'roles'])?"active":"" }} treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Usuarios</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(2) == "users"?"active":"" }}">
                            <a href="{{ url('/admin/users') }}"><i class="fa fa-user-o"></i> Lista de Usuarios</a>
                        </li>

                        <li class="{{ Request::segment(2) == "permissions"?"active":"" }}">
                            <a href="{{ url('/admin/permissions') }}"><i class="fa fa-ban"></i> Permisos</a>
                        </li>
                        <li class="{{ Request::segment(2) == "roles"?"active":"" }}">
                            <a href="{{ url('/admin/roles') }}"><i class="fa fa-list"></i> Roles</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
