@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.tasks_index_page_title') }}</h1>

<div class="d-flex">
    <div>
        {{ Form::model($tasks, ['url' => route('tasks.index'), 'method' => 'GET', 'class' => 'form-inline']) }}
            {{ Form::select('filter[status_id]', $task_statuses, $filter['status_id'] ?? null, ['placeholder' => 'Статус','class' => 'form-control mr-2']) }}
            {{ Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' => 'Автор','class' => 'form-control mr-2']) }}
            {{ Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => 'Исполнитель','class' => 'form-control mr-2']) }}
            {{ Form::submit(__('Применить'), ['class' => 'btn btn-outline-primary mr-2']) }}
        {{ Form::close() }}
    </div>
    @auth
        <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">{{ __('messages.create_task') }}</a>
    @endauth
</div>
<table class="table mt-2">
    <thead>
        <tr>
            <th>{{ __('messages.task_table_id') }}</th>
            <th>{{ __('messages.task_table_status') }}</th>
            <th>{{ __('messages.task_table_name') }}</th>
            <th>{{ __('messages.task_table_created_by') }}</th>
            <th>{{ __('messages.task_table_assigned_to') }}</th>
            <th>{{ __('messages.task_table_created_at') }}</th>
            @auth
            <th>{{ __('messages.task_table_actions') }}</th>
            @endauth
        </tr>
    </thead>
    <tbody>
        @forelse ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                <td>{{ $task->createdBy->name }}</td>
                <td>{{ $task->assignedTo->name ?? '' }}</td>
                <td>{{ $task->toArray()['created_at'] }}</td>
                @can('update', $task)
                <td>
                    @can('delete', $task)
                    <a class="text-danger" href="{{ route('tasks.destroy', $task), false }}" data-confirm="{{ __('messages.confirm_action') }}" data-method="delete" rel="nofollow">{{ __('messages.delete_link') }}</a>
                    @endcan
                    <a href="{{ route('tasks.edit', $task) }}">{{ __('messages.edit_link') }}</a>
                </td>
                @endcan
            </tr>
        @empty
            <tr><td>{{ __('messages.task_table_no_data') }}</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
