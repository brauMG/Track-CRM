<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Detalles básicos</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="name" class="control-label">{{ 'Nombre' }}</label>
                            <input class="form-control" name="name" type="text" id="name" value="{{ isset($task->name) ? $task->name : ''}}" required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('contact_type') ? 'has-error' : ''}}">
                            <label for="contact_type" class="control-label">{{ 'Tipo de contacto' }}</label>
                            <select class="form-control" name="contact_type" id="contact_type" required>
                                @foreach($contact_statuses as $contact_status)
                                    <option value="{{ $contact_status->id }}" {{ isset($task->contact_type) && $task->contact_type == $contact_status->name ? 'selected' : ''}}>{{ $contact_status->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('contact_type', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('contact_id') ? 'has-error' : ''}}">
                            <label for="contact_id" class="control-label">{{ 'Nombre del contacto' }}</label>
                            <select name="contact_id" id="contact_id" class="form-control" data-selected-value="{{ isset($task->contact_id) ? $task->contact_id : '' }}" required></select>
                            {!! $errors->first('contact_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : ''}}">
                            <label for="type_id" class="control-label">{{ 'Tipo de tarea' }}</label>
                            <select name="type_id" id="type_id" class="form-control" required>
                                @foreach($task_types as $type)
                                    <option value="{{ $type->id }}" {{ isset($task->type_id) && $task->type_id == $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                            <label for="status" class="control-label">{{ 'Estado' }}</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ isset($task->status) && $task->status == $status->id ? 'selected' : ''}}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('priority') ? 'has-error' : ''}}">
                            <label for="priority" class="control-label">{{ 'Prioridad' }}</label>
                            <select class="form-control" name="priority" id="priority" required>
                                @foreach(array('Baja', 'Normal', 'Alta', 'Urgente') as $value)
                                    <option value="{{ $value }}" {{ isset($task->priority) && $task->priority == $value ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('priority', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            <label for="description" class="control-label">{{ 'Descripción' }}</label>
                            <textarea class="form-control" name="description" type="text" id="description">{{ isset($task->description) ? $task->description : ''}}</textarea>
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Días de las tareas</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                            <label for="start_date" class="control-label">{{ 'Fecha de inicio' }}</label>
                            <input class="form-control" name="start_date" type="date" id="start_date" value="{{ isset($task->start_date) ? $task->start_date : ''}}" required>
                            {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                            <label for="end_date" class="control-label">{{ 'Fecha final' }}</label>
                            <input class="form-control" name="end_date" type="date" id="end_date" value="{{ isset($task->end_date) ? $task->end_date : ''}}" required>
                            {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('complete_date') ? 'has-error' : ''}}">
                            <label for="complete_date" class="control-label">{{ 'Día en el que se completo la tarea' }}</label>
                            <input class="form-control" name="complete_date" type="date" id="complete_date" value="{{ isset($task->complete_date) ? $task->complete_date : ''}}" >
                            {!! $errors->first('complete_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="documents" class="control-label">{{ 'Documentos' }} <i class="fa fa-link"></i></label>
    <br>
    <select class="selectpicker pull-left" name="documents[]" type="text" id="link" data-live-search="true" data-style="btn-primary" data-width="fit" multiple>
        @foreach($documents as $document)
            <option value="{{ $document->id }}" {{ isset($selected_documents) && in_array($document->id, $selected_documents)?"selected":"" }}>{{ $document->name }}</option>
        @endforeach
    </select>
    <br>
</div>

@if(\Auth::user()->is_admin == 1)
    <div class="form-group {{ $errors->has('assigned_user_id') ? 'has-error' : ''}}">
        <label for="assigned_user_id" class="control-label">{{ 'Usuario Asignado' }}</label>
        <select name="assigned_user_id" id="assigned_user_id" class="form-control">
            @foreach($users as $user)
                @if($user->id == 2)
                @else
                <option value="{{ $user->id }}" {{ isset($task->assigned_user_id) && $task->assigned_user_id == $user->id?"seleccionado":"" }}>{{ $user->name }}</option>
                @endif
            @endforeach
        </select>

        {!! $errors->first('assigned_user_id', '<p class="help-block">:message</p>') !!}
    </div>
@endif


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>

<input type="hidden" id="getContactsAjaxUrl" value="{{ url('/admin/api/contacts/get-contacts-by-status') }}" />
