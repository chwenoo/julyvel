<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $data = [
            ["id" => 1 ,"title" => "Title One"],
            ["id" => 2 ,"title" => "Title Two"],
            ["id" => 3 ,"title" => "Title Three"],
        ];

        return view('articles.index', ["articles" => $data]);
    }

    public function detail($id) {
        return "Article Controller Detail - $id";
    }
}
