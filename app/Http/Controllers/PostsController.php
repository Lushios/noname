<?php

namespace noname\Http\Controllers;

use Illuminate\Http\Request;
use noname\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('posts.index') -> with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    public function save_post(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'bail|required|string|max:30',
            'body' => 'bail|required',
            'post_image' => 'image|nullable|max:1999'
        ]);

        //File upload being handled here, please stay quiet
        if($request->hasFile('post_image'))
        {
            $filenamewithext = $request->file('post_image')->getClientOriginalName();
            $filenamenoext = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $extension = $request->file('post_image') -> getClientOriginalExtension();
            //adding a timestamp for unique names
            $filenametostore = $filenamenoext . '_' . time() . '.' . $extension;
            $path = $request->file('post_image')->storeAs('public/post_images', $filenametostore); 
        }
        else
        {            
            if($request->input('delete_image') || !$post->post_image)
            {
                $filenametostore = 'default.png';
            } else {
                $filenametostore = $post->post_image;
            }
        }
        
        //magic of post birth

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->post_image = $filenametostore;
        $post->save();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $this->save_post($request, $post);
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            return redirect('/posts') -> with('error', 'just why?');
        }
        
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts') -> with('error', 'Don\'t you dare');
        }

        return view('posts/edit')->with('post', $post);
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
        $post = Post::find($id);
        $this->save_post($request, $post);

        return redirect('/posts')->with('success', 'Post Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $id)
        {
            return redirect('/posts') -> with('error', 'Don\'t you dare');
        }

        if(!$post->is_default_image())
        {
            Storage::delete('public/post_images/' . $post->post_image);
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted. Are you happy now?');
    }
}
