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
Route::get('matches', 'TestapiController@api');

Route::get('feed', 'FeedController@apiFeed')->middleware('auth:api');
Route::put('feed', 'FeedController@apiStore');
Route::post('fileupload', 'MypageController@uploadImage');
// Route::post('fileupload', function(){dd(request()->all());});
Route::get('comments/{comment_id}', 'FeedController@apiGetComments')->middleware('auth:api');
Route::get('/teams', 'MypageController@apiTeams');
Route::get('/users', 'UserController@index');
Route::post('/favoriteTeamsCreate', 'MypageController@favoriteTeamsCreate');
Route::get('/favoriteTeamsRead', 'MypageController@favoriteTeamsRead');
Route::post('/favoriteTeamsUpdate', 'MypageController@favoriteTeamsUpdate');
