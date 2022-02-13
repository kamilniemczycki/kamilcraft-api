<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Collection;

interface ProjectRepository
{

    public function all(): Collection;
    public function get(int $id): ProjectResource;
    public function update(Project $project, array $data = []): bool;
    public function create(array $data = []): Project;

}
