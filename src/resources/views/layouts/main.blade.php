<!doctype html>
<html lang="{{ Lang::locale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ title_case(app()->environment()) }}</title>

    {{ css_assets('backend.css') }}
    <script>
        window.Stellar = {
            csrfToken: '{{ csrf_token() }}',
            user: {!! Auth::user() ? Auth::id() : 'null' !!}
        }
    </script>

</head>
<body>

    @include('stellar::components.layout.header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-2 sidebar">
                @yield('sidebar')
            </div>
            <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
                @yield('main')
            </div>
        </div>
    </div>

    {{ js_assets('backend.js') }}
    <script>
        $.fx.speeds._default = 100;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Stellar.csrfToken
            }
        });
    </script>

</body>
</html>