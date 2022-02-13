<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct(
        private ProjectRepository $projectRepository
    ) {}

    public function index()
    {

    }

    public function show()
    {

    }

}
