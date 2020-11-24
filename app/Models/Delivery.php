<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public function deliveryRequest()
    {
        return $this->belongsTo('App\Models\DeliveryRequest');
    }
    
}
