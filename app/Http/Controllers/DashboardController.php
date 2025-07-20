<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $followingIds = $user->following()->pluck('users.id');

        $suggestions = User::whereNotIn('id', $followingIds)
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        $followingIds->push($user->id);
        $posts = Post::whereIn('user_id', $followingIds)
            ->with(['user', 'comments', 'likes']) // Eager load untuk performa
            ->latest()
            ->get();

        return view('dashboard', [
            'user' => $user,
            'suggestions' => $suggestions,
            'posts' => $posts,
        ]);
    }
}
