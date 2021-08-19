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

Route::get('/', 'PostsController@index');
Route::resource('/posts', 'PostsController');#->middleware('verified');
Route::get('/postf', 'PostsController@show'); // <--- redirect to post view for guests
Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/fuszerki', 'HomeController@fuszerki');
Route::get('/profeski', 'HomeController@profeski');

//Admin tools
Route::get('/queue', 'HomeController@queue');
Route::get('/traffic', 'HomeController@traffic');
Route::get('/users', 'HomeController@users');
Route::get('/rejected', 'HomeController@rejected');

//Post management
Route::post('/approve', 'HomeController@approve');
Route::post('/unapprove', 'HomeController@unapprove');
Route::post('/reject', 'HomeController@reject');
Route::post('/revoke', 'HomeController@revoke');
Route::post('/notify', 'HomeController@notify');

//Voting system
Route::post('/positive', 'HomeController@positive');
Route::post('/negative', 'HomeController@negative');

//Commenting system
Route::post('/comment', 'HomeController@comment');
Route::post('/comment_delete', 'HomeController@comment_delete');
Route::post('/addreply', 'HomeController@reply');
Route::post('/reply_delete', 'HomeController@reply_delete');
Route::get('/reply/{post_id}/{comment_id}', 'HomeController@comment_reply');

/*

Route::get('/regulamin', function () {
    return view('pages/regulamin');
});

Route::get('/rejestracja', function () {
    return view('pages/rejestracja');
});

Route::get('/dodawanie', function () {
    return view('pages/dodawanie');
});

Route::get('/{id}', function ($id) {
    return view('pages/dodawanie');
});

Route::get('/app', function () {
    return view('layouts/app');
});

*/