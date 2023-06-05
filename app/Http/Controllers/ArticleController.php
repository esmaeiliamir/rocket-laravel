<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Article $article) {
        $articles = Article::latest()->paginate(4);
        return view('articles.index', compact('articles'));
    }


    public function create() {
        return view('articles.create');
    }

    public function store() {

        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ] , [
            'title.required' => 'عنوان رو وارد کن تو رو خدا.'
        ]);

        Article::create([
            'user_id' => 1,
            'title' => request('title'),
            'slug' => request('title'),
            'body' => request('body')
        ]);

        return redirect('/');
    }

    public function show(Article $article) {
        $comments = $article->comments()->get();
        return view('articles.article', compact('article', 'comments'));
    }
}
