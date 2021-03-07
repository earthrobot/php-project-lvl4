@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.create_label') }}</h1>

{{ Form::model($label, ['url' => route('labels.store'), 'class' => 'w-50']) }}
    <div class="form-group">
    {{ Form::label('name', __('messages.name_label'), ['class' => 'control-label']) }}
    {{ Form::text('name', '', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('description', __('messages.description_label'), ['class' => 'control-label']) }}
    {{ Form::textarea('description', '', ['class' => 'form-control']) }}
    </div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    {{ Form::submit(__('messages.create_button'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection