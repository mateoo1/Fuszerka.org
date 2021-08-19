<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Fuszerka.org</title>
  <meta name="description" content="Fuszerka.org - znamy się na robocie najlepiej w internecie.">
  <meta name="keywords" content="fuszerka, fuszerka.org, robota, zabawne zdjęcia, humor">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" type="image/x-icon" href="/img/ficon.png" />
  <link href="https://fonts.googleapis.com/css?family=Nosifer&display=swap" rel="stylesheet">  
  <link href={{asset("css/bootstrap.css")}} rel="stylesheet">
  <link href={{asset("css/style.css")}} media="screen and (min-width: 935px)" rel="stylesheet">
  <link href={{asset("css/style-mobile.css")}} media="screen and (max-width: 935px)" rel="stylesheet">
  <link href={{asset("css/cookieinfo.css")}} rel="stylesheet">
  {{--FB plugin tags--}}
  @yield('head-tags')
</head>

<body>

  <div id="app">
    @include('pages/navbar')
  </div>

<div class="PostPadding">
  @include('pages/messages')
  @yield('bdy')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src={{asset("js/popper.min.js")}}></script>
<script src={{asset("js/bootstrap.min.js")}}></script>
<script src={{asset("js/main.js")}}></script>
<script src={{asset("js/cookieinfo.js")}}></script>

<footer class="footer">Fuszerka &#9400 2019</footer>
</body>

</html>