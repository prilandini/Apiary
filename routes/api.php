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
Route::group(['middleware' => 'auth:api'],function(){
    
    Route::get('/test',function(){
        return "hello";
    });

    Route::resource('/users', 'UserController');
    Route::resource('/posts', 'PostController');    
    Route::resource('/comments', 'CommentController');
    Route::resource('/albums', 'AlbumController');
    Route::resource('/photos', 'PhotoController');
    Route::resource('/todos', 'TodoController');

    Route::get('/posts/{post}/comments', 'PostController@getComments')->name('Posts.getComments');
    Route::get('/albums/{albums}/photos', 'AlbumController@getPhotos')->name('Albums.getPhotos');
    Route::get('/users/{users}/todos', 'UserController@getTodos')->name('Users.getTodos');
    Route::get('/users/{users}/posts', 'UserController@getPosts')->name('Users.getPosts');
    Route::get('/users/{users}/albums', 'UserController@getAlbums')->name('Users.getAlbums');
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
