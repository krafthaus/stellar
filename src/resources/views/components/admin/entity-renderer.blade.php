@extends('stellar::layouts.main')

@section('content')

    <div class="container">
        @foreach ($entity->mapper->children as $child)
            {!! $child->render() !!}
        @endforeach
    </div>

@stop