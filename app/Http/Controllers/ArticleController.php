<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = \App\Models\Article::all();
        return view('articles', compact('articles'));
    }

    public function show($article) {
//        $article = \App\Models\Article::find($id);
        return view('article', compact('article'));
    }
}
