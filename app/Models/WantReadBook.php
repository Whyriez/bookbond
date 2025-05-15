<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WantReadBook extends Model
{
    protected $table = "want_read_book";
    protected $fillable = [
        'bookId',
        'userId',
        'isRead',
    ];
}
