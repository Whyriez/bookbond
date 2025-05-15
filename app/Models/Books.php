<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = "books";
    protected $fillable = [
        'name',
        'author',
        'publisher',
        'publication_date',
        'language',
        'print_length',
        'ISBN-10',
        'ISBN-13',
        'description',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(CategoryBook::class, 'detail_category', 'bookId', 'categoryId');
    }
}
