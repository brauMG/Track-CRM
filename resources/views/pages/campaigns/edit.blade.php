@extends('layout.app')

@section('title', ' | Editar Campaña')

@section('content')


    <section class="content-header">
        <h1>
            Editar Campaña #{{ $campaign->id }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/campaigns') }}">Campañas</a></li>
            <li class="active">Editar</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/campaigns') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/campaigns/update/' . $campaign->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            @include ('pages.campaigns.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
