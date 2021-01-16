<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(20); // collection

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

}
