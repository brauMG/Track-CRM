@extends('layout.app')

@section('title', ' | Mostrar Patrocinador')

@section('content')

    <section class="content-header">
        <h1>
            Patrocinador #{{ $sponsor->sponsorId }}
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/inventory') }}"> Patrocinadores </a></li>
            <li class="active">Mostrar</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ URL::previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>

                        <a href="{{ url('/admin/sponsors/' . $sponsor->sponsorId . '/edit') }}" title="Edit item"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/sponsors' . '/' . $sponsor->sponsorId) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete item" onclick="return confirm('Seguro?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                @if(!empty($sponsor->image))
                                    <div class="container">
                                        <tr>
                                            <td>
                                                <img src="{{ url('uploads/sponsors/' . $sponsor->image) }}" width="200" height="200" />
                                            </td>
                                        </tr>
                                    </div>
                                @endif

                                <tr>
                                    <th>ID</th><td>{{ $sponsor->sponsorId }}</td>
                                </tr>
                                <tr><th> Nombre </th><td> {{ $sponsor->name }} </td>
                                <tr><th> Descripción </th><td> {{ $sponsor->description }} </td>
                                <tr><th> Link </th><td> {{ $sponsor->link }} </td>
                                <tr><th> En Inicio </th><td><i class="fa fa-eye"></i><strong>@if($sponsor->show == true) Si @else No @endif</strong> </td>
                                <tr class="">
                                    <th id='head' class="th-card"><i class="fa fa-clipboard-check"></i> Compañias Asignadas</th>
                                    <td class="td-card">
                                        @foreach ($companies as $company)
                                            @if($company['id'] == 2)
                                                <div class="form-check">
                                                    <input class="form-check-input label-size" type="hidden" name="companies[{{$company['name']}}]" value="{{ $company['id'] }}" checked>
                                                </div>
                                            @elseif($company['id'] == 1)
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input label-size" type="checkbox" name="companies[{{$company['name']}}]" value="{{ $company['id'] }}" disabled checked>
                                                    <label class="form-check-label label-size" for="defaultCheck1">{{ $company['name'] }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                        @error('companies')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
