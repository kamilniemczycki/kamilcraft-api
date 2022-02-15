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

Route::name('admin.')->group(function () {
    Route::namespace('Dashboard')->middleware('auth')->group(function () {
        Route::get('', 'AdminPanelController')->name('home');
        Route::name('category.')->prefix('category')->group(function () {
            Route::get('create', 'CategoryController@create')
                ->name('create');
            Route::post('', 'CategoryController@store')
                ->name('store');

            Route::get('{category}', 'CategoryController@edit')
                ->name('edit');
            Route::put('{category}', 'CategoryController@update')
                ->name('update');

            Route::get('{category}/delete', 'CategoryController@delete')
                ->name('delete');
            Route::delete('{category}/delete', 'CategoryController@destroy')
                ->name('destroy');
        });

        Route::name('project.')->prefix('project')->group(function () {
            Route::get('create', 'ProjectController@create')
                ->name('create');
            Route::post('', 'ProjectController@store')
                ->name('store');

            Route::get('{project}', 'ProjectController@edit')
                ->name('edit');
            Route::put('{project}', 'ProjectController@update')
                ->name('update');

            Route::get('{project}/delete', 'ProjectController@delete')
                ->name('delete');
            Route::delete('{project}/delete', 'ProjectController@destroy')
                ->name('destroy');
        });
    });
    Route::name('auth.')->namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@login')
            ->name('login');
        Route::post('login', 'LoginController@authenticate')
            ->name('authenticate');
        Route::post('logout', 'LoginController@logout')
            ->name('logout');
    });
});
