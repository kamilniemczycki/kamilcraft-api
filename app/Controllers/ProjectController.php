<?php

namespace KamilCraftApi\App\Controllers;

use KamilCraftApi\App\Models\Project;
use KamilCraftApi\Response;

class ProjectController extends Controller
{
    private Project $project;

    public function __construct()
    {
        parent::__construct();
        $this->project = new Project();
    }

    public function showWhereCategory(string $category): Response
    {
        $projects = $this->project->getProjectWhereCategory($category);
        return (new Response())->json($projects);
    }

    public function show(int $id): Response
    {
        if ( ! ($project = $this->project->getProject($id)) ) {
            return (new Response())->json([
                'message' => 'Not found project'
            ], 404);
        }
        return (new Response())->json($project);
    }

    public function __invoke(): Response
    {
        $projects = $this->project;
        return (new Response())->json($projects());
    }
}
