<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

interface CategoryRepository
{

    public function all();
    public function get(string $slug);

}
