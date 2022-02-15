<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repository\Interfaces\ProjectRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController
{

    public function __construct(
        private ProjectRepository $projectRepository
    ) {}

    public function edit(Project $project): View
    {
        return view('dashboard.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        if ($this->projectRepository->update($project, $validated)) {
            return back()->with('message', 'Zaktualizowano projekt!');
        }

        return back()->withError(['message_error', 'Wystąpił błąd podczas aktualizacji!']);
    }

    public function create(): View
    {
        return view('dashboard.projects.create');
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if ($project = $this->projectRepository->create($validated)) {
            return redirect()
                ->route('admin.project.update', compact('project'))
                ->with('message', 'Utworzono projekt!');
        }

        return back()->withError(['message_error', 'Wystąpił błąd podczas tworzenia!']);
    }

    public function delete(Project $project): View
    {
        return view('dashboard.projects.delete', compact('project'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $title = $project->title;
        $project->delete();
        return redirect()->route('admin.home')->with('message', 'Usunięto projekt "'. $title .'"');
    }

}
