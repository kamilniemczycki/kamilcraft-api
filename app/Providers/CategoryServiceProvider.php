<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\CategoryRepository;
use App\Repository\Interfaces\CategoryRepository as CategoryRepositoryInterface;

class CategoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app
            ->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

}
