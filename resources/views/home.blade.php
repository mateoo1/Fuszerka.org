@extends('layouts/app')

@section('content')
<div class="container auth-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="ta-center">
                       Witaj {{ Auth::user()->name }}! 
                       <br>Znalazłeś fuszerkę? Opisz sytuację i dodaj zdjęcie aby podzielić się z innymi.
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container auth-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                {{--Add post form--}}
                {!! Form::open(['class' => 'new-post', 'action' => 'PostsController@store', 'method' => 'POSTS', 'enctype' => 'multipart/form-data']) !!}
                    
                <div class="row justify-content-center">
                    {{--Form::label('body', '')--}}
                    {{Form::textarea('body', '', ['name'=>'body', 'class'=>'form-control tekstarea', 'rows'=>'3', 'placeholder'=>'Opis...'])}}
                </div>

                <div class="row ta-left choose-file">
                    {{Form::file('image')}}
                    <!--small id="fileHelp" class="text-muted">Wybierz zdjęcie</small-->
                </div>

                <div class="ta-center">
                {{Form::submit('DODAJ', ['class'=>'btn btn-success'])}}
                </div>
                {!! Form::close() !!}   

                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>

@if (count($posts) > 0)

  @foreach ($posts as $post)

    <br>

    {{--POST CARD START--}}
    <div class="card mb-3 universalForm">

      {{--STATUS INFO--}}
      <div class="card-body status">
        
        @if ($post->admin_approval == 0)
            <p class="status awaiting">OCZEKUJE</p>
        @elseif($post->admin_approval == 1)
          <p class="status approved">ZAAKCEPTOWANY</p>
        @else
            <p class="status rejected">ODRZUCONY</p>
            <p class="status rejected">Powód: {{$post->reject_reason}}</p>
        @endif

      </div>

      {{--<a href="/posts/{{$post->id}}"><img style="height: 100%; width: 100%; display: block;" src="/storage/img/{{$post->image}}" alt="Card image"></a>--}}
      <a href="/posts/{{$post->id}}"><img class="post-image" src="/storage/img/{{$post->image}}"></a>

      <div class="card-body">
        <p class="card-text ta-left">{{$post->body}}</p>
      </div>

      <div class="card-body inline">
        {{--Edit button--}}
        <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edytuj</a>

        {{--Delete button--}}
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=>'pull-right inline'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit('Usuń', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

      </div>

      <div class="card-footer text-muted"> {{$post->author}} {{$post->created_at}}</div>

    </div>
    {{--POST CARD END--}}

    <br>
      
  @endforeach
    
@else

  <div class="terms-header">Nie masz żadnych postów.</div>
    
@endif

@endsection