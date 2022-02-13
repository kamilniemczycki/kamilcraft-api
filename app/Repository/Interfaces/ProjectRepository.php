<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

interface ProjectRepository
{

    public function all();
    public function get(int $id);

}
