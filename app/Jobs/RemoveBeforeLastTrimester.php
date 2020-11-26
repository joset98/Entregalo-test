<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\DeliveryRequestRepository;
use Carbon\Carbon;

class RemoveBeforeLastTrimester implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $repository = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DeliveryRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $berforeQuarter = new Carbon('-3 months');
        // $berforeQuarter->month($berforeQuarter->month-3);
        $this->repository->removeBeforeDate($berforeQuarter);
    }
}
