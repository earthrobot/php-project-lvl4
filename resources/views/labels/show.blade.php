@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.labels_show_page_title') }} "{{ $label->name }}"</h1>

<p>{{ __('messages.label_table_id') }}: {{ $label->id }}</p>
<p>{{ __('messages.label_table_name') }}: {{ $label->name }}</p>
@if($label->description)
<p>{{ __('messages.label_table_description') }}: {{ $label->description }}</p>
@endif
<p>{{ __('messages.label_table_created_at') }}: {{ $label->created_at }}</p>
<p>{{ __('messages.label_table_actions') }}:</p>
<a class="text-danger" href="{{ route('labels.destroy', $label) }}" data-confirm="Вы уверены?" data-method="delete">{{ __('messages.delete_link') }}</a>
<a href="{{ route('labels.edit', $label) }}">{{ __('messages.edit_link') }}</a>
@endsection