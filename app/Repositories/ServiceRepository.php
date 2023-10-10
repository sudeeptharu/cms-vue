<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{

    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
    public function getAllServices($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
