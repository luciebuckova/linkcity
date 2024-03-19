@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include('partials.project-groups')
    @if ($projects ?? [])
        @each('partials.item-project', $projects, 'post')
    @else
        Žádné projekty..
    @endif
@endsection