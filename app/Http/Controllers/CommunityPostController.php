<?php

namespace App\Http\Controllers;

use App\Models\CommunityPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityPostController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'book_id' => 'nullable|exists:books,id',
            'community_id' => 'required|exists:community,id',
        ]);

        $post = CommunityPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'book_id' => $request->book_id,
            'community_id' => $request->community_id,
            'user_id' => $userId
        ]);

        return redirect()->back()->with('success', 'Post berhasil dibuat!');
    }

    public function likePost($postId)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        $post = CommunityPost::findOrFail($postId); // Cari post berdasarkan ID

        // Periksa apakah pengguna sudah menyukai post ini
        $existingLike = $post->usersWhoLiked()->where('user_id', $user->id)->exists();

        if ($existingLike) {
            // Jika sudah like, maka unlike (hapus like)
            $post->usersWhoLiked()->detach($user->id);
        } else {
            // Jika belum like, maka like (tambahkan like)
            $post->usersWhoLiked()->attach($user->id);
        }

        // Kembalikan ke halaman sebelumnya atau ke halaman yang diinginkan
        return redirect()->back();
    }
}
