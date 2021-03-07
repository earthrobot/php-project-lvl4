@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.labels_show_page_title') }} "{{ $label->name }}"</h1>

<table class="table mt-2">
    <thead>
        <tr>
        <th>{{ __('messages.label_table_id') }}</th>
            <th>{{ __('messages.label_table_name') }}</th>
            <th>{{ __('messages.label_table_created_at') }}</th>
            <th>{{ __('messages.label_table_actions') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $label->id }}</td>
            <td>{{ $label->name }}</td>
            <td>{{ $label->created_at }}</td>
            <td>
                <a class="text-danger" href="{{ route('labels.destroy', $label) }}" data-confirm="Вы уверены?" data-method="delete">{{ __('messages.delete_link') }}</a>
                <a href="{{ route('labels.edit', $label) }}">{{ __('messages.edit_link') }}</a>
            </td>
        </tr>
    </tbody>
</table>
@endsection