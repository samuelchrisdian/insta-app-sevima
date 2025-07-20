<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow(User $user)
    {
        // Tidak bisa mem-follow diri sendiri
        if (auth()->user()->id == $user->id) {
            return back()->with('error', 'Anda tidak bisa mengikuti diri sendiri.');
        }

        // Toggle: jika sudah follow, maka unfollow. Jika belum, maka follow.
        auth()->user()->following()->toggle($user->id);

        return back()->with('success', 'Status follow berhasil diperbarui.');
    }
}
