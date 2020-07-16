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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', 'ProductsController@index');
Route::group(['prefix' => 'products'], function () {
    Route::post('add', 'ProductsController@add');
    Route::get('edit/{id}', 'ProductsController@edit');
    Route::post('update/{id}', 'ProductsController@update');
    Route::delete('delete/{id}', 'ProductsController@destroy');
});
Route::get('variationstypes', 'ProductVariationTypeController@index');
Route::group(['prefix' => 'variationstypes'], function () {
});