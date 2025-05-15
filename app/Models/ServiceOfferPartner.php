<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOfferPartner extends Model
{
    protected $table = "service_offered_partner";
    protected $fillable = [
        'partnerId',
        'name'
    ];
}
