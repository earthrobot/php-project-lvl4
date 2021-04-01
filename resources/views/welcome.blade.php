@extends('layouts.app')

@section('content')
<div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ __('messages.hexlet_says_hi') }}</h1>
            <p class="lead">Практические курсы по программированию</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg" href="https://hexlet.io" role="button">{{ __('messages.more') }}</a>
        </div>
    </div>
@endsection
