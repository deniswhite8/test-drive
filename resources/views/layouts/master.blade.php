<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        @yield('head')
    </head>
    <body class="@yield('body-class')">
        <div class="container">
            @yield('content')
        </div>
        <script>
            window.CSRF_TOKEN = '{!! csrf_token() !!}';
        </script>
        <script src="{{ elixir('js/bundle.js') }}"></script>
    </body>
</html>
