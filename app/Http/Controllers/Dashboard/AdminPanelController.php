<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\CategoryRepository;
use App\Repository\Interfaces\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPanelController extends Controller
{

    public function __construct(
        private CategoryRepository $categoryRepository,
        private ProjectRepository $projectRepository
    ) {
        $this->categoryRepository->auth = true;
    }

    public function __invoke(Request $request): View
    {
        $categories = $this->categoryRepository->all();
        $projects = $this->projectRepository->all();

        return view('dashboard.home', compact('categories', 'projects'));
    }

}
