<?php

declare(strict_types=1);

namespace App\Repository;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepository as CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function __construct(
        private Category $category
    ) {}

    public function all()
    {
        $categories = $this->category
            ->query()
            ->orderby('priority', 'ASC')
            ->orderby('name', 'ASC')->get();
        return (new CategoryCollection($categories))->collection;
    }

    public function get(string $slug)
    {
        $category = $this->category
            ->query()
            ->where('slug', $slug)
            ->firstOrFail();
        return new CategoryResource($category);
    }

}
