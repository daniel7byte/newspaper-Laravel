<?php

namespace App\Http\Controllers;

use App\Category;
use App\Grade;
use App\User;
use Illuminate\Http\Request;
use App\Article;


class DetailController extends Controller
{
    public function detailsArticle(Article $article){
        return view('detailsArticle', ['article' => $article]);
    }
}
