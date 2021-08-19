@extends('layouts/main')

@section('head-tags') {{--For FB plugin--}}

  <meta property="og:url"           content="http://www.fuszerka.org/posts/{{$post->id}}/" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Fuszerka.org" />
  <meta property="og:description"   content="{{$post->body}}" />
  <meta property="og:image"         content="http://www.fuszerka.org/img/{{$post->image}}/" />

@endsection

@section('bdy')

  {{-- Load Facebook SDK for JavaScript --}}
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <br>

  <div class="card universalFormBig">
    <div> <img class="post-image" src="/storage/img/{{$post->image}}"> </div>

      {{--FB share button--}}
      <div class="fb-share-button fb-button-div" 
        data-href="http://fuszerka.org/posts/{{$post->id}}" 
        data-layout="button_count">
      </div>

    <div class="post_text ta-left"> <p> {{$post->body}} </p> </div>
    <div class="comment_header"> 
        {{$post->author}} {{$post->created_at}}

      {{--notify button--}}
        <div class="inline comment-action">
            <form action="{{action('HomeController@notify')}}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              <input type="hidden" name="author" value="{{$post->author}}">
              <input type="hidden" name="date" value="{{$post->created_at}}">
              <input type="hidden" name="user" value="{{ Auth::user()->name }}">
              <input type="submit" class="inline comment-action" value="zgłoś">
            </form>
          </div>
    </div>
  </div>

  {{--comments form--}}
  <div class="PostCommentForm">
    <form action="/comment" method="POST">
      <div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="user" value="{{ Auth::user()->name }}">
        <textarea class="form-control tekstarea" rows="3" name="comment" placeholder="Wpisz swój komentarz..."></textarea>
      </div>
      <input type="submit" class="btn btn-primary" value="Wyślij">
    </form>
  </div>

@foreach ($comments as $comment)

<div class="comment-section">
  <div class="card mb-3 comment_container">
    <div class="comment_header">
      {{ $comment->user}}

      {{--Only admin or author can delete comment--}}
      @if (Auth::user()->name == $comment->user || Auth::user()->name == "Administrator")
        <div class="inline comment-action">
          <form action="{{action('HomeController@comment_delete')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <input type="submit" class="inline comment-action" value="usuń">
          </form>
        </div>
      @endif

      {{--unregistered user cannot reply--}}
      @auth
        <div class="inline comment-action"><a class="inline comment-action" href="{{ url('reply/'. $post->id .'/'. $comment->id .'/') }}">odpowiedz</a></div>
      @endauth

    </div>
    {{--Text of comment--}}
    <div class="comment_content ta-left"> {{ $comment->comment}} </div>
    
  </div>

    {{--replies loop--}}
    @foreach ($comment->replies as $reply)

    <div class="card mb-3 reply_container">
      <div class="comment_header">
        {{ $reply->replier}}

        {{--Only admin or author can delete reply--}}
        @if ($reply->replier == Auth::user()->name || Auth::user()->name == "Administrator")
        <div class="inline comment-action">
          <form action="{{action('HomeController@reply_delete')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
            <input type="submit" class="inline comment-action" value="usuń">
          </form>
        </div>
      @endif
    
      </div>
      <div class="comment_content ta-left"> {{ $reply->reply}} </div>
    </div>

    @endforeach

</div>
  
@endforeach

<br>

@endsection