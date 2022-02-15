@extends('layout.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    #main {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        column-gap: 1em;
    }
    #main .projects {
        grid-column: 1 / 3;
    }
</style>
@endpush

@section('main')
@if(\Session::has('message'))
    <span>{{ \Session::get('message') }}</span>
@endif
@include('dashboard.projects.list')
@include('dashboard.categories.list')
@endsection
