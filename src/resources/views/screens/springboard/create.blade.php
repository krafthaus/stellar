@extends('stellar::layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">

                <div class="card card-block">
                    <h4 class="card-title">Create the first website</h4>

                    @include('stellar::components.error-alert', ['form' => 'default'])

                    <form method="post" action="{{ route('backend.springboard.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="f-name">The name of the website</label>
                            <input type="text" name="name" id="f-name" class="form-control" value="{{ old('name') }}" placeholder="The empire">

                            @if ($errors->has('name'))
                                <span class="form-control-feedback">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('domain') ? ' has-danger' : '' }}">
                            <label for="f-domain">What is the website's domain?</label>
                            <input type="text" name="domain" id="f-domain" class="form-control" value="{{ old('domain') }}" placeholder="the-empire.org">

                            @if ($errors->has('domain'))
                                <span class="form-control-feedback">
                                    {{ $errors->first('domain') }}
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Create website</button>

                    </form>

                </div>

            </div>
        </div>
    </div>

@stop