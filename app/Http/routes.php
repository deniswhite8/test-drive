<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Client'], function() {
    Route::get('/', 'SearchController@index');
});

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function() {
    Route::post('search', 'SearchController@index');

    Route::group(['namespace' => 'Auto', 'prefix' => 'auto'], function() {
        Route::resource('mark.models', 'MarkModelsController', ['only' => ['index']]);
        Route::resource('model.generations', 'ModelGenerationsController', ['only' => ['index']]);
    });
});
