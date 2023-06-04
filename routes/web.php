<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $users = User::all();
    return view('welcome', compact('users'));
});

Route::get('/user/{id}', function ($id){
   $user = User::find($id);
   return view('show', compact('user'));
});

Route::get('/articles', 'App\Http\Controllers\ArticleController@index');


Route::name('article.show')->get('/article/{articleSlug}', 'App\Http\Controllers\ArticleController@show');
