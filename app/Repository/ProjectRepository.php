<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\Interfaces\ProjectRepository as ProjectRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function __construct(
        private Project $project
    ) {}

    public function all(): Collection
    {
        $project = $this->project
            ->query()
            ->orderBy('release_data', 'ASC')
            ->get();
        return (new ProjectCollection($project))->collection;
    }

    public function get(int $id): ProjectResource
    {
        $project = $this->project
            ->query()
            ->findOrFail($id);
        return new ProjectResource($project);
    }

    public function update(Project $project, array $data = []): bool
    {
        $data = $this->parseToArray($data);

        return $project
            ->update($data);
    }

    public function create(array $data = []): Project
    {
        $data = $this->parseToArray($data);

        return $this->project
            ->query()
            ->create($data);
    }

    private function parseToArray(array $data = []): array
    {
        $toSave = [];

        if (isset($data['title']))
            $toSave['title'] = $data['title'];

        if (isset($data['author']))
            $toSave['author'] = $data['author'];

        if (isset($data['release_date']))
            $toSave['release_date'] = Carbon::createFromFormat('Y-d-m', $data['release_date']);

        if (isset($data['project_url']))
            $toSave['project_url'] = $data['project_url'];

        if (isset($data['project_version']))
            $toSave['project_version'] = $data['project_version'];

        if (isset($data['description']))
            $toSave['description'] = $data['description'];

        if (isset($data['categories']) && is_array($data['categories']))
            $toSave['categories'] = $data['categories'];

        if (isset($data['images']) && is_array($data['images']))
            $toSave['images'] = $data['images'];

        if (isset($data['update_date']) && !empty($data['update_date']))
            $toSave['update_date'] = Carbon::createFromFormat('Y-d-m', $data['update_date']);

        return $toSave;
    }

}
