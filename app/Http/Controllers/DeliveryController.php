<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\DeliveryRepository;

class DeliveryController extends Controller
{
    protected $deliveryRepository = null;

    protected function getCreationOrUpdaData($request) {
        $deliveryRequestData = [
            'status' =>    $request->status,
            'cost'   =>    $request->cost,
            'delivery_time'    =>    $request->delivery_time,
            'observation'    =>    $request->observation,
        ];

        return $deliveryData;
    }

    public function __construct (DeliveryRepository $repository)
    {
        $this->deliveryRepository = $repository;
    }
    
    public function index()
    {
        $user = Auth::user();
        $deliveries = null;

        if( $user->role == 'ADMIN')
        {
            $deliveries = $this->deliveryRepository->getDelivery();
            // dd(deliveries);    
            return view('admin.delivery.index', ['deliveries' => $deliveries]);
        }

        $deliveries = $this->deliveryRepository->getDeliveryByUser( $id );
        dd(deliveries);
        return view('delivery.index', ['deliveries' => $deliveries]);
    
    }

    public function edit($id)
    {
        $delivery = $this->deliveryRepository->find( $id );
        return view('admin.delivery.edit', ['delivery' => $delivery]);
    }

    public function store( $id )
    {
        $deliveryRequestRepository->create( $id );
        return redirect('some/url');
    }
    
    public function update(Request $request, $id)
    {
        $delivery = $deliveryRepository->update( $request->all() , $id );
        
        return redirect('some/url');
    }

    public function destroy ( $id )
    {
        $delivery = $deliveryRepository->delete( $id );
        dd( $supply );
    }


}
