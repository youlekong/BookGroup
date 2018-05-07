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
    return view('admin');
});

Route::post('admin/login', 'Admin\LoginController@login');
Route::get('admin/logout', 'Admin\LoginController@logout');

// 文件上传相关路由
Route::post('upload/image', 'UploadController@image');

Route::group(['middleware' => ['auth'], 'namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::prefix('user')->group(function () {
        Route::get('/index', 'UserController@index');
        Route::post('/create', 'UserController@create');
        Route::post('/update', 'UserController@update');
        Route::get('/delete', 'UserController@delete');
    });

    Route::prefix('book')->group(function () {
        Route::get('/index', 'BookController@index');
        Route::post('/create', 'BookController@create');
        Route::post('/update', 'BookController@update');
        Route::get('/delete', 'BookController@delete');
    });

    Route::prefix('bookCate')->group(function () {
        Route::get('/index', 'BookCateController@index');
        Route::post('/create', 'BookCateController@create');
        Route::post('/update', 'BookCateController@update');
        Route::get('/delete', 'BookCateController@delete');
        Route::get('/allCates', 'BookCateController@allCates');
    });

    Route::prefix('bookComment')->group(function () {
        Route::get('/index', 'BookCommentController@index');
        Route::post('/create', 'BookCommentController@create');
        Route::post('/update', 'BookCommentController@update');
        Route::get('/delete', 'BookCommentController@delete');
    });

    Route::prefix('article')->group(function () {
        Route::get('/index', 'ArticleController@index');
        Route::post('/create', 'ArticleController@create');
        Route::post('/update', 'ArticleController@update');
        Route::get('/delete', 'ArticleController@delete');
    });

    Route::prefix('articleComment')->group(function () {
        Route::get('/index', 'ArticleCommentController@index');
        Route::post('/create', 'ArticleCommentController@create');
        Route::post('/update', 'ArticleCommentController@update');
        Route::get('/delete', 'ArticleCommentController@delete');
    });

    Route::prefix('group')->group(function () {
        Route::get('/index', 'GroupController@index');
        Route::post('/create', 'GroupController@create');
        Route::post('/update', 'GroupController@update');
        Route::get('/delete', 'GroupController@delete');
    });

    Route::prefix('groupCate')->group(function () {
        Route::get('/index', 'GroupCateController@index');
        Route::post('/create', 'GroupCateController@create');
        Route::post('/update', 'GroupCateController@update');
        Route::get('/delete', 'GroupCateController@delete');
        Route::get('/allCates', 'GroupCateController@allCates');
    });

    Route::prefix('activity')->group(function () {
        Route::get('/index', 'ActivityController@index');
        Route::post('/create', 'ActivityController@create');
        Route::post('/update', 'ActivityController@update');
        Route::get('/delete', 'ActivityController@delete');
    });

    Route::prefix('rental')->group(function () {
        Route::get('/index', 'RentalController@index');
        Route::post('/create', 'RentalController@create');
        Route::post('/update', 'RentalController@update');
        Route::get('/delete', 'RentalController@delete');
    });

    Route::prefix('share')->group(function () {
        Route::get('/index', 'ShareController@index');
        Route::post('/create', 'ShareController@create');
        Route::post('/update', 'ShareController@update');
        Route::get('/delete', 'ShareController@delete');
    });

    Route::get('/sysInfo', 'SystemController@index');
});


Route::group(['middleware' => ['cross'], 'namespace' => 'h5', 'prefix' => 'h5'], function () {
    Route::prefix('sign')->group(function () {
        Route::get('/captcha', 'SignController@captcha');
        Route::post('/signIn', 'SignController@signIn');
        Route::post('/signUp', 'SignController@signUp');
    });
});

Route::group(['middleware' => ['cross', 'h5Auth'], 'namespace' => 'h5', 'prefix' => 'h5'], function () {
    Route::prefix('share')->group(function () {
        Route::get('/index', 'ShareController@index');
    });

    Route::prefix('book')->group(function () {
        Route::get('/getBooks', 'BookController@getBooks');
    });

    Route::prefix('bookComment')->group(function () {
        Route::get('/getComments', 'BookCommentController@getComments');
    });

//    Route::prefix('sign')->group(function () {
//        Route::get('/captcha', 'SignController@captcha');
//        Route::post('/signIn', 'SignController@signIn');
//        Route::post('/signUp', 'SignController@signUp');
//    });
});