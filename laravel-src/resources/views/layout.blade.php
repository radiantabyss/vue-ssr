<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">

    <link href="/css/{{ $_ENV['APP_CSS'] }}" rel=preload as=style>
    <link href="/js/{{ $_ENV['APP_JS'] }}" rel=preload as=script>
    <link href="/js/{{ $_ENV['VENDORS_JS'] }}" rel=preload as=script>

    <link href="/css/{{ $_ENV['APP_CSS'] }}" rel=stylesheet>
    <link rel="icon" href="/images/favicon.png">
    <meta name="prelhive.ro" />

    @yield('header')
</head>
<body>
    <div id=app>
        @if ( is_crawler() )
            @include('layout.header')
            @yield('content')
            @include('layout.footer')
            @yield('footer')
        @endif
    </div>

    <script src="/js/{{ $_ENV['VENDORS_JS'] }}"> </script>
    <script src="/js/{{ $_ENV['APP_JS'] }}"> </script>

    @if ( $_ENV['APP_ENV'] == 'production' )
        <!-- Google tag (gtag.js) -->
    @endif
</body>
</html>
