@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.edit_task') }} #{{ $task->id }}</h1>

{{ Form::model($task, ['url' => route('tasks.show', $task), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('tasks.form')
    {{ Form::submit(__('messages.update_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@endsection