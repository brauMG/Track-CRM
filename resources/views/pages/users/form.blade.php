<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Correo electrónico' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode == 'create')
    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
        <label for="password" class="control-label">{{ 'Contraseña' }}</label>
        <input class="form-control" name="password" type="password" id="password" value="{{ isset($user->password) ? $user->password : ''}}" >
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
@endif
<div class="form-group {{ $errors->has('position_title') ? 'has-error' : ''}}">
    <label for="position_title" class="control-label">{{ 'Posición' }}</label>
    <input class="form-control" name="position_title" type="text" id="position_title" value="{{ isset($user->position_title) ? $user->position_title : ''}}" >
    {!! $errors->first('position_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Teléfono' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($user->phone) ? $user->phone : ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>

@if(isset($user->image) && !empty($user->image))
    <img src="{{ url('uploads/users/' . $user->image) }}" width="200" height="180"/>
@endif

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Imagen' }}</label>
    <input class="form-control" name="image" type="file" id="image" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode == 'create' || ($formMode == 'edit' && $user->is_admin == 0))
    <div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
        <label for="is_active" class="control-label">
            <input type="checkbox" name="is_active" id="is_active" value="1" class="minimal" {{ $formMode == 'create'?"checked":($user->is_active == 1?"checked":"") }}>
            {{ 'Activo / Baneado' }}
        </label>
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
@endif

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
