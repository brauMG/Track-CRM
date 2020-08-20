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
<div class="form-group {{ $errors->has('items') ? 'has-error' : ''}}">
    @foreach ($items as $item)
        <div class="form-check">
            <input class="form-check-input label-size" type="checkbox" name="items[{{$item['name']}}]" value="{{ $item['id'] }}">
            <label class="form-check-label label-size" for="defaultCheck1">{{ $item['name'] }}</label>
        </div>
    @endforeach
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Crear">
</div>
