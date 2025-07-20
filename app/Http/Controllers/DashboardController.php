<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil ID dari user yang sudah di-follow oleh user yang login
        $followingIds = $user->following()->pluck('users.id');

        // Ambil user lain yang belum di-follow dan bukan diri sendiri, batasi 5
        $suggestions = User::whereNotIn('id', $followingIds)
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('dashboard', [
            'user' => $user,
            'suggestions' => $suggestions,
        ]);
    }
}
