<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct (User $model)
    {
        $this->model = $model;
    }
    
} 


