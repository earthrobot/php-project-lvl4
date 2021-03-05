@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.edit_status') }} #{{ $taskStatus->id }}</h1>

{{ Form::model($taskStatus, ['url' => route('task_statuses.show', $taskStatus), 'method' => 'PATCH']) }}
    {{ Form::label('name', __('messages.name_label')) }}
    {{ Form::text('name') }}
    {{ Form::submit(__('messages.update_button')) }}
{{ Form::close() }}

@endsection