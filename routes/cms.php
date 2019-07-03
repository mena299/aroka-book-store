<?php


Route::get('dashboard', 'cms\DashboardController@dashboard');


Route::group(['prefix' => '/customers'], function () {
    Route::get('/', 'cms\CustomerController@index');
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
