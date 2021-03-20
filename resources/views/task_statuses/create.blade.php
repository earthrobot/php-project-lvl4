@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.create_status') }}</h1>

{{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
    @include('task_statuses.form')
    {{ Form::submit(__('messages.create_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection