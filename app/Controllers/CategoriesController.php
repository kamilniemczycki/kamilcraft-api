<?php

namespace KamilCraftApi\App\Controllers;

use KamilCraftApi\App\Models\Category;
use KamilCraftApi\Request\Request;
use KamilCraftApi\Response;

class CategoriesController extends Controller
{
    private Category $category;

    public function __construct(Request $request) {
        parent::__construct();
        $this->category = new Category($request);
    }

    public function showWhereName(string $slug): Response
    {
        if ( ! ($category = $this->category->getCategoryWhereName($slug)) ) {
            return (new Response())->json([
                'message' => 'Not found category'
            ], 404);
        }
        return (new Response())->json($category);
    }

    public function show(int $id): Response
    {
        if ( ! ($category = $this->category->getCategory($id)) ) {
            return (new Response())->json([
                'message' => 'Not found category'
            ], 404);
        }
        return (new Response())->json($category);
    }

    public function __invoke(): Response
    {
        $categories = $this->category;
        return (new Response())->json($categories());
    }
}
