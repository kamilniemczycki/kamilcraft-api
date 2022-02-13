<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\Interfaces\ProjectRepository as ProjectRepositoryInterface;
use Illuminate\Support\Carbon;

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

    public function add(array $data)
    {
        $toSave = [
            'title' => $data['title'],
            'author' => $data['author'],
            'release_date' => Carbon::createFromFormat('Y-d-m', $data['release_date']),
            'project_url' => $data['project_url'],
            'project_version' => $data['project_version'],
            'description' => $data['description']
        ];

        if (is_array($data['categories']))
            $toSave['categories'] = $data['categories'];

        if (is_array($data['images']))
            $toSave['images'] = $data['images'];

        if (!empty($data['update_date']))
            $toSave['update_date'] = Carbon::createFromFormat('Y-d-m', $data['update_date']);

        $this->project
            ->query()
            ->create($toSave);
    }

}
