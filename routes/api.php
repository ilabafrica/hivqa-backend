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

Route::post('/register', 'Auth\APIController@register');
Route::post('/login', 'Auth\APIController@login');
Route::get('/auth/signup/activate/{token}', 'Auth\APIController@signupActivate');
// Route::resource('/facilities', 'FacilityController');
// Route::resource('/questions', 'QuestionController');
// Route::get('/org_units', 'FacilityController@org_units');
// Route::get('/question_per_checklist/{id}', 'QuestionController@question_per_checklist');

Route::middleware('cors:api')->group( function () {
	Route::resource('/facilities', 'FacilityController');
	Route::resource('/questions', 'QuestionController');
	Route::get('/org_units', 'FacilityController@org_units');
	Route::get('/question_per_checklist/{id}', 'QuestionController@question_per_checklist');
});
Route::middleware('auth:api')->group( function () {
	Route::post('/logout', 'Auth\APIController@logout');
    Route::get('/get-user', 'Auth\APIController@getUser');
	Route::resource('jobs', 'API\JobController');
});
