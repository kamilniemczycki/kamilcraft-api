<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Repository\Interfaces\ProjectRepository;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function __construct(
        private ProjectRepository $projectRepository
    ) {}

    public function index()
    {
        return $this->projectRepository->all();
    }

    public function show(int $project)
    {
        return $this->projectRepository->get($project);
    }

}
