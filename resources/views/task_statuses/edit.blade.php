@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.edit_status') }} #{{ $taskStatus->id }}</h1>

{{ Form::model($taskStatus, ['url' => route('task_statuses.show', $taskStatus), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('task_statuses.form')
    {{ Form::submit(__('messages.update_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection