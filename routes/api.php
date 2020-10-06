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

Route::prefix('pickup')->group(function(){
    Route::get('','PickupController@index');
  
});
Route::prefix('sticker')->group(function() {
        Route::get('index','StickerController@index');
        Route::get('{id}','StickerController@get');
        Route::delete('{id}','StickerController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
