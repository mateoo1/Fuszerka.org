@extends('layouts/main')

@section('bdy')

<div class="notify-container">

  <div class="notify-desc">
    <br>Aby zgłosić swoje zastrzeżenia do posta napisz wiadomość na <b>info@fuszerka.org</b>. Przekażemy Twoją wiadomość autorowi posta. Jeżeli w ciągu 24h od przekazania wiadomości autor posta nie odpowie, post może zostać zawieszony do momentu wyjaśnienia sprawy.
    <br>
    <br>Dla ułatwienia możesz skopiować poniższy wzór wiadomości.
  </div>

  <div class="notify-template">
    Witam,
    <br>
    <br>Zgłaszam zastrzeżenia odnośnie posta nr {{$info[0]}} autorstwa użytkownika {{$info[1]}} przesłanego {{$info[3]}}.
    <br>
    <br>[ Treść twoich zastrzeżeń ]
    <br>
    <br>Pozdrawiam,
    <br>{{$info[2]}}
  </div>
<div>

@endsection