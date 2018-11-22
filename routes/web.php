<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'FrontEndController@index',
    'as' => 'index'
]);

Route::get('/{post}', [
    'uses' => 'FrontEndController@show',
    'as' => 'show.post'
]);

Route::get('/category/search/{category}', [
    'uses' => 'FrontEndController@category_search',
    'as' => 'category.search'
]);

Route::get('/author/search/{author}', [
    'uses' => 'FrontEndController@author_search',
    'as' => 'author.search'
]);

Route::post('search', [
    'uses' => 'FrontEndController@search',
    'as' => 'title.search'
]);

// Route::get('search/{post}', [
//     'uses' => 'FrontEndController@search_post',
//     'as' => 'search.post'
// ]);
