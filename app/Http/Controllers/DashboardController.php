<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Grade;
use App\Article;
use App\Commentary;
use App\InternalComment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $pagination = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('welcome'));
    }

    public function articlesFormStatus(){
        if(Auth::user()->role != "ADMIN")
        {
            abort(403);
        }
        else
        {
            $articles = Article::orderBy('created_at', 'desc')->paginate($this->pagination);
            return view('dashboard.articlesFormStatus', ['articles' => $articles]);
        }
    }

    public function articlesChangeStatus(Request $request, Article $article){
        if($article->active == true)
        {
            $article->active = false;
        }
        else
        {
            $article->active = true;
        }

        $article->save();
        return response()->json($article->active);
    }
}
