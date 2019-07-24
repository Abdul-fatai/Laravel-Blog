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


/*
Route::get('/hello', function () {
    return "<h1>Hello world</h1>";
});
Route::get('/users/{id}', function($id){
    return "This is ".$id;
});

*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/terms', 'PagesController@terms');
Route::get('/privacy', 'PagesController@privacy');
Route::get('/contact', 'PagesController@contact');

// Route::get('/search', 'PostsController@search');
Route::resource('posts', 'PostsController');
Route::resource('tags', 'TagController');

//Comment Route
Route::post('comments/{post_id}', 'CommentsController@store');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
