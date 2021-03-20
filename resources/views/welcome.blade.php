@extends('layouts.app')

@section('content')
<div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ config('app.name', 'Менеджер задач') }}</h1>
            <p class="lead">{{ __('messages.app_description') }}</p>
            <p>{{ __('messages.hexlet_says_hi') }}</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg" href="https://ru.hexlet.io/programs/php/projects/57" role="button">{{ __('messages.more') }}</a>
        </div>
    </div>
@endsection
