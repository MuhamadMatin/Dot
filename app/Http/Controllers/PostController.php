<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $search = $request['search'];
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
        }

        $posts = $query->paginate(15);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $slug = Str::slug($request['title']);

        if ($validator->fails()) {
            return redirect()->route('posts.create')->withErrors($validator);
        }

        $post = Post::create([
            'user_id' => $userId,
            'title' => $request['title'],
            'slug' => $slug,
            'body' => $request['body'],
        ]);

        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $findPost = Post::find($post);
        if (!$findPost) {
            return redirect()->route('posts.index')->withSuccess(['Errors', 'USer not Found']);
        }

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $slug = Str::slug($request['title']);

        if ($validator->fails()) {
            return redirect()->route('posts.edit', $post)->withErrors($validator);
        }

        $post->update([
            'title' => $request['title'],
            'slug' => $slug,
            'body' => $request['body'],
        ]);

        return redirect()->route("posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $findPost = Post::find($post);
        if (!$findPost) {
            return redirect()->route('posts.index')->withSuccess(['Errors', 'Post not Found']);
        }
        $post->delete();

        return redirect()->route('posts.index');
    }
}
