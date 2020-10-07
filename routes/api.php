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

Route::middleware('auth:api')->prefix('sticker')->group(function() {
    Route::get('','StickerController@index');
    Route::patch('{id}','StickerController@update');
    Route::post('', 'StickerController@store');
    Route::get('{id}','StickerController@get');
    Route::delete('{id}','StickerController@destroy');
});

Route:: prefix('sticker')->group(function() {
   
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
