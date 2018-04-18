@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Dashboard of <strong>{{auth()->user()->name}}</strong> the mighty</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>

                    {{-- bio --}}
                    {!! Form::open(['route' => ['users.store'], 'method' => 'POST']) !!}

                        <div class="form-group">
                            {{Form::label('bio', 'Bio')}}
                            {{Form::text('bio', auth()->user()->bio, ['class' => 'form-control'])}}
                        </div>

                    {!!Form::submit('Update Bio', ['class' => 'btn btn-primary'])!!}
                    {!! Form::close() !!}
                    <br><br>
                    <a href = "/posts/create", class = "btn btn-primary">Create Post</a>
                    @if(count($posts) > 0)
                    <h3>Your posts</h3>
                        <table class = "table table-striped">
                            <tr>
                                <td>Title</td>
                                <td></td>
                                <td></td>
                            </tr>
                            {{-- ARE YOU SURE ABOUT THAT --}}
                            <script>

                                function ConfirmDelete()
                                {
                                var x = confirm("Are you sure you want to delete?");
                                if (x)
                                    return true;
                                else
                                    return false;
                                }
                                
                            </script>

                                @foreach($posts as $post)
                                    <tr>
                                        <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                        <td><a href = "/posts/{{$post->id}}/edit" class = "btn btn-default">Edit</a></td>
                                        <td>
                                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    @else
                        <h2>It's quiet here. Too quiet..</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
