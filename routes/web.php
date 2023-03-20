<?php

use App\Http\Controllers\ArticleBackendController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Backend\ArticleController as BackendArticleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    // get all articles
    Route::get('dashboard/articles', [ArticleBackendController::class, 'index'])->name('articles.index');
    // edit article
    Route::get('dashboard/articles/{article}/edit', [ArticleBackendController::class, 'edit'])->name('articles.edit');
     // show article
     Route::get('/dashboard/articles/{article}', [ArticleBackendController::class, 'show'])->name('articles.show');
     // update article
    Route::put('/dashboard/articles/{article}', [ArticleBackendController::class, 'update'])->name('articles.update');

});

// Frontend
Route::get('/articles', [ArticleController::class, 'list'])->name('articles.list');
