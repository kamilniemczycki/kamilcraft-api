<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Wszystkie', 'slug' => 'all', 'default' => true, 'visible' => true],
            ['name' => 'Prywatne', 'slug' => 'private', 'priority' => 1, 'visible' => true],
            ['name' => 'Zlecenie', 'slug' => 'custom', 'priority' => 1, 'visible' => true],
            ['name' => 'Wybrane', 'slug' => 'selected', 'priority' => 1, 'visible' => true],
        ];

        foreach ($categories as $category)
            Category::query()->create($category);
    }
}
