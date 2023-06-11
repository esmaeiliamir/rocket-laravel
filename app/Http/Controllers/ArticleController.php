<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::latest()->paginate(4);
        return view('articles.index', compact('articles'));
    }


    public function create() {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request) {

        Validator::validate($request->post(),[
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
//            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ] , [
            'title.required' => 'عنوان رو وارد کن.'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);


        $article = auth()->user()->articles()->create([
            'title' => $request->post('title'),
            'body' => $request->post('body'),
            'image' => $imageName
        ]);

        $article->categories()->attach($request->post('category'));

        return redirect('/');
    }
    public function show(Article $article) {
        $comments = $article->comments()->get();
        return view('articles.article', compact('article', 'comments'));
    }
}
