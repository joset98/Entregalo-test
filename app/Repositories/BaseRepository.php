<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepositoryInterface;


class BaseRepository implements BaseRepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function insert( $array )
    {
        return $this->model->insert( $array );
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $object_to_update = $this->find($id);
        return $object_to_update->fill($data)->save();
    }

    public function updateOrCreate(array $matchAttributes, array $data)
    {
        $model::updateOrInsert( $matchAttributes , $data );
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
