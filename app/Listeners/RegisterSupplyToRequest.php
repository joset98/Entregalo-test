<?php

namespace App\Listeners;

use App\Events\RegisterSupply;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterSupplyToRequest
{
    private $supplyDeliveryRequestRepo = null;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SupplyDeliveryRequestRepository $repository)
    {
        $this->supplyDeliveryRequestRepo = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  RegisterSupply  $event
     * @return void
     */
    public function handle(RegisterSupply $event)
    {
        $this->supplyDeliveryRequestRepo->updateOrCreate(
            [
                'delivery_request_id' => $event->deliveryRequestId,
                'supply_id' => $event->supply->id,
            ],
            ['quantity' => $event->supply->quantity]
        );
    }
}