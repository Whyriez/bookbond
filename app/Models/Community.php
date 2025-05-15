<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = "community";
    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(CategoryBook::class, 'category_community', 'community_id', 'category_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user', 'community_id', 'user_id'); // Define pivot table
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function communityPosts()
    {
        return $this->hasMany(CommunityPost::class);
    }
}
