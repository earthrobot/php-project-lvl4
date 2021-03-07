@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.tasks_show_page_title') }} {{ $task->name }}
    <a href="{{ route('tasks.edit', $task) }}">⚙</a>
</h1>

<p>{{ __('messages.task_name') }}: {{ $task->name }}</p>
<p>{{ __('messages.task_status') }}: {{ $task->status->name }}</p>
<p>{{ __('messages.task_description') }}: {{ $task->description }}</p>
@endsection