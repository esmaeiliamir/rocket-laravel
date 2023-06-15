<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{

    // many replies for comments

    public function index(Request $request)
    {

        $allArticlesQuery = Article::query();

        if ($request->input('term') !== null) {

            $term = $request->input('term');
            $searchValues = explode(' ', $term);

            foreach ($searchValues as $value) {
                $allArticlesQuery->where(function (Builder $query) use ($value) {
                    $query->where('title', 'like', '%' . $value . '%')
                        ->orWhere('body', 'like', '%' . $value . '%');
                })
                    ->orWhereHas('user', function (Builder $query) use ($value) {
                        $query->where('name', 'like', '%' . $value . '%');
                    })
                    ->orWhereHas('categories', function (Builder $query) use ($value) {
                        $query->where('name', 'like', '%' . $value . '%');
                    });
            }
        } else {
            $allArticlesQuery = Article::query();
        }

        $articles = $allArticlesQuery->latest()->paginate(4);

        return view('articles.index', compact('articles'));
    }

    public function apiAll()
    {
        $articles = Article::all();
        return json_decode($articles);
//        return view('articles.index', compact('articles'));
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

        $averageRating = Article::with('rates')
            ->select('article_id', DB::raw('AVG(rates.rate) as average_rating'))
            ->join('rates', 'article_id', '=', 'rates.article_id')
            ->groupBy('article_id')
            ->where('article_id', '=',  $article->id)
            ->first()->average_rating ?? 0;

//        $averageRating = Article::withAvg('rates', 'rate');

        $liked = $article->likedBy->contains(auth()->user());
        $rated = $article->rateBy->contains(auth()->user());
        $comments = $article->comments()->get();
//        $comments = $article->comments()->where('commentable_type', '=', 'article')->get();
//        $replies = $article->comments()->where('commentable_type', '=', 'comment')->get();
        $replies = Comment::where(function ($query) {
            $query->where('commentable_type', Comment::class);
        })->get();
        return view('articles.article', compact('article', 'comments', 'liked', 'rated', 'averageRating', 'replies'));
    }
}
