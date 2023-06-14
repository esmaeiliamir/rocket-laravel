<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function like(Article $article)
    {
        if (auth()->user()->likes()->where('article_id', $article->id)->exists()) {
            auth()->user()->likes()->delete($article->id);
        } else {
            auth()->user()->likes()->create([
                'article_id' => $article->id,
            ]);
        }

        return redirect()->back();
    }
}
