<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBookInterest extends Model
{
    protected $table = "detail_book_interest";
    protected $fillable = [
        'bookInterestId',
        'categoryId',
    ];
}
