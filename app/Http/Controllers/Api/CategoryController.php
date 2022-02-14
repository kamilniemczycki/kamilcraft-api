<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Repository\Interfaces\CategoryRepository;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

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
