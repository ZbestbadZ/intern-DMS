<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function() {
    Route::get('list_user','UserManagementController@index');
    Route::get('add_user', 'UserManagementController@add');
    Route::post('add_user', 'UserManagementController@store');
    Route::get('edit_user/{id}','UserManagementController@edit');
    Route::patch('edit_user/{id}', 'UserManagementController@update');
    Route::delete('{id}','UserManagementController@destroy');
});
