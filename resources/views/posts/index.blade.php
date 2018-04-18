@extends('layouts.app')

@section('content')
<h1>Posts</h1>
<a href = "/posts/create", class = "btn btn-primary">Create Post</a>
<br><br>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div clas="well">
                <div class = "row">
                    <div class = "col-md-4 col-sm-4">
                    <img style = "width:90%" src="/storage/post_images/{{$post->post_image}}">
                    </div>
                    <div class = "col-md-8 col-sm-8">
                        <h2><a href = "/posts/{{$post->id}}">{{$post->title}}</a></h2>
                    <small>Written on {{$post->created_at}} by <a href = '/users/{{$post->user->id}}'>{{$post->user->name}}</a></small>
                    </div>
                </div>
               
            </div>
            <br>
        @endforeach
    @else 
        <p>It's quiet. Too quiet....</p>
    @endif
@endsection