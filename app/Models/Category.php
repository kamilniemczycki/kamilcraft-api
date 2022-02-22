<?php

namespace KamilCraftApi\App\Models;

use KamilCraftApi\Request\Request;
use KamilCraftApi\Response;
use stdClass;

class Category
{
    const JSON_PATH = ROOT_PATH . 'resources/json';
    private array $allCategory = [];

    public function __construct(
        private Request $request
    ) {
        $categories = file_get_contents(self::JSON_PATH . '/Categories.json');
        if ( $category = json_decode($categories) ) {
            $this->allCategory = $category;
        } else {
            $this->parseError();
        }
    }

    public function getCategoryWhereName(string $slug): object|bool
    {
        if ( ( $key = array_search($slug, array_column($this->allCategory, 'slug') ) ) !== false ) {
            $category = $this->allCategory[$key];
            $category->default = $category->default ?? false;
            $category->visible = $category->visible ?? true;
            return $category;
        }
        return false;
    }

    public function getCategory(int $id): object|bool
    {
        if ( ( $key = array_search($id, array_column($this->allCategory, 'id') ) ) !== false ) {
            $category = $this->allCategory[$key];
            $category->default = $category->default ?? false;
            $category->visible = $category->visible ?? true;
            return $category;
        }
        return false;
    }

    private function parseError(): void
    {
        if ( $this->request->getContentType() === 'application/json' ) {
            (new Response())->json((object)[
                'message' => 'Server error'
            ], 500)->render();
        } else {
            (new Response())(
                file_get_contents(ROOT_PATH . '/errors/error500.html'),
                500
            )->render();
        }
        exit;
    }

    public function __invoke(): array
    {
        $tmp_categories = [];
        foreach ($this->allCategory as $category) {
            $tmp_category = new stdClass;
            $tmp_category->id = $category->id;
            $tmp_category->name = $category->name;
            $tmp_category->slug = $category->slug;
            $tmp_category->default = $category->default ?? false;
            $tmp_category->visible = $category->visible ?? true;

            $tmp_categories[] = $tmp_category;
        }

        return $tmp_categories;
    }
}
