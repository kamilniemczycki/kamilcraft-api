<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{

    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function index(): Collection
    {
        return $this->categoryRepository->all();
    }

    public function showWhereSlug(string $category): CategoryResource
    {
        return $this->categoryRepository->get($category);
    }

}
