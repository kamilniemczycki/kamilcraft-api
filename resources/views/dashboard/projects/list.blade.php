<div class="projects">
    <header><h1>Projekty</h1></header>
    <a href="{{ route('admin.category.create') }}">
        <button>Utwórz nowy projekt</button>
    </a>
    <ul class="project_items">
    @foreach ($projects as $project)
        <li class="project_element">{{ $project->title }} | <a href="{{ route('admin.category.edit', ['category' => $project->id]) }}">Edytuj</a></li>
    @endforeach
    <ul>
</div>
