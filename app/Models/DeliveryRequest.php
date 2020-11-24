<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{
    use HasFactory;

    public function delivery()
    {
        return $this->hasOne('App\Models\Delivery');
    }

    public function Supplies()
    {
        return $this->belongsToMany('App\Models\Supplies', 'supply_delivery_requests', 
                                    'supply_id', 'delivery_request_id');
    }
}
