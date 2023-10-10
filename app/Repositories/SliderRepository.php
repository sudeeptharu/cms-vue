<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Repositories\Interfaces\SliderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{

    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }
    public function getAllSliders($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
