<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interfaces\ProjectRepository as ProjectRepositoryInterface;
use App\Repository\ProjectRepository;

class ProjectServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }

}
