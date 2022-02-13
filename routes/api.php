<?php

declare(strict_types=1);

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

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
