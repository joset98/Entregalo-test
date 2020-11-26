<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Models\SupplyDeliveryRequest;

class SupplyDeliveryRequestRepository extends BaseRepository
{
    public function __construct (SupplyDeliveryRequest $model)
    {
        $this->model = $model;
    }

    public function isAddToRequest( $supply, $request )
    {
        return 
            $model::where([
                ['product_id', $supply->id], 
                ['product_id', $request] 
            ])->first(); 
    }

} 
