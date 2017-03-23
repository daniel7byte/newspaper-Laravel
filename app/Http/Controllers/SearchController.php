<?php

namespace App\Http\Controllers;

use App\Category;
use App\Grade;
use App\Institution;
use App\User;
use Illuminate\Http\Request;
use App\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
    protected $pagination = 5;

    protected $articles;

    public function __construct(ArticleRepository $articles)
    {
        $this->articles = $articles;
    }

    public function allArticles(){
        $articles = Article::orderBy('created_at', 'desc')->paginate($this->pagination);
        return $articles;
    }

    public function articlesByUser($user){
        $articles = Article::where('user_id', '=', $user)->orderBy('created_at', 'desc')->paginate($this->pagination);
        $user = User::where('id', $user)->first();
        return view('search.articlesByUser', ['articles' => $articles, 'user' => $user]);
    }

    public function articlesByCategory($category){
        $articles = Article::where('category_ref', 'LIKE', '%'.$category.'%')->orderBy('created_at', 'desc')->paginate($this->pagination);
        $category = Category::where('title', 'LIKE', '%'.$category.'%')->first();
        return view('search.articlesByCategory', ['articles' => $articles, 'category' => $category]);
    }

    public function articlesByGrade($grade){
        $articles = Article::where('grade_ref', 'LIKE', '%'.$grade.'%')->orderBy('created_at', 'desc')->paginate($this->pagination);
        $grade = Grade::where('title', 'LIKE', '%'.$grade.'%')->first();
        return view('search.articlesByGrade', ['articles' => $articles, 'grade' => $grade]);
    }

    public function articlesByInstitution($institution){
        $articles = Article::where('institution_ref', 'LIKE', '%'.$institution.'%')->orderBy('created_at', 'desc')->paginate($this->pagination);
        $institution = Institution::where('title', 'LIKE', '%'.$institution.'%')->first();
        return view('search.articlesByInstitution', ['articles' => $articles, 'institution' => $institution]);
    }

    public function articlesByString(Request $request){
        if ($request->q == NULL or $request->q == '') {
            return redirect()->route('welcome');
        }
        $articles = $this->articles->byString($request->q);
        return view('search.articlesByString', ['articles' => $articles, 'string' => $request->q]);
    }
}
