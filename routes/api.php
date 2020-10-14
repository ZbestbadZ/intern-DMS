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



Route::group(['middleware'=>'auth:api'],function() {
    Route::group(['prefix'=>'sticker'],function(){
        Route::get('','StickerController@index');
        Route::get('{id}','StickerController@get');
        Route::patch('{id}','StickerController@update');
        Route::post('', 'StickerController@store');
        Route::delete('{id}','StickerController@destroy');
    });
    Route::group(['prefix'=>'pickup'],function(){
        Route::get('','PickupController@index');
      
    });
    
    Route::group(['prefix'=>'masterData'],function(){
        Route::get('job','MasterDataController@job');
    });
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function() {
    Route::get('maleOP','UserManagementController@getMaleOption');
    Route::get('list_user','UserManagementController@index');
    Route::get('add_user', 'UserManagementController@add');
    Route::post('add_user', 'UserManagementController@store');
    Route::get('edit_user/{id}','UserManagementController@edit');
    Route::patch('edit_user/{id}', 'UserManagementController@update');
    Route::delete('{id}','UserManagementController@destroy');
    Route::get('{id}', 'UserManagementController@show');
});
