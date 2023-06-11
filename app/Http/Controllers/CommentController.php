<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Article $article, Request $request){

        Validator::validate($request->post(),[
            'name' => 'required',
            'body' => 'required|min:5'
        ]);

        auth()->user()->comments()->create([
            'name' => $request->post('name'),
            'body' => $request->post('body'),
            'article_id' =>($article->id)
        ]);
        return back();
    }
}
