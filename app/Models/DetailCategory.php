<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailCategory extends Model
{
    protected $table = "detail_category";
    protected $fillable = [
        'bookId',
        'categoryId'
    ];
}
