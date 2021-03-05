@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.statuses_index_page_title') }}</h1>

@auth
<a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('messages.create_status') }}</a>
@endauth
<table class="table mt-2">
    <thead>
        <tr>
            <th>{{ __('messages.status_table_id') }}</th>
            <th>{{ __('messages.status_table_name') }}</th>
            <th>{{ __('messages.status_table_created_at') }}</th>
            @auth
            <th>{{ __('messages.status_table_actions') }}</th>
            @endauth
        </tr>
    </thead>
    <tbody>
        @forelse ($taskStatuses as $taskStatus)
            <tr>
                <td>{{ $taskStatus->id }}</td>
                <td>{{ $taskStatus->name }}</td>
                <td>{{ $taskStatus->created_at }}</td>
                @auth
                <td>
                    <a class="text-danger" href="{{ route('task_statuses.destroy', $taskStatus), false }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">{{ __('messages.delete_link') }}</a>
                    <a href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('messages.edit_link') }}</a>
                </td>
                @endauth
            </tr>
        @empty
            <tr><td>{{ __('messages.status_table_no_data') }}</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
