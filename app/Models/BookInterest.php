<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookInterest extends Model
{
    protected $table = "book_interest";
    protected $fillable = [
        'userId',
        'detailInterestId',
    ];
}
