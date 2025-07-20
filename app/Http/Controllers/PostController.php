<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments', 'likes'])->where('user_id', auth()->id())->latest()->get();

        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'caption' => 'nullable|string|max:2200',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'caption' => $validated['caption'],
        ]);

        $post->addMediaFromRequest('image')->toMediaCollection('images');

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil diunggah!');
    }

    public function show(Post $post)
    {
        // TODO: Buat view untuk detail post
    }

    public function edit(Post $post)
    {
        // TODO: Buat view untuk edit post
    }

    public function update(Request $request, Post $post)
    {
        // TODO: Implementasikan logika update
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back()->with('success', 'Postingan berhasil dihapus.');
    }
}
