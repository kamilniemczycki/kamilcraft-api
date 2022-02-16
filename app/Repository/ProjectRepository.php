<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\Interfaces\ProjectRepository as ProjectRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{

    public bool $auth = false;

    public function __construct(
        private Project $project
    ) {}

    public function all(array $filters = []): Collection
    {
        $project = $this->project
            ->query()
            ->orderBy('release_data', 'ASC');

        foreach ($filters as $filter_name => $filter_value) {
            if ($filter_name === 'category' && $filter_value !== 'all')
                $project->where('categories', 'like', '%"'. $filter_value .'"%');
        }

        if (!$this->auth)
            $project->visibled();

        return (new ProjectCollection($project->get()))->collection;
    }

    public function get(int $id): ProjectResource
    {
        $project = $this->project
            ->query();

        if (!$this->auth)
            $project->visibled();

        return new ProjectResource($project->findOrFail($id));
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

        $toSave['images']['small'] = $data['image_small'] ?? '';
        $toSave['images']['medium'] = $data['image_medium'] ?? '';
        $toSave['images']['large'] = $data['image_large'] ?? '';

        if (isset($data['release_date']))
            $toSave['release_date'] = $data['release_date'];

        if (isset($data['project_url']))
            $toSave['project_url'] = $data['project_url'];

        if (isset($data['project_version']))
            $toSave['project_version'] = $data['project_version'];

        if (isset($data['description']))
            $toSave['description'] = $data['description'];

        if (isset($data['categories']) && is_array($data['categories']))
            $toSave['categories'] = $data['categories'];
        else if (isset($data['categories']) && !empty($data['categories']))
            $toSave['categories'] = explode(',', str_replace(', ', ',', $data['categories']));

        if (isset($data['images']) && is_array($data['images']))
            $toSave['images'] = $data['images'];

        if (isset($data['update_date']) && !empty($data['update_date']))
            $toSave['update_date'] = $data['update_date'];
        else
            $toSave['update_date'] = null;

        if (
            isset($data['visible']) &&
            in_array($data['visible'], ['yes', 'on', 1, true])
        ) $toSave['visible'] = true;
        else $toSave['visible'] = false;

        return $toSave;
    }

}
