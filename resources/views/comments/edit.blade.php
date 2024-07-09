@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif
        <h3 class="text-success">Update Comment</h3>
        <form action="{{url("/comments/update/$comment->id")}}" method="POST">
            @csrf
            <div class="mb-2">
                <input type="hidden" name="article_id" value="{{$comment->article->id}}">
                <textarea name="content" cols="30" rows="5" class="form-control">{{$comment->content}}</textarea>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
