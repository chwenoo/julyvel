@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4 border-primary">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                <div class="card-subtitle text-muted small mb-2">
                    Category : <b>{{ $article->category->name }}</b> ,
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        <ul class="list-group mb-2">
            <li class="list-group-item active">Comments ({{ count($article->comments) }})</li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    {{ $comment->content }}
                    <a href="{{url("/comments/delete/$comment->id")}}" class="btn btn-close"></a>
                </li>
            @endforeach
        </ul>

        <form action="{{url("/comments/add")}}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <textarea name="content" class="form-control mb-2" placeholder="your comment ..."></textarea>
            <button class="btn btn-sm btn-primary">Add Comment</button>
        </form>
    </div>
@endsection
