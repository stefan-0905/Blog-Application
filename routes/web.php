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

Route::get('/tag/search/{tag}', [
    'uses' => 'FrontEndController@tag_search',
    'as' => 'tag.search'
]);

Route::prefix('admin')->group(function() {
    Auth::routes();

    Route::get('/dashboard', 'Backend\HomeController@index')->name('dashboard');

    Route::get('/posts', [
        'uses' => 'Backend\PostsController@index',
        'as' => 'posts'
    ]);

    Route::get('/post/create', [
        'uses' => 'Backend\PostsController@create',
        'as' => 'post.create'
    ]);

    Route::post('post/store', [
        'uses' => 'Backend\PostsController@store',
        'as' => 'post.store'
    ]);

    Route::get('post/edit/{id}', [
        'uses' => 'Backend\PostsController@edit',
        'as' => 'post.edit'
    ]);

    Route::post('post/update/{id}',[
        'uses' => 'Backend\PostsController@update',
        'as' => 'post.update'
    ]);

    Route::get('post/delete/{id}', [
        'uses' => 'Backend\PostsController@delete',
        'as' => 'post.delete'
    ]);

    Route::put('post/restore/{id}', [
        'uses' => 'Backend\PostsController@restore',
        'as' => 'post.restore'
    ]);

    Route::delete('post/destroy/{id}', [
        'uses' => 'Backend\PostsController@destroy',
        'as' => 'post.destroy'
    ]);

    Route::resource('categories', 'Backend\CategoriesController');

    Route::get('users/confirm/{user}', [
        'uses' => 'Backend\UsersController@confirmDelete',
        'as' => 'users.confirm_delete'
    ]);
    
    Route::resource('users', 'Backend\UsersController');
});

