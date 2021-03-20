@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.edit_label') }} #{{ $label->id }}</h1>

{{ Form::model($label, ['url' => route('labels.show', $label), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('labels.form')
    {{ Form::submit(__('messages.update_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@endsection