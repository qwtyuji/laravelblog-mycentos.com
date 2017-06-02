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

Route::get('/excel',function (){
    $export_file_name = 'me';
    Excel::create($export_file_name, function ($excel) {
        $excel->sheet('Sheetname', function ($sheet) {
            $sheet->appendRow(['data 1', 'data 2']);
            $sheet->appendRow(['data 3', 'data 4']);
            $sheet->appendRow(['data 5', 'data 6']);
        });
    })->download('xls');

// 导出 Excel 并存储到指定目录
//    Excel::create($export_file_name, function ($excel) {
//        $excel->sheet('Sheetname', function ($sheet) {
//            $sheet->appendRow(['data 1', 'data 2']);
//            $sheet->appendRow(['data 3', 'data 4']);
//            $sheet->appendRow(['data 5', 'data 6']);
//        });
//    })->store('xls', $object_path);
});

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



