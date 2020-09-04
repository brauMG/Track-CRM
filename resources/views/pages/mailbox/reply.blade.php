@extends('layout.app')

@section('title', ' | Bandeja | Responde mensaje')

@section('content')

    <section class="content-header">
        <h1>
            Bandeja
            @if($unreadMessages)
                <small>{{$unreadMessages}} nuevo mensaje</small>
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Tablero</a></li>
            <li><a href="{{ url('/admin/mailbox') }}"> Bandeja</a></li>
            <li class="active">Responder</li>
        </ol>
    </section>

    <section class="content with-sponsor">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ url('admin/mailbox') }}" class="btn btn-primary btn-block margin-bottom">Volver a la bandeja de entrada</a>

                @include('pages.mailbox.includes.folders_panel')
            </div>
            <div class="col-md-9">
                <form method="post" action="{{ url('admin/mailbox-reply/' . $mailbox->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Responder a {{ $mailbox->sender->name }}</h3>
                        </div>

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                    @endif

                    <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <textarea id="compose-textarea" class="form-control" name="body" style="height: 300px">
                                    {{ old("body")!=null?old("body"):"" }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Adjuntos
                                    <input type="file" name="attachments[]" multiple>
                                </div>
                                <p class="help-block">Max. {{ (int)(ini_get('upload_max_filesize')) }}M</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i> Responder</button>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('scripts')

    <script>
        $(function () {
            //Add text editor
            $("#compose-textarea").wysihtml5();
        });
    </script>

@endsection
