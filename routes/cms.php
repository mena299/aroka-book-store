<?php


Route::get('dashboard', 'cms\DashboardController@dashboard');


Route::group(['prefix' => '/authors'], function () {
    Route::group(['prefix' => '/pen-names'], function () {
        Route::get('/list', 'cms\PenNameController@index');
        Route::post('/save', 'cms\PenNameController@store');
        Route::get('/delete/{pen_name_id}', 'cms\PenNameController@destroy');

    });
});
