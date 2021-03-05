@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.create_status') }}</h1>

{{ Form::model($taskStatus, ['url' => route('task_statuses.store')]) }}
    {{ Form::label('name', __('messages.name_label')) }}
    {{ Form::text('name') }}
    {{ Form::submit(__('messages.create_button')) }}
{{ Form::close() }}

@endsection