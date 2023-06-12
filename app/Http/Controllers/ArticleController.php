<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(4);
        return view('articles.index', compact('articles'));
    }

    public function search(Request $request)
    {

        $articles = Article::whereHas('user', function (Builder $query) use ($request) {
            $term = $request->input('term');
            $searchValues = explode(' ', $term);

            foreach ($searchValues as $value) {
                $query->where('title', 'like', '%' . $value . '%')
                    ->orWhere('body', 'like', '%' . $value . '%')
                    ->orWhere('name', 'like', '%' . $value . '%');
            }
        })->orWhereHas('categories', function (Builder $query) use ($request) {
            $term = $request->input('term');
            $searchValues = explode(' ', $term);

            foreach ($searchValues as $value) {
                $query->where('name', 'like', '%' . $value . '%');
            }
        })->get();
//        return $articles;
        return view('articles.search', compact('articles'));
    }

    public function apiAll()
    {
        $articles = Article::all();
        return json_decode($articles);
        return view('articles.index', compact('articles'));
    }


    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {

        Validator::validate($request->post(), [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
//            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'عنوان رو وارد کن.'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);


        $article = auth()->user()->articles()->create([
            'title' => $request->post('title'),
            'body' => $request->post('body'),
            'image' => $imageName
        ]);

        $article->categories()->attach($request->post('category'));

        return redirect('/');
    }

    public function show(Article $article)
    {
        $comments = $article->comments()->get();
        return view('articles.article', compact('article', 'comments'));
    }
}
