<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    
    public function DeliveryRequests()
    {
        return $this->belongsToMany('App\Models\DeliveryRequest', 'supply_delivery_requests', 
                                    'supply_id', 'delivery_request_id');
    }
}
