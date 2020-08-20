<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($campaign->name) ? $campaign->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('target_description') ? 'has-error' : ''}}">
    <label for="target_description" class="control-label">{{ 'Público Objetivo' }}</label>
    <input class="form-control" name="target_description" type="text" id="target_description" value="{{ isset($campaign->target_description) ? $campaign->target_description : ''}}" required>
    {!! $errors->first('target_description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('last_day') ? 'has-error' : ''}}">
    <label for="last_day" class="control-label">{{ 'Fecha final' }}</label>
    <input class="form-control" name="last_day" type="date" id="last_day" value="{{ isset($campaign->last_day) ? $campaign->last_day : ''}}" required>
    {!! $errors->first('last_day', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('investment') ? 'has-error' : ''}}">
    <label for="investment" class="control-label">{{ 'Inversión Realizada' }}</label>
    <input class="form-control" name="investment" type="number" id="investment" value="{{ isset($campaign->investment) ? $campaign->investment : ''}}" required>
    {!! $errors->first('investment', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
