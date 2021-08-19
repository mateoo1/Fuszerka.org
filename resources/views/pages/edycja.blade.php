@extends('layouts/main')

@section('bdy')

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
    
                        <div class="ta-left">
                                Tutaj możesz zmienić swój post oraz zdjęcie. Jeżeli nie dodasz nowego zdjęcia pozostanie ono nie zmienione.
                                Edycja posta spowoduje cofnięcie go do <u>ponownej weryfikacji</u>
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
                    {!! Form::open(['class' => 'new-post', 'action' => ['PostsController@update', $post->id], 'method' => 'POSTS', 'enctype' => 'multipart/form-data']) !!}
    
                    <div class="row justify-content-center">
                        {{--Form::label('body', '')--}}
                        {{Form::textarea('body', $post->body, ['name'=>'body', 'class'=>'form-control tekstarea', 'rows'=>'15'])}}

                    </div>
    
                    <div class="row justify-content-center choose-file">
                        {{Form::file('image')}}
                        <small id="fileHelp" class="text-muted">Dodaj nowe zdjęcie aby podmienić poprzednie.</small>
                    </div>
    
                    <div class="ta-center">
                            <a href="/home" class="btn btn-primary">Anuluj</a>
                            {{{Form::hidden('_method', 'PUT')}}}
                            {{Form::submit('Zapisz', ['class'=>'btn btn-primary'])}}
                    </div>

                    {!! Form::close() !!}   
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

@endsection