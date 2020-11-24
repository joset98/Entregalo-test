<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Models\Delivery;

class DeliveryRepository extends BaseRepository
{
    public function __construct (Delivery $model)
    {
        $this->model = $model;
    }

    private function getDeliveryJoin()
    {
        return $this->model::join( 'users', 'delivery_requests.user_id', 'users.id' )
                            ->join( 'supply_delivery_requests', 'supply_delivery_requests.delivery_request_id', 
                                    'delivery_requests.id' )
                            ->join( 'supplies', 'supplies.id' , 'supply_delivery_requests.supply_id' );
    }

    private function getSelectDelivery()
    {
        return $this->DeliveryRequest()
                    ->select( 'deliveries.cost', 'deliveries.delivery_time','deliveries.observation',
                    'supply_delivery_requests.quantity', 'deliveries.status' );
    }
    
    public function getDelivery()
    {
        return $this->getSelectDelivery()
                    ->addSelect( 'users.name', 'users.last_name' );
    }

    public function getDeliveryByUser( $id )
    {
        return $this->getSelectDelivery()
                    ->where( 'users.id' , $id);
    }
} 


