<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        // latest() method in Laravel sorts the data in descending order based on the created_at column by default.
        $data = Article::latest()->paginate(5);

        return view('articles.index', ["articles" => $data]);
    }

    public function detail($id) {
        $article = Article::find($id);
        return view('articles.detail', ["article" => $article]);
    }
}
