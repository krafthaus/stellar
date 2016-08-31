<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ title_case(app()->environment()) }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/stellar.css">
    @stack('stylesheets')

    <script>
        window.Stellar = {
            csrfToken: '{{ csrf_token() }}',
            user: {!! Auth::user() ? Auth::id() : 'null' !!}
        }
    </script>

</head>
<body>

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="/js/stellar.js"></script>
    @stack('javascripts')

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