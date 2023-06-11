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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::get('news/delete', 'Admin\NewsController@delete');

    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
});

Route::get('sports-api-test', 'SportsController@index');
Route::get('testapi', 'TestapiController@index');
Route::get('feed', 'FeedController@feed');
Route::get('feedRead', 'FeedController@feedRead')->middleware('auth');
Route::get('football/teams', 'Football\TeamController@index');
Route::get('football/team/{id}', 'Football\TeamController@detail')->name('team.detail');
Route::get('/test', 'TestController@index');
Route::post('/test', 'TestController@update')->name('test.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index');

Route::get('/image_input', 'ImageController@getImageInput');
Route::post('/image_confirm', 'ImageController@postImageConfirm');
Route::post('/image_complete', 'ImageController@postImageComplete');

Route::get('/team_input', 'TeamMasterController@getTeamInput');
Route::post('/team_confirm', 'TeamMasterController@postTeamConfirm');
Route::post('/team_complete', 'TeamMasterController@postTeamComplete');

