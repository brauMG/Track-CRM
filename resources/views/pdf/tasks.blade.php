@extends('layouts.pdf')
@section('content')
        <div class="text-center" style="margin-left: -4% !important;">
            <table class="table table-bordered">
                <thead class="table-header" style="font-size: 0.5em !important; background-color: #c6e2f5 !important; color: black !important; vertical-align: middle !important;">
                <tr>
                    <th scope="col" style="text-transform: uppercase">Nombre</th>
                    <th scope="col" style="text-transform: uppercase">Prioridad</th>
                    <th scope="col" style="text-transform: uppercase">Estado</th>
                    <th scope="col" style="text-transform: uppercase">Tipo</th>
                    <th scope="col" style="text-transform: uppercase">Usuario Asignado</th>
                    <th scope="col" style="text-transform: uppercase">De Contacto</th>
                    <th scope="col" style="text-transform: uppercase">Estado De Contacto</th>
                    <th scope="col" style="text-transform: uppercase">Descripción</th>
                    <th scope="col" style="text-transform: uppercase">Creada El</th>
                    <th scope="col" style="text-transform: uppercase">Fecha Inicial</th>
                    <th scope="col" style="text-transform: uppercase">Fecha Final</th>
                    <th scope="col" style="text-transform: uppercase">Terminada El</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tareas as $item)
                    <tr id="{{$item->id}}">
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->name}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->priority}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->task_status}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->task_type}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->user}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->first_name.' '.$item->last_name}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->contact_status}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->description}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->created_at}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->start_date}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->end_date}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->complete_date}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
