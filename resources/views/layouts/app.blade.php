<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fuszerka.org - znamy się na robocie najlepiej w internecie.">
    <meta name="keywords" content="fuszerka, fuszerka.org, robota, zabawne zdjęcia, humor">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fuszerka.org</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/ficon.png" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nosifer&display=swap" rel="stylesheet">  

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href={{asset("css/style.css")}} media="screen and (min-width: 935px)" rel="stylesheet">
    <link href={{asset("css/style-mobile.css")}} media="screen and (max-width: 935px)" rel="stylesheet">
</head>

<!-- app -->

<body>
<div id="app">

    @include('pages/navbar')
    
    <main class="MainPadding">

        @include('pages/messages')

        @yield('content')

    </main>
</div>


@yield('bdy')


<script src={{asset("js/jquery-3.3.1.slim.min.js")}}></script>
<script src={{asset("js/popper.min.js")}}></script>
<script src={{asset("js/bootstrap.min.js")}}></script>

<footer class="footer">Fuszerka &#9400 2019</footer>
</body>
</html>
