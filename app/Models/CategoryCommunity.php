<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCommunity extends Model
{
   protected $table = "category_community";
    protected $fillable = [
        'community_id',
        'category_id'
    ];
}
