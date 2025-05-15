<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerVisits extends Model
{
     protected $table = "partner_visits";
    protected $fillable = [
        'partner_id',
        'ip_address',
        'user_agent',
        'visited_at',
    ];
}
