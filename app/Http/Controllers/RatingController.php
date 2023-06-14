<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rate(Article $article, Request $request)
    {
            auth()->user()->rates()->create([
                'article_id' => $article->id,
                'rate' => $request->post('rating')
            ]);

        return redirect()->back();
    }
}
