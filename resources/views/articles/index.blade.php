@extends('layouts.app')

@section('content')
    <div class="container">
        {{ $articles->Links() }}

        @if(session('info'))
            <div class="alert alert-info">{{session('info')}}</div>
        @endif

        @foreach($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <div class="card-subtitle text-muted small mb-2">{{ $article->created_at->diffForHumans() }}</div>
                    <p class="card-text">{{ $article->body }}</p>
                    <a class="card-link" href="{{url("/articles/detail/$article->id")}}">view detail &raquo;</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
