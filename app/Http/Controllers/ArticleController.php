<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('index', 'detail');
    }

    public function index() {
        $data = Article::latest()->paginate(5);

        return view('articles.index', ["articles" => $data]);
    }

    public function detail($id) {
        $article = Article::find($id);
        return view('articles.detail', ["article" => $article]);
    }

    public function add() {
        $categories = Category::all();
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
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/')->with('info', 'new article is created');
    }

    public function edit($id) {
        $article = Article::find($id);
        $categories = Category::all();
        return view('articles.edit', ["article" => $article, "categories" => $categories]);
    }

    public function update($id) {
        $article = Article::find($id);

        if (Gate::allows('article-update', $article)) {

            $article->title = request()->title;
            $article->body = request()->body;
            $article->category_id = request()->category_id;
            $article->save();

            return redirect("/articles/detail/$article->id")->with("info", "Article is updated successfully");
        } else {
            return redirect("/articles/detail/$article->id")->with("info", "Unauthorized");
        }
    }

    public function delete($id) {
        $article = Article::find($id);

        if (Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect('/')->with('info', 'An article is deleted');
        } else {
            return back()->with('info', 'Unauthorized');
        }

    }
}
