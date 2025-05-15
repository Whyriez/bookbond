<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityPost extends Model
{
    protected $table = "community_posts";
    protected $fillable = [
        'community_id',
        'user_id',
        'book_id',
        'title',
        'content'
    ];

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'like_community_post', 'community_post_id', 'user_id')->withTimestamps();
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
