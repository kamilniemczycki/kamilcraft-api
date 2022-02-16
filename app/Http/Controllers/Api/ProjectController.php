<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Repository\Interfaces\ProjectRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct(
        private ProjectRepository $projectRepository
    ) {}

    public function index(Request $request)
    {
        $request->validate([
            'category' => 'nullable|string|exists:categories,slug'
        ]);
        $filters = [];
        if ($request->has('category') && ($category = $request->get('category')) !== '') {
            $filters['category'] = $category;
        }

        return $this->projectRepository->all($filters);
    }

    public function show(int $project)
    {
        return $this->projectRepository->get($project);
    }

}
