@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">To Blog</a>
    @if(auth()->user()->id !== $user->id)
        <h3>Hello there! My name is {{$user->name}}.</h3>
        <br>
        <h3><font color="blue">Bio</font></h3>
        @if($user->bio == null)
        <h4>True nonames never provide bios they say. So I didn't either.</h4>
        @else
        <h4>{{$user->bio}}</h4>
        @endif
        <br>
        @if($user->posts->count() !== 0)
            <h3>Here are my posts:</h3>
            <table class = "table table-striped">
                <tr>
                    <td>Title</td>
                    <td></td>
                    <td></td>
                </tr>
                    @foreach($user->posts as $post)
                        <tr>
                            <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                        </tr>
                    @endforeach
            </table>
        @else
            <h3>Oh, and I have no posts yet.</h3>
        @endif
    @else
        <script>window.location = "/home";</script>
    @endif
@endsection