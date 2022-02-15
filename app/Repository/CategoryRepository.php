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

    public bool $auth = false;

    public function __construct(
        private Category $category
    ) {}

    public function all(): Collection
    {
        $categories = $this->category
            ->query()
            ->orderby('priority', 'ASC')
            ->orderby('name', 'ASC');

        if (!$this->auth)
            $categories->visibled();

        return (new CategoryCollection($categories->get()))->collection;
    }

    public function get(string $slug): CategoryResource
    {
        $category = $this->category
            ->query()
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$this->auth)
            $category->visibled();

        return new CategoryResource($category);
    }

    public function update(Category $category, array $data = []): bool
    {
        $data = $this->parseToArray($data);
        if (!$category->default && isset($data['default']) && $data['default'] === true)
            $this->unsetDefault();

        return $category
            ->update($data);
    }

    public function create(array $data = []): Category
    {
        $data = $this->parseToArray($data);
        if (isset($data['default']) && $data['default'] === true)
            $this->unsetDefault();

        return $this->category
            ->query()
            ->create($data);
    }

    private function unsetDefault(): void
    {
        $this->category
            ->query()
            ->where('default', true)
            ->first()?->update(['default' => false]);
    }

    private function parseToArray(array $data = []): array
    {
        $toSave = [];

        if (isset($data['name']) && !empty($data['name']))
            $toSave['name'] = $data['name'];
        if (isset($data['slug']) && !empty($data['slug']))
            $toSave['slug'] = $data['slug'];
        if (isset($data['priority']) && !is_integer($data['priority']))
            $toSave['priority'] = (int)$data['priority'];

        if (
            isset($data['default']) &&
            in_array($data['default'], ['yes', 'on', 1, true])
        ) $toSave['default'] = true;
        else $toSave['default'] = false;

        if (
            (isset($toSave['default']) && $toSave['default'] === true) ||
            (isset($data['visible']) &&
            in_array($data['visible'], ['yes', 'on', 1, true]))
        ) $toSave['visible'] = true;
        else $toSave['visible'] = false;

        return $toSave;
    }

}
