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
        <h3 class="text-success">Update Article</h3>
        <form action="{{url("/articles/update/$article->id")}}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{$article->title}}">
            </div>
            <div class="mb-2">
                <label for="">Body</label>
                <textarea name="body" cols="30" rows="5" class="form-control">{{$article->body}}</textarea>
            </div>
            <div class="mb-2">
                <label for="">Category</label>
                <select name="category_id" id="" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($article->category_id === $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
