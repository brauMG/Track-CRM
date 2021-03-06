@extends('layout.app')

@section('title', ' | Calendario')

@section('styles')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ url('theme/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
    <style>
        .external-event {
            cursor: pointer !important;
        }
    </style>
@endsection

@section('content')

    <section class="content-header">
        <h1>
            Calendario
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li class="active">Calendario</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Tareas</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @if($countPending)
                                <div class="external-event bg-light-blue">Tareas pendientes ({{$countPending}})</div>
                            @endif

                            @if($countInProgress)
                                <div class="external-event bg-yellow">Tareas en progreso ({{$countInProgress}})</div>
                            @endif

                            @if($countFinished)
                                <div class="external-event bg-green">Tareas finalizadas ({{$countFinished}})</div>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('pages.calendar.includes.event_modal')

    <!-- fullCalendar -->
    <script src="{{ url('theme/bower_components/moment/moment.js') }}" defer></script>
    <script src="{{ url('theme/bower_components/fullcalendar/dist/fullcalendar.min.js') }}" defer></script>

    <?php echo $events_js_script ?>

    <script type="text/javascript" src="{{ url('theme/views/calendar/fullcalendar.js') }}" defer></script>

@endsection
