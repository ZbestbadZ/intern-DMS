<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Auth::routes(['register' => false]);


Route::group(['middleware'=>'auth'], function(){
    Route::group(['prefix'=>'pickup'],function(){
        Route::get('','PickupController@getIndex')->name('pickup.index');
    });
});


Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('sticker')->middleware('auth')->group( function() {
    Route::get('/index',function(){
        return view('sticker.index');
    })->name('sticker.index');
    
    Route::get('{id}/edit','StickerController@edit')->name('sticker.edit');
    
    Route::get('/create',function(){
        return view('sticker.create');
    })->name('sticker.create');

    Route::post('', 'StickerController@store');
    Route::patch('{id}','StickerController@update');
});