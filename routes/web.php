<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin'],function(){
    Route::get('list_user', function() {
        return view('admin.list_user');
    })->name('admin.list_user');

    Route::get('add_user', function() {
        return view('admin.add_user');
    })->name('admin.add_user');
    Route::post('add_user', 'UserManagementController@store');

    Route::get('{id}/edit', 'UserManagementController@edit')->name('admin.edit');
    Route::patch('edit_user/{id}', 'UserManagementController@update');
});

