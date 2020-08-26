@extends('layouts.pdf')
@section('content')
        <div class="text-center" style="margin-left: -4% !important;">
            <table class="table table-bordered">
                <thead class="table-header" style="font-size: 0.5em !important; background-color: #c6e2f5 !important; color: black !important; vertical-align: middle !important;">
                <tr>
                    <th scope="col" style="text-transform: uppercase">Nombre</th>
                    <th scope="col" style="text-transform: uppercase">Correo Electrónico</th>
                    <th scope="col" style="text-transform: uppercase">Teléfono</th>
                    <th scope="col" style="text-transform: uppercase">Campaña</th>
                    <th scope="col" style="text-transform: uppercase">Usuario Asignado</th>
                    <th scope="col" style="text-transform: uppercase">Estado</th>
                    <th scope="col" style="text-transform: uppercase">Creado El</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contactos as $item)
                    <tr id="{{$item->id}}">
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->first_name." ".$item->middle_name." ".$item->last_name}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->contactEmail}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->contactPhone}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->campaign}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->user}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->contactStatus}}
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
