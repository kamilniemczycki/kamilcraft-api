@extends('layout.app')
@section('title', 'Login')

@section('main')
@if (\Session::has('message'))
    <span>{{ \Session::get('message') }}</span>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form" method="POST" action="{{ route('admin.project.update', compact('project')) }}">
    @method('PUT')
    @csrf

    <label for="title">Tytuł projektu</label>
    <input id="title" type="text" name="title" value="{{ old('title', $project->title) }}" placeholder="Tytuł">
    @error('title')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="author">Autor</label>
    <input id="author" type="text" name="author" value="{{ old('author', $project->author) }}" placeholder="Imię i nazwisko">
    @error('author')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="categories">Kategorie</label>
    <input id="categories" type="text" name="categories" value="{{ old('categories', implode(', ', $project->categories)) }}" placeholder="kategoria1, kategoria2">
    @error('categories')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="release_date">Data wydania</label>
    <input id="release_date" type="date" name="release_date" value="{{ old('release_date', $project->release_date) }}">
    @error('release_date')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="update_date">Data aktualizacji</label>
    <input id="update_date" type="date" name="update_date" value="{{ old('update_date', $project->update_date) }}">
    @error('update_date')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="project_url">Adres projektu</label>
    <input id="project_url" type="text" name="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="Adres www">
    @error('project_url')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="project_version">Wersja projektu</label>
    <input id="project_version" type="text" name="project_version" value="{{ old('project_version', $project->project_version) }}" placeholder="v1.0.0">
    @error('project_version')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="description">Opis</label>
    <textarea id="description" name="description" placeholder="Ładny opis projektu">{{ old('description', $project->description) }}</textarea>
    @error('description')
    <span class="error">{{ $message }}</span>
    @enderror

    <div class="check-place">
        <label for="visible">Visible</label>
        <input id="visible" type="checkbox" name="visible" {{ old('visible') != 0 ? 'checked' : '' }}>
    </div>

    <input type="submit" value="Aktualizuj">
</form>
<div>
    <a href="{{ route('admin.project.delete', compact('project')) }}">USUŃ!</a><br>
    <a href="{{ route('admin.home') }}"><< Cofnij</a>
</div>
@endsection
