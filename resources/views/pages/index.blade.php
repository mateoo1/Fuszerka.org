@extends('layouts/main')

@section('bdy')

{{--FB plugin--}}
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v5.0"></script>

{{--Show post if there are any--}}
@if (count($posts) > 0)

  @foreach ($posts as $post)

    @if ($post->admin_approval == 1)

      <br>

      {{--POST CARD START--}}
      <div class="card mb-3 universalForm">
        <div class="card-body"></div>

        {{--Post image--}}
        <a href="/posts/{{$post->id}}"><img class="post-image" src="/storage/img/{{$post->image}}" alt="Card image"></a>
        
        {{--FB plugin--}}
        <div class="fb-button-div">
            <div class="fb-share-button" data-href="http://fuszerka.org/posts/{{$post->id}}" data-layout="button_count" data-size="small">
              <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ffuszerka.org%2Fposts%2F{{$post->id}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Udostępnij</a>
            </div>
        </div>



        {{--Post description--}}
        <div class="card-body"><p class="card-text ta-left">{{$post->body}}</p></div>

        <div class="card-body index-padding">

          {{--Let vote only logged in users--}}
          @auth
          @if(Auth::user()->email_verified_at)

            {{--VOTING SYSTEM--}}

                {{--downvote form--}}
                <div class="pull-right inline">
                  <form class="js-downvote-form" action="/" method="GET">
                    <input type="hidden" name="negative_vote" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="submit" class="btn btn-outline-danger btn-margin" value="Fuszerka!">
                  </form>
                </div>

                @if(Auth::user()->name == 'Administrator')
                  <div class="pull-right inline">
                    <form class="pull-right inline" action="/unapprove" method="post">
                      {{csrf_field()}}
                      <input type="hidden" name="post_id" value="{{$post->id}}">
                      <input type="submit" class="btn btn-secondary" value="Queue">
                    </form>
                  </div>
                @endif

            </div>

         <div class="card-footer text-muted small"> 
            <div class="inline text-left">
              {{$post->author}} {{$post->created_at}}
          </div>
            
            <div class="inline text-right">
            
            {{--Show score - if the user posted NEGATIVE vote--}}
            @if(in_array(Auth::user()->id, explode(',', $post->negatives)))

              {{--scroes after vote--}}
              <div id="info{{ $post->id }}" class="pull-right rate">
                  <div class="downvote highlight-this">  - {{ count(explode(',', $post->negatives))-1 }} </div>
              </div>

            @else

              {{--hide scroes before vote--}}
              <div id="info{{ $post->id }}" class="pull-right rate hide">
                  <div class="downvote">  - {{ count(explode(',', $post->negatives))-1 }} </div> 
              </div>
                  
            @endif

          @endauth
          @else

          {{--If user is not logged in show only footer--}}
          <div class="card-footer text-muted small"> 
            <div class="inline text-left">
              {{$post->author}} {{$post->created_at}}
          </div>
          @endif

          {{--END VOTING SYSTEM--}}
        
            </div>
        </div>
      </div>
      {{--POST CARD END--}}

      <br>

    @endif
      
  @endforeach

  {{$posts->links()}}
    
@else

  <p>Nie ma nic do wyświetlenia</p>
    
@endif

{{--info about coookies--}}
<script src="cookieinfo.js"></script>

@endsection