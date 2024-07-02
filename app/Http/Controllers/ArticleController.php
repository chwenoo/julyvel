<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $data = Article::latest()->paginate(5);

        return view('articles.index', ["articles" => $data]);
    }

    public function detail($id) {
        $article = Article::find($id);
        return view('articles.detail', ["article" => $article]);
    }

    public function add() {
        $categories = [
            ["id" => 1, "name" => "Web"],
            ["id" => 2, "name" => "Mobile"],
            ["id" => 3, "name" => "News"],
        ];
        return view('articles.add', ['categories' => $categories]);
    }

    public function create() {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article();
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect('/')->with('info', 'new article is created');
    }

    public function delete($id) {
        $article = Article::find($id);
        $article->delete();

        return redirect('/')->with('info', 'An article is deleted');
    }
}
