<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        // eager loading users and likes since our model has relationships set
        $posts = Post::with(['user', 'likes'])->orderBy('id', 'desc')->paginate(20); // collection

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        // Post::create([
        //     'user_id' => auth()->user()->id,
        //     'body' => $request->body
        // ]);

            // $request->user()->posts()->create([
            //     'body' => $request->body
            // ]);

            $request->user()->posts()->create($request->only('body'));

            return back();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
