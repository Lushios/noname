@extends('layouts.app')

@section('content')
<h1>Edit post</h1>
{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>

    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
    </div>
    <div class="form-group">
    </div>
    {{Form::hidden('_method', 'PUT')}}
    <div class="form-group">
            {{Form::file('post_image')}}
    </div>
    @if (!$post->is_default_image())
        <img width=25% src="{{$post->get_url()}}"/>
        <br><br>
        {{Form::label('delete_image', "Delete image?")}}
        {{Form::checkbox('delete_image', 1, false, ['id' => 'delete-image', 'class' => 'pull-left'])}}
        <br><br>
    @endif
{!!Form::submit('Submit', ['class' => 'btn btn-primary'])!!}
{!! Form::close() !!}

@endsection 