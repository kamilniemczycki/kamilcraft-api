<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\CategoryRepository;
use App\Repository\Interfaces\CategoryRepository as CategoryRepositoryInterface;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }
}
