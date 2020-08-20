<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($role->name) ? $role->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="row">
    <div class="col-md-12">
        <h3>Permisos Asignados</h3>

        <div class="form-group">
            <label for="select_all" class="control-label">
                <i class="btn bg-maroon">Seleccionar / Deseleccionar Todos</i>
            </label>
        </div>

        <div class="row">
            @foreach($permissions as $permission)
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="permission[{{$permission->id}}]" class="control-label">
                            <input type="checkbox" name="permissions[{{$permission->id}}]" value="1" id="select_all" {{ $formMode=="edit" && in_array($permission->id, $selected_permissions)?"checked":"" }} class="minimal-red permission">
                            {{ ucfirst(str_replace("_", " ", $permission->name)) }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
