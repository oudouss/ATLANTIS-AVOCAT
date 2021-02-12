<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/vvci', 301);

Route::group(['prefix' => 'vvci'], function () {
    Voyager::routes();
    Route::get('events', ['uses' => 'EventController@index', 'as' => 'event.index']);
    Route::post('events/store', ['uses' => 'EventController@store', 'as' => 'event.store']);
    Route::post('events/update', ['uses' => 'EventController@update', 'as' => 'event.update']);
    Route::post('events/delete', ['uses' => 'EventController@delete', 'as' => 'event.delete']);
});
