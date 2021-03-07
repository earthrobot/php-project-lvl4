@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.edit_status') }} #{{ $taskStatus->id }}</h1>

{{ Form::model($taskStatus, ['url' => route('task_statuses.show', $taskStatus), 'method' => 'PATCH', 'class' => 'w-50']) }}
    <div class="form-group">
    {{ Form::label('name', __('messages.name_label'), ['class' => 'control-label']) }}
    {{ Form::text('name', $taskStatus->name, ['class' => 'form-control']) }}
    </div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    {{ Form::submit(__('messages.update_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@endsection