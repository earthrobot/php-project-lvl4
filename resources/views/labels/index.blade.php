@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{ __('messages.labels_index_page_title') }}</h1>

@can('create', App\Models\Label::class)
<a href="{{ route('labels.create') }}" class="btn btn-primary">{{ __('messages.create_label') }}</a>
@endcan
<table class="table mt-2">
    <thead>
        <tr>
            <th>{{ __('messages.label_table_id') }}</th>
            <th>{{ __('messages.label_table_name') }}</th>
            <th>{{ __('messages.label_table_description') }}</th>
            <th>{{ __('messages.label_table_created_at') }}</th>
            @auth
            <th>{{ __('messages.label_table_actions') }}</th>
            @endauth
        </tr>
    </thead>
    <tbody>
        @forelse ($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->toArray()['created_at'] }}</td>
                @auth
                <td>
                    @can('delete', $label)
                    <a class="text-danger" href="{{ route('labels.destroy', $label), false }}" data-confirm="{{ __('messages.confirm_action') }}" data-method="delete" rel="nofollow">{{ __('messages.delete_link') }}</a>
                    @endcan
                    @can('update', $label)
                    <a href="{{ route('labels.edit', $label) }}">{{ __('messages.edit_link') }}</a>
                    @endcan
                </td>
                @endauth
            </tr>
        @empty
            <tr><td>{{ __('messages.label_table_no_data') }}</td></tr>
        @endforelse
    </tbody>
</table>
@endsection