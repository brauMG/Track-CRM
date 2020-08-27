@extends('layouts.pdf')
@section('content')
        <div class="text-center" style="margin-left: -4% !important;">
            <table class="table table-bordered">
                <thead class="table-header" style="font-size: 0.5em !important; background-color: #c6e2f5 !important; color: black !important; vertical-align: middle !important;">
                <tr>
                    <th scope="col" style="text-transform: uppercase">Nombre</th>
                    <th scope="col" style="text-transform: uppercase">Descripcion</th>
                    <th scope="col" style="text-transform: uppercase">Precio</th>
                    <th scope="col" style="text-transform: uppercase">Stock</th>
                    <th scope="col" style="text-transform: uppercase">Imagen</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($inventario as $item)
                    <tr id="{{$item->id}}">
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->name}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->description}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->price}}</td>
                        <td class="td td-center" style="font-size: 0.5em !important;">{{$item->stock}}</td>
                        <td class="td td-center" style="text-align: center;">
                            <img src="{{ url('uploads/inventory/' . $item->image) }}" width="100" height="100" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
