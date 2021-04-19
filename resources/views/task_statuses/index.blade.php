@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.statuses_index_page_title') }}</h1>

@can('create', App\Models\TaskStatus::class)
<a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('messages.create_status') }}</a>
@endcan
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
                <td>{{ $taskStatus->toArray()['created_at'] }}</td>
                @auth
                <td>
                    @can('delete', $taskStatus)
                    <a class="text-danger" href="{{ route('task_statuses.destroy', $taskStatus), false }}" data-confirm="{{ __('messages.confirm_action') }}" data-method="delete" rel="nofollow">{{ __('messages.delete_link') }}</a>
                    @endcan
                    @can('update', $taskStatus)
                    <a href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('messages.edit_link') }}</a>
                    @endcan
                </td>
                @endauth
            </tr>
        @empty
            <tr><td>{{ __('messages.status_table_no_data') }}</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
