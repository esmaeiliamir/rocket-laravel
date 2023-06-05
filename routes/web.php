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


Route::get('/', 'App\Http\Controllers\ArticleController@index');
Route::get('/article/create', 'App\Http\Controllers\ArticleController@create');
Route::post('/article', 'App\Http\Controllers\ArticleController@store')->name('article.store');
Route::get('/article/{article}', 'App\Http\Controllers\ArticleController@show')->name('article.show');
Route::post('/article/{article}/comment', 'App\Http\Controllers\CommentController@store')->name('comment.store');
