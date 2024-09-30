<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store (Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category = $request->category;
        $post->img_url = $request->image;
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function show($id)
    {
        $post = Post::find($id);
        return Inertia::render('Posts/Post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->route('posts.index');   
    }

    public function uploadImage(Request $request)
{
    
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $request->validate([
            'image' => 'required|image|max:51200', 
        ]);

        $image = $request->file('image');
        $filePath = Storage::putFile('images', $image);
       
        return response()->json(['file_path' => $filePath]);
    } else {
        return response()->json(['error' => 'No se ha enviado ninguna imagen válida'], 422);
    }
}

}
