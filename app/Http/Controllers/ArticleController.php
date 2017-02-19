<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Grade;
use App\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $grades = Grade::all();
        $institutions = Institution::all();
        return view('articles.create', ['categories' => $categories, 'grades' => $grades, 'institutions' => $institutions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $article = new Article();

        $article->title = $request->title;
        $article->description = $request->description;

        $article->category_ref = $request->category_ref;
        $article->grade_ref = $request->grade_ref;
        $article->institution_ref = $request->institution_ref;

        if($request->user()->role != "ADMIN"){
            $article->active = false;
        }else{
            $article->active = true;
        }

        $img = $request->file('image');

        $strFlash = 'Article Created';
        $strStatus = 'success';

        if ($img != null) {
            if ($img->getError() == 0) {

                $file_route = time() . '_' . $img->getClientOriginalName();
                Storage::disk('imagesArticles')->put($file_route, \File::get($img));
                $article->image = $file_route;

            } elseif($img->getError() == 1) {
                $strFlash = $img->getErrorMessage();
                $strStatus = 'warning';
            }
        }else{
            $article->image = null;
        }

        $article->user_id = $request->user()->id;

        $article->save();
        return redirect(route('searchArticlesByUser', ['user' => Auth::user()->id]))->with($strStatus, $strFlash);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Article $article)
    {
        if($request->user()->role != "ADMIN"){
            $this->authorize('owner', $article);
        }
        $categories = Category::all();
        $grades = Grade::all();
        $institutions = Institution::all();
        return view('articles.edit', ['article' => $article, 'categories' => $categories, 'grades' => $grades, 'institutions' => $institutions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if($request->user()->role != "ADMIN"){
            $this->authorize('owner', $article);
        }

        $this->validate($request, [
            'title' => 'required',
        ]);

        $article = Article::find($request->article->id);

        $article->title = $request->title;
        $article->description = $request->description;

        $article->category_ref = $request->category_ref;
        $article->grade_ref = $request->grade_ref;
        $article->institution_ref = $request->institution_ref;

        if($request->user()->role != "ADMIN"){
            $article->active = false;
        }else{
            $article->active = true;
        }

        $img = $request->file('image');

        $strFlash = 'Article Edited';
        $strStatus = 'success';

        if ($img != null) {
            if ($img->getError() == 0) {

                $exists = Storage::disk('imagesArticles')->exists($article->image);
                if ($exists) {
                    Storage::disk('imagesArticles')->delete($article->image);
                }
                $file_route = time() . '_' . $img->getClientOriginalName();
                Storage::disk('imagesArticles')->put($file_route, \File::get($img));
                $article->image = $file_route;

            } elseif($img->getError() == 1) {
                $strFlash = $img->getErrorMessage();
                $strStatus = 'warning';
            }
        }

        $article->save();
        return redirect(route('detailsArticle', ['article' => $article]))->with($strStatus, $strFlash);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
