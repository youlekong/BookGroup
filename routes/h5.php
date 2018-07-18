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
        Route::get('/getGroupsByCateId', 'GroupController@getGroupsByCateId');
        Route::get('/joinGroup', 'GroupController@joinGroup');
        Route::get('/checkUserGroup', 'GroupController@checkUserGroup');
        Route::get('/getGroupActivities', 'GroupController@getGroupActivities');
    });

    Route::prefix('activity')->group(function() {
        Route::get('/joinActivity', 'ActivityController@joinActivity');
        Route::get('/checkUserActivity', 'ActivityController@checkUserActivity');
    });

    Route::prefix('user')->group(function () {
        Route::get('/userBookInfo', 'UserController@userBookInfo');
        Route::get('/recommends', 'UserController@recommends');
    });

    Route::prefix('rental')->group(function () {
        Route::post('/index', 'RentalController@index');
    });
});