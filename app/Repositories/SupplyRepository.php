<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Models\Supply;

class SupplyRepository extends BaseRepository
{
    public function __construct (Supply $model)
    {
        $this->model = $model;
    }

} 


