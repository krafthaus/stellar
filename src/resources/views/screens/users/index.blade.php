@extends('stellar::layouts.main')

@section('sidebar')
    @include('stellar::components.sidebar')
@endsection

@section('main')

    <h3>Users</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

@stop