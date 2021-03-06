<?php


Route::get('dashboard', 'cms\DashboardController@dashboard');


Route::group(['prefix' => '/orders'], function () {
    Route::get('/list', 'cms\OrderController@index');
    Route::get('/detail/{order_id}', 'cms\OrderController@viewOrder');
    Route::post('/upload', 'cms\OrderController@uploadWixOrder');
    Route::post('/update-tracking', 'cms\OrderController@updateTracking');
    Route::get('/tracking-sendmail/{order_id}', 'cms\OrderController@trackingSendMail');

//    Route::post('/upload', 'cms\OrderController@uploadDSOTMPreOrder');
});



Route::group(['prefix' => '/products'], function () {
    Route::get('/list', 'cms\ProductController@index');
    Route::get('/create', 'cms\ProductController@create');
    Route::post('/save', 'cms\ProductController@store');
    Route::post('/save/{id}', 'cms\ProductController@store');
    Route::get('/{id}', 'cms\ProductController@edit');
});

Route::group(['prefix' => '/customers'], function () {
    Route::get('/list', 'cms\CustomerController@index');
    Route::get('/create', 'cms\CustomerController@create');
    Route::post('/save', 'cms\CustomerController@store');
    Route::post('/save/{id}', 'cms\CustomerController@store');
    Route::get('/{id}', 'cms\CustomerController@edit');
    Route::get('delete/{id}', 'cms\CustomerController@destroy');
});

Route::group(['prefix' => '/authors'], function () {

    Route::get('/list', 'cms\AuthorController@index');
    Route::post('/save', 'cms\AuthorController@store');
    Route::get('/delete/{pen_name_id}', 'cms\AuthorController@destroy');

    Route::group(['prefix' => '/pen-names'], function () {
        Route::get('/list', 'cms\PenNameController@index');
        Route::post('/save', 'cms\PenNameController@store');
        Route::get('/delete/{pen_name_id}', 'cms\PenNameController@destroy');

    });
});
