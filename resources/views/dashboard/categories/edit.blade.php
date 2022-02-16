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
<form class="form" method="POST" action="{{ route('admin.category.update', ['category' => $category]) }}">
    @method('PUT')
    @csrf

    <label for="name">Nazwa kategorii</label>
    <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Nazwa">
    @error('name')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="slug">Slug (opcjonalny)</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Slug">
    @error('slug')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="priority">Priority</label>
    <input id="priority" type="number" name="priority" value="{{ old('priority', $category->priority) }}" min="0">
    @error('priority')
    <span class="error">{{ $message }}</span>
    @enderror

    <div class="check-place">
        <label for="default">Default</label>
        <input id="default" type="checkbox"
            name="default" {{ old('default', $category->default) != 0 ? 'checked' : '' }}>
    </div>

    <div class="check-place">
        <label for="visible">Visible</label>
        <input id="visible" type="checkbox"
            name="visible" {{ old('visible', $category->visible) != 0 ? 'checked' : '' }}>
    </div>

    <input type="submit" value="Edytuj">
</form>
<div>
    <a href="{{ route('admin.category.delete', compact('category')) }}">USUŃ!</a><br>
    <a href="{{ route('admin.home') }}"><< Cofnij</a>
</div>
@endsection
