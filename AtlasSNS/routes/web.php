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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::group(['middleware' => 'auth'], function (){
Route::get('/top','PostsController@index');
Route::post('/form', 'PostsController@create');

Route::post('/edit/{id}', 'PostsController@edit')->name('edit');
Route::get('/post/{id}/delete', 'PostsController@delete');

Route::get('/logout','Auth\LoginController@logout');

Route::get('/profile','UsersController@profile');
Route::post('/profileedit', 'UsersController@profileedit')->name('profileedit');

Route::post('/search_result','UsersController@searchresult');
Route::get('/search','UsersController@search');

Route::get('/followlist','FollowsController@followlist');
Route::get('/followerlist','FollowsController@followerlist');

Route::post('/follow/{id}','FollowsController@follow')->name('follow');
Route::post('/unFollow/{id}','FollowsController@unFollow')->name('unfollow');
});
