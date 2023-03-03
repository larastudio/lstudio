<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function list()
    {
        $articles = Article::all();

        return Inertia::render('Articles/List', [
            'articles' => $articles,
            // 'user' => $user,
            // 'team' => $team
        ]);
    }
}
