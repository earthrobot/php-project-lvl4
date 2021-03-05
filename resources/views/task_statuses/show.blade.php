@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.statuses_show_page_title') }} "{{ $taskStatus->name }}"</h1>

<table class="table mt-2">
    <thead>
        <tr>
        <th>{{ __('messages.status_table_id') }}</th>
            <th>{{ __('messages.status_table_name') }}</th>
            <th>{{ __('messages.status_table_created_at') }}</th>
            <th>{{ __('messages.status_table_actions') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $taskStatus->id }}</td>
            <td>{{ $taskStatus->name }}</td>
            <td>{{ $taskStatus->created_at }}</td>
            <td>
                <a class="text-danger" href="{{ route('task_statuses.destroy', $taskStatus) }}" data-confirm="Вы уверены?" data-method="delete">{{ __('messages.delete_link') }}</a>
                <a href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('messages.edit_link') }}</a>
            </td>
        </tr>
    </tbody>
</table>

@endsection