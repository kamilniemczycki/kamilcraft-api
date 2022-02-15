@extends('layout.app')
@section('title', 'Login')

@section('main')
<form method="POST" action="{{ route('admin.category.destroy', compact('category')) }}">
    @method('DELETE')
    @csrf
    Czy jesteś pewien, że chcesz usunąć kategorię "{{ $category->name .' - '. $category->slug }}"?
    <input type="submit" value="Tak, usuń!">
</form>
<div>
    <a href="{{ route('admin.category.edit', compact('category')) }}"><< Cofnij</a>
</div>
@endsection
