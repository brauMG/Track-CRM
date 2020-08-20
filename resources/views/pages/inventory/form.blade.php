<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($inventory->name) ? $inventory->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
@if(isset($inventory->image) && !empty($inventory->image))
    <img src="{{ url('uploads/inventory/' . $inventory->image) }}" width="200" height="180"/>
@endif
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Imagen' }}</label>
    <input class="form-control" name="image" type="file" id="image" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Descripcion' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ isset($inventory->description) ? $inventory->description : ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Precio' }}</label>
    <input class="form-control" name="price" type="number" id="price" value="{{ isset($inventory->price) ? $inventory->price : ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
    <label for="stock" class="control-label">{{ 'Stock' }}</label>
    <input class="form-control" name="stock" type="number" id="stock" value="{{ isset($inventory->stock) ? $inventory->stock : ''}}" >
    {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
