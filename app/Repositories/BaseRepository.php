<?php

namespace App\Repositories;

//use App\Exceptions\ErrorPageException;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $cols = null)
    {
        try {
            return isset($cols) ? $this->model->all($cols) : $this->model->all();
        } catch (\Exception $ex) {
            throw new ModelNotFoundException('model not found');
        }
    }
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    public function update( $id,array $attributes)
    {
        return $this->model->where('id',$id)->update($attributes);
    }
    public function destroy($id)
    {
        return $this->model->where('id',$id)->delete();
    }
}
