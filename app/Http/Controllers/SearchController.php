<?php

namespace App\Http\Controllers;

use App\Category;
use App\Grade;
use App\User;
use Illuminate\Http\Request;
use App\Article;
use App\Repositories\ArticleRepository;


class SearchController extends Controller
{
    protected $articles;

    public function __construct(ArticleRepository $articles)
    {
        $this->articles = $articles;
    }

    public function allArticles(){
        $articles = Article::orderBy('created_at', 'des')->paginate(2);
        return $articles;
    }

    public function articlesByUser($user){
        $articles = Article::where('user_id', '=', $user)->paginate(2);
        $user = User::where('id', $user)->first();
        return view('search.articlesByUser', ['articles' => $articles, 'user' => $user]);
    }

    public function articlesByCategory($category){
        $articles = Article::where('category_ref', 'LIKE', '%'.$category.'%')->paginate(2);
        $category = Category::where('title', 'LIKE', '%'.$category.'%')->first();
        return view('search.articlesByGrade', ['articles' => $articles, 'category' => $category]);
    }

    public function articlesByGrade($grade){
        $articles = Article::where('grade_ref', 'LIKE', '%'.$grade.'%')->paginate(2);
        $grade = Grade::where('title', 'LIKE', '%'.$grade.'%')->first();
        return view('search.articlesByGrade', ['articles' => $articles, 'grade' => $grade]);
    }

    public function articlesByString(Request $request){
        $articles = $this->articles->byString($request->q);
        return view('search.articlesByString', ['articles' => $articles, 'string' => $request->q]);
    }
}
