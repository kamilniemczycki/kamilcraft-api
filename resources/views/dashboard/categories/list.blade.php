<div class="categories">
    <header>
        <h2>Kategorie</h2>
    </header>
    <a href="{{ route('admin.category.create') }}">
        <button>Utwórz nową kategorię</button>
    </a>
    <ul class="category_items">
    @foreach ($categories as $category)
        <li class="project_element">{{ $category->name }} | <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}">Edytuj</a></li>
    @endforeach
    <ul>
</div>
