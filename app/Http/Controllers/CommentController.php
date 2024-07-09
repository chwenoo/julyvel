<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        $validator = validator(request()->all(), [
            "content" => "required",
            "article_id" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back()->with('info', 'A new comment is added');
    }

    public function edit($id) {
        $comment = Comment::find($id);
        return view('comments.edit', ["comment" => $comment]);
    }

    public function update($id) {
        $comment = Comment::find($id);

        $validator = validator(request()->all(), [
            "content" => "required",
            "article_id" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (Gate::allows('comment-update', $comment)) {
            $comment->content = request()->content;
            $comment->article_id = request()->article_id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            return redirect("/articles/detail/$comment->article_id")->with('info', 'Comment is updated');
        } else {
            return redirect("articles/detail/$comment->article_id")->with('info', 'Unauthorized');
        }
    }

    public function delete($id) {
        $comment = Comment::find($id);

        if (Gate::allows('comment-delete', $comment)) {
            $comment->delete();
            return back()->with('info', 'A comment is deleted');
        } else {
            return back()->with('info', 'Unauthorized');
        }
    }
}
