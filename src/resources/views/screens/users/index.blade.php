@extends('stellar::layouts.main')

@section('content')

    @foreach ($users as $user)
        {{ $user->name }}
    @endforeach

@stop