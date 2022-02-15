<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController
{

    public function __construct(
        private CategoryRepository $categoryRepository
    ) {}

    public function update(CategoryRequest $request, Category $category)
    {
        $validate = $request->validated();
        if ($this->categoryRepository->update($category, $validate)) {
            return back()->with('message', 'Zaktualizowano kategorię!');
        }

        return back()->withError(['message_error', 'Wystąpił błąd podczas aktualizacji!']);
    }

    public function store(CategoryRequest $request)
    {
        $validate = $request->validated();
        if ($category = $this->categoryRepository->create($validate)) {
            return redirect()->route('admin.category.update', ['category' => $category])->with('message', 'Utworzono kategorię!');
        }

        return back()->withError(['message_error', 'Wystąpił błąd podczas tworzenia!']);
    }

    public function create(): View
    {
        return view('dashboard.categories.create');
    }

    public function edit(Category $category): View
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function delete(Category $category): View
    {
        return view('dashboard.categories.delete', compact('category'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.home')->with('message', 'Usunięto kategorię "'. $name .'"');
    }

}
