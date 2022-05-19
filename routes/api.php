<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('ping', function () {
    return ['message' => 'pong'];
});

Route::get('categories', 'CategoryController@index');
Route::prefix('category')->group(function() {
    Route::get('{category}', 'CategoryController@showWhereSlug');
});

Route::get('projects', 'ProjectController@index');
Route::prefix('project')->group(function() {
    Route::get('{project}', 'ProjectController@show');
});
