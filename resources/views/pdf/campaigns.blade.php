@extends('layouts.pdf')
@section('content')
    <div class="text-center" style="margin-left: -4% !important;">
        <table class="table table-bordered">
            <thead class="table-header" style="font-size: 0.5em !important; background-color: #c6e2f5 !important; color: black !important; vertical-align: middle !important;">
            <tr>
                <th scope="col" style="text-transform: uppercase">Nombre</th>
                <th scope="col" style="text-transform: uppercase">Descripcion</th>
                <th scope="col" style="text-transform: uppercase">Inversión</th>
                <th scope="col" style="text-transform: uppercase">Contactos Alcanzados</th>
                <th scope="col" style="text-transform: uppercase">Creada el</th>
                <th scope="col" style="text-transform: uppercase">Vence el</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($campanias as $item)
                <tr id="{{$item->id}}">
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item->name}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item->target_description}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item->investment}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item->contacts_reached}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item->created_at}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item->last_day}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
