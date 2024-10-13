<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        if ($posts->isEmpty()) {
            return response()->json([
                'status' => false,
                'error' => 'Post empty',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'posts' => $posts,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ], 422);
        }

        $slug = Str::slug($request['title']);
        if (Post::where('slug', $slug)->exists()) {
            return response()->json([
                'status' => false,
                'error' => 'Title or Slug already exists',
            ], 422);
        }

        $post = Post::create([
            'title' => $request['title'],
            'slug' => $slug,
            'body' => $request['body'],
            'user_id' => $request['user_id'],
        ]);

        return response()->json([
            'status' => true,
            'error' => 'Posts create success',
            'data' => $post,
        ], 201);
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

        if (!$post) {
            return response()->json([
                'status' => false,
                'error' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'post' => $post,
        ], 200);
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

        if (!$post) {
            return response()->json([
                'status' => false,
                'error' => 'Post not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ], 422);
        }

        $slug = Str::slug($request['title']);

        if (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            return response()->json([
                'status' => false,
                'error' => 'Title or Slug already exists',
            ], 422);
        }

        $post->update([
            'title' => $request['title'],
            'slug' => $slug,
            'body' => $request['body'],
            'user_id' => $request['user_id'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post update success',
            'data' => $post,
        ], 200);
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

        if (!$post) {
            return response()->json([
                'status' => false,
                'error' => 'Post not found',
            ], 404);
        }
        try {
            $post->delete();

            return response()->json([
                'status' => true,
                'message' => 'Post delete success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => 'Someting wrong',
            ], 500);
        }
    }
}
