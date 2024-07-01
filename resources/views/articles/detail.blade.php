@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-2 border-success">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                <div class="card-subtitle text-muted small mb-2">{{ $article->created_at->diffForHumans() }}</div>
                <p class="card-text">{{ $article->body }}</p>
            </div>
        </div>
    </div>
@endsection
