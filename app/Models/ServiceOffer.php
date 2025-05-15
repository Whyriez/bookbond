<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOffer extends Model
{
    protected $table = "service_offer";
    protected $fillable = [
        'name'
    ];
}
