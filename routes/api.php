<?php

use Illuminate\Http\Request;

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


//ARTICLES
//List Articles
Route::get('articles', 'ArticleController@index');

//List Single Articles
Route::get('article/{id}', 'ArticleController@show');

//Create New Articles
Route::post('article', 'ArticleController@store');

//Update Articles
Route::put('article', 'ArticleController@store');

//Delete Articles
Route::delete('article/{id}', 'ArticleController@destroy');





//PRODUCTS
//List Products
Route::get('products', 'ProductController@index');

//List Single Productss
Route::get('product/{id}', 'ProductController@show');

//Create New Products
Route::post('product', 'ProductController@store');

//Update Products
Route::put('product', 'ProductController@store');

//Delete Products
Route::delete('product/{id}', 'ProductController@destroy');