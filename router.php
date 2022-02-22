<?php

use KamilCraftApi\Router\Router;
use KamilCraftApi\App\Controllers\HomeController;
use KamilCraftApi\App\Controllers\ProjectController;
use KamilCraftApi\App\Controllers\CategoriesController;

$router = new Router;

$router
    ->get('/', HomeController::class)
    ->name('home');
$router
    ->get('/projects', ProjectController::class)
    ->name('projects');
$router
    ->get('/projects/:id', ProjectController::class .'@show')
    ->name('projects.show');
$router
    ->get('/projects/category/:category', ProjectController::class .'@showWhereCategory')
    ->name('projects.category.show');
$router
    ->get('/categories', CategoriesController::class)
    ->name('categories');
$router
    ->get('/categories/:id', CategoriesController::class .'@show')
    ->name('categories.show');
$router
    ->get('/categories_name/:slug', CategoriesController::class .'@showWhereName')
    ->name('categories.name.show');

return $router;
