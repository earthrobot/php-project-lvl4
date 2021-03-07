@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.edit_task') }} #{{ $task->id }}</h1>

{{ Form::model($task, ['url' => route('tasks.show', $task), 'method' => 'PATCH', 'class' => 'w-50']) }}
    <div class="form-group">
    {{ Form::label('name', __('messages.name_label'), ['class' => 'control-label']) }}
    {{ Form::text('name', $task->name, ['class' => 'form-control']) }}
    </div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
    {{ Form::label('description', __('messages.description_label'), ['class' => 'control-label']) }}
    {{ Form::text('description', $task->description, ['class' => 'form-control']) }}
    </div>
    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
    {{ Form::label('status_id', __('messages.status_label'), ['class' => 'control-label']) }}
    {{ Form::select('status_id', $task_statuses, null, ['placeholder' => $task->status->name,'class' => 'form-control']) }}
    </div>
    @error('status_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
    {{ Form::label('assigned_to_id', __('messages.assigned_to_label'), ['class' => 'control-label']) }}
    {{ Form::select('assigned_to_id', $users, null, ['placeholder' => $task->assignedTo->name ?? '---------','class' => 'form-control']) }}
    </div>
    @error('assigned_to_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
    {{ Form::label('labels', __('messages.labels_label'), ['class' => 'control-label']) }}
    {{ Form::select('labels[]', $labels, null, ['multiple', 'placeholder' => '','class' => 'form-control']) }}
    </div>
    @error('labels[]')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    {{ Form::submit(__('messages.update_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@endsection