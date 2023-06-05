<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Article $article){
        $this->validate(request(), [
            'name' => 'required',
            'body' => 'required|min:5'
        ]);
        $article->comments()->create([
            'name' => \request('name'),
            'body' => \request('body'),
        ]);
        return back();
    }
}
