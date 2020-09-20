<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="name" type="text" id="name">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" name="description" type="text" id="description" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="input-group-prepend" style="padding-bottom: 1% !important;">
    <div class="input-group-text"><i class="fa fa-bookmark"> <a style="color: #195858; font-family: 'Source Sans Pro', sans-serif; font-size: 14px"><strong>Articulos</strong></a></i></div>
</div>
<div class="form-group {{ $errors->has('items') ? 'has-error' : ''}}">
    <select class="selectpicker pull-left" name="items[]" type="text" multiple data-live-search="true" data-style="btn-success" data-actions-box="true" data-width="50%">
        @foreach($items as $item)
            <option value="{{$item->id}}">#{{$item->id}} - {{$item->name}} - {{$item->stock}} en existencia</option>
        @endforeach
    </select>
</div>

<br>
<br>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Crear">
</div>
