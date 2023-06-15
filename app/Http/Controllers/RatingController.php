<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rate(Article $article, Request $request)
    {
        // Check if the user has already rated the article
        if (auth()->user()->rates()->where('article_id', $article->id)->exists()) {
            auth()->user()->rates()->where('article_id', $article->id)->update([
                'rate' => $request->post('rating')
            ]);
        } else {

            auth()->user()->rates()->create([
                'article_id' => $article->id,
                'rate' => $request->post('rating')
            ]);
        }
        return redirect()->back();


    }
}
