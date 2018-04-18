<?php

namespace noname\Http\Controllers;

use noname\Http\Controllers\Controller;
use noname\Comment;
use noname\Post;
use noname\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'body' => 'bail|required|max:1000|min:2',
        ]);

        $post = Post::find($post_id);
        // $user = $post->user();

        $comment = new Comment();
        $comment->body = $request->input('body');
        
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id;

        // $comment->post()->associate($post);
        // $comment->user()->associate($user);

        $comment->save();

        return redirect('/posts'.'/'.$post_id)->with('success', 'Comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $comment = Comment::find($id);
        // $comment->body = $request->input('body');
        // $comment->save();
        // return redirect('/posts' . '/' . $post_id)->with('success', 'Сomment edited. NOW you\'re happy?');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();
        return redirect('/posts' . '/' . $post_id)->with('success', 'Сomment Deleted. Are you happy now?');
    }
}
