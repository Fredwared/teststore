<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'products', 'as' => 'products.'], function(){
    Route::get('', ['as' => 'index', 'uses' => 'ProductController@index']);
    Route::get('{product}', ['as' => 'show', 'uses' => 'ProductController@show']);
    Route::post('', ['as' => 'store', 'uses' => 'ProductController@store']);
    Route::put('{product}', ['as' => 'update', 'uses' => 'ProductController@update']);
    Route::delete('{product}', ['as' => 'destroy', 'uses' => 'ProductController@destroy']);
});
