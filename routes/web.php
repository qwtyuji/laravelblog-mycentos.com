<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('/article/{id}.html', 'IndexController@show');
Route::get('/article/{id}', 'IndexController@show');
Route::get('/search/{q?}', 'IndexController@search');
Route::get('/article/count/{id}', 'IndexController@count');
Route::get('/categoryies/{id}', 'IndexController@category');
Route::post('comments','CommentsController@addComments');
Route::group(['prefix'=>'user'],function (){
    Auth::routes();
});
Route::get('auth/github', 'Auth\GithubController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\GithubController@handleProviderCallback');


Route::group(['prefix' => 'dashboard','middleware'=>'auth.admin'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::resource('article', 'ArticleController');
    Route::get('recycle', 'ArticleController@recycle');
    Route::post('article/restore/{id}', 'ArticleController@restore');
    Route::any('article/forceDelete/{id}', 'ArticleController@forceDelete');
    Route::resource('category', 'CategoryController');
    Route::get('recycle', 'ArticleController@recycle');
    Route::match(['post', 'put', 'patch'], 'uploadpic', 'BaseController@uploadpic');
    Route::resource('link', 'LinkController');
    Route::resource('tags', 'TagsController');
    Route::resource('comment', 'CommentsController');
    Route::resource('attachment', 'AttachmentController');
    Route::resource('user', 'UserController');
    Route::resource('admin', 'AdminController');
    Route::get('info','AdminController@info');
    Route::get('updateInfo','AdminController@updateInfo');
    Route::post('updateInfoStore','AdminController@updateInfoStore');
    Route::get('resetPassword','AdminController@resetPassword');
    Route::post('resetPasswordStore','AdminController@resetPasswordStore');
    Route::post('saveavatar','UserController@saveAvatar');

});

Route::group(['prefix'=>'dashboard'],function (){
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');
});



