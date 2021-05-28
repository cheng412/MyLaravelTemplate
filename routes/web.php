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
    return redirect()->route('dashboard');
});

Route::group([
    'namespace'     => 'App\Http\Controllers\Admin'
], function () {
    Route::get('login', 'AuthController@loginPage')->name('login-page');
    Route::post('login', 'AuthController@login')->name('login');

    Route::group([
        'middleware'    => 'auth:web'
    ], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('profile', 'AuthController@profile')->name('profile');
        Route::put('profile', 'AuthController@updateProfile')->name('profile.update');
        Route::patch('profile/change-password', 'AuthController@changePassword')->name('profile.change-password');

        Route::get('dashboard', 'DashboardController@default')->name('dashboard');

        Route::get('users', 'UserController@index')->name('users');
        Route::get('users/create', 'UserController@create')->name('users.create');
        Route::post('users/store', 'UserController@store')->name('users.store');
        Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('users/{user}/update', 'UserController@update')->name('users.update');
        Route::delete('users/{user}/delete', 'UserController@delete')->name('users.delete');
        Route::patch('users/{user}/change-password', 'UserController@changePassword')->name('users.change-password');

        Route::get('groups', 'GroupController@index')->name('groups');
        Route::get('groups/create', 'GroupController@create')->name('groups.create');
        Route::post('groups/store', 'GroupController@store')->name('groups.store');
        Route::get('groups/{group}/edit', 'GroupController@edit')->name('groups.edit');
        Route::put('groups/{group}/update', 'GroupController@update')->name('groups.update');
        Route::delete('groups/{group}/delete', 'GroupController@delete')->name('groups.delete');
        
    });
    
});