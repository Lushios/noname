@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    @if(!$post->is_default_image())
        <img style = "width:53%" src="{{$post->get_url()}}">
    @endif
    <br><br>
    <div style = "background-color:lightblue">
        <h2>{!!$post->body!!}</h2>
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by <a href = '/users/{{$post->user->id}}'>{{$post->user->name}}</a></small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="{{$post->id}}/edit" class="btn btn-default">Edit</a>

            <script>

                function ConfirmDelete()
                {
                var x = confirm("Are you sure about thats?");
                if (x)
                    return true;
                else
                    return false;
                }
                
            </script>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    <br><br>

    @if(!Auth::guest())
        {{-- {!! Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'POST']) !!} --}}
        {!! Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) !!}
            {{Form::label('body', 'Comment')}}
            {{Form::text('body', '', ['class' => 'form-control'])}}
            <br>
            {{Form::submit('Comment', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}
        
    @endif
    
    {{-- {{$comment->body}} --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($post->comments as $comment)
                <div style = "background-color:lightblue">
                    <p><h3>{{$comment->body}}</h3></p>
                </div>
                <small>Written by {{$comment->user->name}}</small>
                    @if(auth()->user()->id == $comment->user->id)
                        {!!Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    @endif
                    <br>
            @endforeach
        </div>
    </div>
@endsection