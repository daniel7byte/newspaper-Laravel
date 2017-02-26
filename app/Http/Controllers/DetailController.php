<?php

namespace App\Http\Controllers;

use App\Category;
use App\Grade;
use App\User;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;


class DetailController extends Controller
{
    public function detailsArticle(Article $article){
        if($article->active == true)
        {
            return view('detailsArticle', ['article' => $article]);
        }
        else
        {
            if(Auth::check())
            {
                if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                {
                    return view('detailsArticle', ['article' => $article]);
                }
                else
                {
                    abort(404);
                }
            }
            else{
                abort(404);
            }
        }
    }
}
