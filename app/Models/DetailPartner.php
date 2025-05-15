<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPartner extends Model
{
    protected $table = "detail_partner";
    protected $fillable = [
        'userId',
        'shop_name',
        'personal_email',
        'phone_number',
        'address',
        'city',
        'zip',
        'website',
        'short_description',
        'bussiness_hours',
        'logo',
    ];

    public function bookCategories()
    {
        return $this->hasMany(BookCategoriesPartner::class, 'partnerId', 'userId');
    }

    public function serviceOffers()
{
    return $this->hasMany(ServiceOfferPartner::class, 'partnerId', 'userId');
}
}
