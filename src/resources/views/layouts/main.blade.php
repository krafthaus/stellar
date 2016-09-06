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

    @yield('content')

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