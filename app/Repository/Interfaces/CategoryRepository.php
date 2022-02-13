<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepository
{

    public function all(): Collection;
    public function get(string $slug): CategoryResource;
    public function update(Category $category, array $data = []): bool;
    public function create(array $data = []): Category;

}
