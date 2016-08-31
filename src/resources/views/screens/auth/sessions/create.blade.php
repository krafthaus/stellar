@extends('stellar::layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">

                <div class="card card-block">
                    <h4 class="card-title">Login</h4>

                    @include('stellar::components.error-alert', ['form' => 'default'])

                    <form method="post" action="{{ route('backend.sessions.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="f-email">Email address</label>
                            <input type="email" name="email" id="f-email" class="form-control" value="{{ old('email') }}" placeholder="darth.vader@empire.org">

                            @if ($errors->has('email'))
                                <span class="form-control-feedback">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="f-password">Password</label>
                            <input type="password" name="password" id="f-password" class="form-control" value="{{ old('password') }}">

                            @if ($errors->has('password'))
                                <span class="form-control-feedback">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Login</button>
                    </form>

                </div>

            </div>
        </div>
    </div>

@stop