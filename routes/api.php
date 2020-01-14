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
Route::resource('/user', 'UserController');
Route::resource('/permission', 'PermissionController');
Route::get('permissionrole/attach', 'PermissionRoleController@attach');
Route::get('permissionrole/detach', 'PermissionRoleController@detach');
Route::get('permissionrole', 'PermissionRoleController@index');
Route::resource('role','RoleController');
Route::resource('counties','CountyController');
Route::middleware('cors:api')->group( function () {
	Route::resource('/facilities', 'FacilityController');
	Route::resource('/questions', 'QuestionController');
	Route::get('/org_units', 'FacilityController@org_units');
	Route::get('/get_sdps', 'FacilityController@get_sdps');
	Route::get('/question_per_checklist/{id}/{facility}/{sdp}', 'QuestionController@question_per_checklist');
	Route::get('/specific_checklist_survey/{id}', 'SurveyController@specific_checklist_survey');
	Route::get('/survey_data/{id}', 'SurveyController@survey_data');
});
Route::middleware('auth:api')->group( function () {
	Route::post('/logout', 'Auth\APIController@logout');
    Route::get('/get-user', 'Auth\APIController@getUser');
	
});
