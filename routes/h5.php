<?php

Route::group(['middleware' => ['cross'], 'namespace' => 'H5'], function () {
    Route::prefix('sign')->group(function () {
        Route::get('/captcha', 'SignController@captcha');
        Route::post('/signIn', 'SignController@signIn');
        Route::post('/signUp', 'SignController@signUp');
    });
});

Route::group(['middleware' => ['cross', 'h5Auth'], 'namespace' => 'H5'], function () {
    Route::prefix('share')->group(function () {
        Route::get('/index', 'ShareController@index');
    });

    Route::prefix('book')->group(function () {
        Route::get('/getBooks', 'BookController@getBooks');
    });

    Route::prefix('bookComment')->group(function () {
        Route::get('/getComments', 'BookCommentController@getComments');
    });

    Route::prefix('group')->group(function () {
        Route::get('/getGroups', 'GroupController@getGroups');
        Route::get('/getGroupCates', 'GroupController@getGroupCategories');
    });

    Route::prefix('user')->group(function () {
        Route::get('/userBookInfo', 'UserController@userBookInfo');
    });
});