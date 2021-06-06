@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.statuses_show_page_title') }} "{{ $taskStatus->name }}"</h1>

<p>{{ __('messages.status_table_id') }}: {{ $taskStatus->id }}</p>
<p>{{ __('messages.status_table_name') }}: {{ $taskStatus->name }}</p>
<p>{{ __('messages.status_table_created_at') }}: {{ $taskStatus->created_at }}</p>
<p>{{ __('messages.status_table_actions') }}:</p>
<a class="text-danger" href="{{ route('task_statuses.destroy', $taskStatus) }}" data-confirm="{{ __('messages.delete_confirm') }}" data-method="delete">{{ __('messages.delete_link') }}</a>
<a href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('messages.edit_link') }}</a>
@endsection
