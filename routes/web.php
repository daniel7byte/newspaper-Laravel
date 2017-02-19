<?php

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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'search'], function () {

    Route::get('/', 'SearchController@articlesByString')->name('searchArticlesByString');

    Route::get('user/{user}', 'SearchController@articlesByUser')->name('searchArticlesByUser');
    Route::get('category/{category}', 'SearchController@articlesByCategory')->name('searchArticlesByCategory');
    Route::get('grade/{grade}', 'SearchController@articlesByGrade')->name('searchArticlesByGrade');
});

Route::get('article/{article}', 'DetailController@detailsArticle')->name('detailsArticle');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect(route('searchArticlesByUser', ['user' => Auth::id()]));
    })->name('dashboard');

    Route::get('my_account', 'AccountController@index')->name('my_account');
    Route::post('my_account', 'AccountController@update')->name('my_account_update');

    Route::resource('users', 'UserController');

    Route::resource('categories', 'CategoryController');
    Route::resource('grades', 'GradeController');

    Route::resource('articles', 'ArticleController');
    Route::resource('commentaries', 'CommentaryController');
    Route::resource('internal_comments', 'InternalCommentController');
});
