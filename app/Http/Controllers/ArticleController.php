<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Article $article) {
        $articles = Article::latest()->paginate(4);
        return view('articles.index', compact('articles'));
    }


    public function create() {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.create', compact('categories'));
    }

    public function store() {

        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        ] , [
            'title.required' => 'عنوان رو وارد کن تو رو خدا.'
        ]);

        $id = auth()
                    ->user()
                    ->id;

        $article = Article::create([
            'user_id' => $id,
            'title' => request('title'),
            'slug' => request('title'),
            'body' => request('body')
        ]);

        $article->categories()->attach(\request('category'));

        return redirect('/');
    }

    public function show(Article $article) {
        $comments = $article->comments()->get();
        return view('articles.article', compact('article', 'comments'));
    }
}
