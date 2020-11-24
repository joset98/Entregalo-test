<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Models\DeliveryRequest;

class DeliveryRequestRepository extends BaseRepository
{
    public function __construct (DeliveryRequest $model)
    {
        $this->model = $model;
    }

    private function deliveryRequest()
    {
        return $this->model::join( 'users', 'delivery_requests.user_id', 'users.id' )
                            ->join( 'supply_delivery_requests', 'supply_delivery_requests.delivery_request_id', 
                                    'delivery_requests.id' )
                            ->join( 'supplies', 'supplies.id' , 'supply_delivery_requests.supply_id' );
    }

    private function getSelectDeliveryRequest()
    {
        return $this->DeliveryRequest()
                    ->select( 'delivery_requests.delivery_time', 'delivery_requests.description',
                    'supply_delivery_requests.quantity' );
    }

    public function getDeliveryRequest()
    {
        return $this->getSelectDeliveryRequest()
                    ->addSelect( 'users.name', 'users.last_name' );
    }

    public function getDeliveryRequestByUser( $id )
    {
        return $this->getSelectDeliveryRequest()
                    ->where( 'users.id' , $id);
    }

} 
