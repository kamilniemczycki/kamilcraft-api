<div class="projects">
    <header>
        <h2>Projekty</h2>
    </header>
    <a href="{{ route('admin.project.create') }}">
        <button>Utwórz nowy projekt</button>
    </a>
    <ul class="project_items">
    @foreach ($projects as $project)
        <li class="project_element">{{ $project->title }} | <a href="{{ route('admin.project.edit', compact('project')) }}">Edytuj</a></li>
    @endforeach
    <ul>
</div>
