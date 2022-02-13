<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepository as CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function __construct(
        private Category $category
    ) {}

    public function all(): Collection
    {
        $categories = $this->category
            ->query()
            ->orderby('priority', 'ASC')
            ->orderby('name', 'ASC')->get();
        return (new CategoryCollection($categories))->collection;
    }

    public function get(string $slug): CategoryResource
    {
        $category = $this->category
            ->query()
            ->where('slug', $slug)
            ->firstOrFail();
        return new CategoryResource($category);
    }

    public function update(Category $category, array $data = []): bool
    {
        $data = $this->parseToArray($data);
        return $category
            ->update($data);
    }

    public function create(array $data = []): Category
    {
        $data = $this->parseToArray($data);
        return $this->category
            ->query()
            ->create($data);
    }

    private function parseToArray(array $data = []): array
    {
        $toSave = [];

        if (isset($data['name']) && !empty($data['name']))
            $toSave['name'] = $data['name'];
        if (isset($data['slug']) && !empty($data['slug']))
            $toSave['slug'] = $data['slug'];
        if (isset($data['default']) && is_bool($data['default']))
            $toSave['default'] = $data['default'];
        if (isset($data['visible']) && is_bool($data['visible']))
            $toSave['visible'] = $data['visible'];

        return $toSave;
    }

}
