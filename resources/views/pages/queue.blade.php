@extends('layouts.app')

@section('content')


@if (count($posts) > 0)

  @foreach ($posts as $post)

    @if ($post->admin_approval != 2 && $post->admin_approval != 1)
        
      <br>

      {{--POST CARD START--}}
      <div class="card mb-3 universalForm">
        <div class="card-body"></div>
        <a href="/posts/{{$post->id}}"><img class="post-image" src="/storage/img/{{$post->image}}" alt="Card image"></a>
        <div class="card-body">
          <p class="card-text ta-left">{{$post->body}}</p>
        </div>

        <div class="card-body inline">
            
          <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edytuj</a>

          {{--Delete button--}}          
          {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=>'pull-right inline'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Usuń', ['class' => 'btn btn-danger'])}}
          {!!Form::close()!!}

          {{--Show approve button if post not apporved--}}
          @if($post->admin_approval !== 1)

            <form class="pull-right inline" action="/approve" method="post">
              {{csrf_field()}}
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <input type="submit" class="btn btn-success" value="Approve">
            </form>
          
          @endif

          {{--If post approved - let unapporve--}}
          @if($post->admin_approval == 1)

            <form class="pull-right inline" action="/unapprove" method="post">
              {{csrf_field()}}
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <input type="submit" class="btn btn-secondary" value="Unapprove">
            </form>
          
          @endif

          {{--If post not rejected - display reject form--}}
          @if($post->admin_approval !=2)

            <div>
              <form class="" action="/reject" method="post">
                {{csrf_field()}}
                <input type="hidden" name="post_id" value="{{$post->id}}">
              <textarea name="reject_reason" class="reject_reason" rows="3">{{$post->reject_reason}}</textarea>
                <div><input type="submit" class="btn btn-primary" value="Reject"></div>
              </form>
            </div>
          
          {{--Display reject reason and hide reject form--}}
          @else

            <div class="rejected">
              ODRZUCONY: {{$post->reject_reason}}
            </div>
          
        @endif

      </div>
      <div class="card-footer text-muted"> {{$post->author}} {{$post->created_at}}</div>
    </div>
    {{--POST CARD END--}}

    <br>

  @endif

  @endforeach

@else

  <p>Nie masz żadnych postów.</p>
    
@endif

@endsection