@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.tasks_show_page_title') }} {{ $task->name }}
    @auth
        <a href="{{ route('tasks.edit', $task) }}">⚙</a>
    @endauth
</h1>

<p>{{ __('messages.task_name') }}: {{ $task->name }}</p>
<p>{{ __('messages.task_status') }}: {{ $task->status->name }}</p>
<p>{{ __('messages.task_description') }}: {{ $task->description }}</p>
@if ($task->labels)
    <p>{{ __('messages.task_labels') }}:</p>
    <ul>
    @foreach ($task->labels as $label)
        <li>{{ $label->name }}</li>
    @endforeach
    </ul>
@endif
@endsection