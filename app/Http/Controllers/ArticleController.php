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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return Inertia::render('Articles/Show', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'body' => $article->body
            ]
        ]);
    }
}
