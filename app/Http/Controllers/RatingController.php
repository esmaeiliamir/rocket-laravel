<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function rate(Article $article, Request $request)
    {

        Validator::validate($request->post(), [
            'rating' => 'required|min:0|max:5',
        ], [
            'rating.required' => 'امتیاز را بین 0 و 5 وارد نمایید',
            'rating.min' => 'امتیاز باید از 0 بزرگتر باشد',
            'rating.max' => 'امتیاز باید از 5 کوچکتر باشد'
        ]);

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
