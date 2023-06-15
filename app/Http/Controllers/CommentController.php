<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Article $article, Request $request)
    {

        Validator::validate($request->post(), [
            'name' => 'required',
            'body' => 'required|min:5'
        ]);


//        auth()->user()->comments()->create([
//            'name' => $request->post('name'),
//            'body' => $request->post('body'),
//        ]);


        $article = Article::findOrFail($article->id);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->name = $request->post('name');
        $comment->body = $request->post('body');

        $article->comments()->save($comment);

//        auth()->user()->comments()->save($comment);


        return back();
    }

    public function reply(Request $request)
    {
        $comment = Comment::find($request->get('comment'));
        return view('articles.reply', compact('comment'));
    }

    public function submitReply(Comment $comment, Request $request)
    {

        Validator::validate($request->post(), [
            'name' => 'required',
            'body' => 'required|min:5'
        ]);

//        auth()->user()->comments()->create([
//            'name' => $request->post('name'),
//            'body' => $request->post('body'),
//        ]);

        $comment = Comment::findOrFail($comment->id);

        $commentNew = new Comment();
        $commentNew->user_id = auth()->user()->id;
        $commentNew->name = $request->post('name');
        $commentNew->body = $request->post('body');

        $comment->comments()->save($commentNew);

        return back();
    }
}
