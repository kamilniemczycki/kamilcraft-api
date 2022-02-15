@extends('layout.app')
@section('title', 'Delete project')

@section('main')
<form method="POST" action="{{ route('admin.project.destroy', compact('project')) }}">
    @method('DELETE')
    @csrf
    Czy jesteś pewien, że chcesz usunąć projekt "{{ $project->title }}"?
    <input type="submit" value="Tak, usuń!">
</form>
<div>
    <a href="{{ route('admin.project.edit', compact('project')) }}"><< Cofnij</a>
</div>
@endsection
