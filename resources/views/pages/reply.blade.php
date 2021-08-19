@extends('layouts/main')

@section('bdy')

  <br>

  <div class="card mb-3 comment_container">
    <div class="comment_header">
      {{ $comment->user}} {{ $comment->created_at}}
    </div>
    <div class="comment_content ta-left"> {{ $comment->comment}} </div>
  </div>

<div class="PostCommentForm">
  <form action="{{action('HomeController@reply')}}" method="POST">
    <div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <input type="hidden" name="post_id" value="{{ $post_id }}">
    <input type="hidden" name="user" value="{{ Auth::user()->name }}">
    <textarea class="form-control tekstarea" rows="3" name="reply"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="Wyślij">
  </form>
</div>

@endsection