<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RatingController;
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

Route::controller(ArticleController::class)->group(function () {
    Route::get('/', 'index');
    Route::prefix('/article')->group(function () {
        Route::name('article.')->group(function () {
            Route::get('/rest/all', 'apiAll');
            Route::get('/create', 'create')->middleware(['admin', 'auth']);
            Route::get('/edit/{article}', 'edit')->middleware(['admin', 'auth'])->name('edit');
            Route::post('', 'store')->name('store');
            Route::post('/{article}', 'update')->name('update');
            Route::get('/{article}', 'show')->name('show');
        });
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/submit/reply/{comment}', 'submitReply')->name('comment.reply');
    Route::prefix('/article')->group(function () {
        Route::name('comment.')->group(function () {
            Route::post('/{article}/comment', 'store')->name('store');
            // Reply to a comment
            Route::get('/comment/reply', 'reply')->name('create');
        });
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('/article')->group(function () {
        Route::name('category.')->group(function () {
            Route::get('/category/create', 'create')->name('create')->middleware(['admin', 'auth']);
            Route::post('/category/store', 'store')->name('store');
            Route::get('/category/{category}', 'index')->name('index');
        });
    });
});

Route::controller(LikeController::class)->group(function () {
    Route::prefix('/article')->group(function () {
        Route::name('article.')->group(function () {
            Route::post('/{article}/like', 'like')->name('like');
        });
    });
});


Route::controller(RatingController::class)->group(function () {
    Route::prefix('/article')->group(function () {
        Route::name('article.')->group(function () {
            Route::post('/{article}/rate', 'rate')->name('rate');
        });
    });
});

Route::group(['middleware' => 'admin', 'auth'], function () {
    Route::controller(ProfileController::class)->group(function () {
//        Route::middleware('auth')->group(function () {
            Route::get('/admin', [ProfileController::class, 'index'])->name('profile.edit');
//        });
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
