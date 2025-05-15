<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategoriesPartner extends Model
{
    protected $table = "book_categories_partner";
    protected $fillable = [
        'partnerId',
        'name'
    ];

    public function partner()
    {
        return $this->belongsTo(DetailPartner::class, 'partnerId', 'id');
    }
}
