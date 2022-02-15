@extends('layout.app')
@section('title', 'Utwórz kategorię')

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
<form class="form" method="POST" action="{{ route('admin.category.store') }}">
    @csrf

    <label for="name">Nazwa kategorii</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nazwa">
    @error('name')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="slug">Slug (opcjonalny)</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug') }}" placeholder="Slug">
    @error('slug')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="priority">Priority</label>
    <input id="priority" type="number" name="priority" value="{{ old('priority', 0) }}" min="0">
    @error('name')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="default">Default</label>
    <input id="default" type="checkbox" name="default" {{ old('default') != 0 ? 'checked' : '' }}>

    <label for="visible">Visible</label>
    <input id="visible" type="checkbox" name="visible" {{ old('visible') != 0 ? 'checked' : '' }}>

    <input type="submit" value="Utwórz">
</form>
<div>
    <a href="{{ route('admin.home') }}"><< Cofnij</a>
</div>
@endsection
