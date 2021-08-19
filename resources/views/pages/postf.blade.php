@extends('layouts/main')

@section('head-tags') {{--For FB plugin--}}

  <meta property="og:url"           content="http://www.fuszerka.org/posts/{{$post->id}}" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Fuszerka.org" />
  <meta property="og:description"   content="{{$post->body}}" />
  <meta property="og:image"         content="http://www.fuszerka.org/img/{{$post->image}}" />

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

    </div>
  </div>


@foreach ($comments as $comment)

<div class="comment-section">
  <div class="card mb-3 comment_container">
    <div class="comment_header">
      {{ $comment->user}}

    </div>
    {{--Text of comment--}}
    <div class="comment_content ta-left"> {{ $comment->comment}} </div>
    
  </div>

    {{--replies loop--}}
    @foreach ($comment->replies as $reply)

    <div class="card mb-3 reply_container">
      <div class="comment_header">
        {{ $reply->replier }}
    
      </div>
      <div class="comment_content ta-left"> {{ $reply->reply}} </div>
    </div>

    @endforeach

</div>
  
@endforeach

<br>

@endsection