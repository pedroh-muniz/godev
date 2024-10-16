<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'users', 'namespace' => 'App\Http\Controllers'], function(){
    Route::get('/create',['uses' => 'UserController@create', 'as' => 'users.create'] );
    Route::get('/login',['uses' => 'UserController@login', 'as' => 'login'] );
    Route::post('/',['uses' => 'UserController@store', 'as' => 'users.store'] );
    Route::post('/auth',['uses' => 'UserController@auth', 'as' => 'users.auth'] );
});

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'users', 'namespace' => 'App\Http\Controllers'], function(){
        Route::get('/{id}/show',['uses' => 'UserController@show', 'as' => 'users.show'] );
        Route::get('/',['uses' => 'UserController@logout', 'as' => 'users.logout'] );
    });
});