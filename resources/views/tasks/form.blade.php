<div class="form-group">
    {{ Form::label('name', __('messages.name_label'), ['class' => 'control-label']) }}
    {{ Form::text('name', $task->name ?? null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('description', __('messages.description_label'), ['class' => 'control-label']) }}
    {{ Form::textarea('description', $task->description ?? null, ['class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control']) }}
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('status_id', __('messages.status_label'), ['class' => 'control-label']) }}
    {{ Form::select('status_id', $task_statuses, null, ['placeholder' => '----------','class' => $errors->has('status_id') ? 'form-control is-invalid' : 'form-control']) }}
    @error('status_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('assigned_to_id', __('messages.assigned_to_label'), ['class' => 'control-label']) }}
    {{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------','class' => $errors->has('assigned_to_id') ? 'form-control is-invalid' : 'form-control']) }}
    @error('assigned_to_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('labels', __('messages.labels_label'), ['class' => 'control-label']) }}
    {{ Form::select('labels[]', $labels, null, ['multiple', 'placeholder' => '','class' => $errors->has('labels[]') ? 'form-control is-invalid' : 'form-control']) }}
    @error('labels[]')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>