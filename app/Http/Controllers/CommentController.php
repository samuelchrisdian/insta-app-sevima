<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body']
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
