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

Route::get('/home', 'HomeController@index')->name('home');




    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'sticker'], function () {
            Route::get('', 'StickerController@getIndex')->name('sticker.index');
            Route::get('{id}/edit', 'StickerController@edit')->name('sticker.edit');
            Route::get('/create', 'StickerController@getCreate')->name('sticker.create');
        });
        Route::group(['prefix' => 'recommend'], function () {
            Route::get('', 'RecommendController@indexView')->name('recommend.index');
        });
        Route::group(['prefix' => 'pickup'], function () {
            Route::get('', 'PickupController@getIndex')->name('pickup.index');
        });
        Route::group(['prefix'=>'admin'],function(){
            Route::get('list_user', 'UserManagementController@getIndex')->name('admin.list_user');
            Route::get('add_user', 'UserManagementController@add');
            Route::get('edit_user/{id}', 'UserManagementController@edit')->name('admin.edit_user');
        });
    });
    

