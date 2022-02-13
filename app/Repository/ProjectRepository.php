<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\Interfaces\ProjectRepository as ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function __construct(
        private Project $project
    ) {}

    public function all()
    {
        $project = $this->project
            ->query()
            ->orderBy('release_data', 'ASC')
            ->get();
        return (new ProjectCollection($project))->collection;
    }

    public function get(int $id)
    {
        $project = $this->project
            ->query()
            ->findOrFail($id);
        return new ProjectResource($project);
    }

}
