<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\DeliveryRequestRepository;
use App\Repositories\SupplyRepository;
use App\Events\RegisterSupply;
use Carbon\Carbon;

class DeliveryRequestController extends Controller
{
    protected $deliveryRequestRepository = null;
    protected $supplyRepository = null;

    protected function getCreationOrUpdaData($request) {
        $deliveryRequestData = [
            'id'     =>    $request->delivery_request_id,
            'status' =>    $request->status,
            'date'   =>    now(),
            'delivery_time'    =>    $request->delivery_time,
            'description'    =>    $request->description,
            // 'status_id'         =>    $request->status_id
        ];

        return $deliveryRequestData;
    }

    protected function mapAttributes($array, $id)
    {
        return array_map(function ( $supply_id, $quantity){
            return [
                'delivery_request_id' => $id,
                'supply_id' => supply_id,
                'quantity' => $quantity,
            ];
        }, $array);
    } 

    /**
    * 
    */
    public function __construct (
        DeliveryRequestRepositrory $deliveryRequestRepository, 
        SupplyRepository $supplyRepository)
    {
        $this->deliveryRequestRepository = $repository;
        $this->supplyRepository = $supplyRepository;
    }

    public function addToRequest(Request $request)
    {
        $supply = $supplyRepository->find($request->product_id); 
        $deliveryRequest = $this->deliveryRequestRepository->find($request->delivery_request_id); 
        $quantity_supply = $request->quantity_supply;
        $supplyToRequest = [
            'supply_id' => $supply->id,
            'quantity' => $quantity_supply,
        ];

        event(new RegisterSupply( $supplyToRequest, $deliveryRequest));

        if( ! ( $product ) )
            return response()->json(['errorMessage' => 'la orden o el articulo no existe', 
            ], 404);

        $deliveryRequest->save();
        // $listProduct->save();
        
        return response()->json(['status' => 'ok', 
            'data' => $deliveryRequest
        ], 200);
        
    }

    public function index()
    {
        $user = Auth::user();
        $deliveryRequest = null;

        if( $user->role == 'ADMIN')
        {
            $deliveryRequest = $this->deliveryRequestRepository->getDeliveryRequest(new Carbon('yesterday'));
            // dd($deliveryRequest);
            return view('admin.deliveryRequest.index', ['delivery_request' => $deliveryRequest]);
        }

        $deliveryRequest = $this->deliveryRequestRepository->getDeliveryRequestByUser( $user->id );
        return view('deliveryRequest.index', ['delivery_request' => $deliveryRequest]);
    
    }

    public function edit( $id )
    {
        $deliveryRequest = $this->deliveryRequestRepository->find( $id );
        return view('admin.delivery.edit', ['delivery_request' => $deliveryRequest]);
    }

    public function store( Request $request)
    {

        $newObject = $deliveryRequestRepository->create( $this->getCreationOrUpdaData( $request ));
        $supplies = $request->supplies;
        
        $deliveryRequestRepository->insert( 
            $this->mapAttributes($supplies , $newObjectId)
        );

        return redirect('some/url');
    }

    public function approveDeliveryRequest ()
    {

    }

    public function destroy ( $id )
    {
        $supply = $deliveryRequestRepository->delete( $id );
        dd( $supply );
    }

    public function update(Request $request, $id)
    {
        $supply = $deliveryRequestRepository->update( $request->all() , $id );
        
        return redirect('some/url');
    }

}
