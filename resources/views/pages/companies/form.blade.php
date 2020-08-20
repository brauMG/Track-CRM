<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($company->name) ? $company->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Correo electrónico' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($company->email) ? $company->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode == 'edit')
    <div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
        <label for="is_active" class="control-label">
            <input type="checkbox" name="is_active" id="is_active" value="1" class="minimal" @if($company->is_active == 1) checked @else @endif>
            {{ 'Activa / Baneada' }}
        </label>
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
@endif

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
