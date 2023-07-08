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

Route::get('/', function () {
    return view('welcome');
});

Route::get('feed', 'FeedController@feed');
Route::get('feedRead', 'FeedController@feedRead')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/image_input', 'ImageController@getImageInput');
Route::post('/image_confirm', 'ImageController@postImageConfirm');
Route::post('/image_complete', 'ImageController@postImageComplete');

Route::get('/team_input', 'TeamMasterController@getTeamInput');
Route::post('/team_confirm', 'TeamMasterController@postTeamConfirm');
Route::post('/team_complete', 'TeamMasterController@postTeamComplete');

