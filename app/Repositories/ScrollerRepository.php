<?php

namespace App\Repositories;

use App\Models\Scroller;
use App\Repositories\Interfaces\ScrollerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ScrollerRepository extends BaseRepository implements ScrollerRepositoryInterface
{
    public function __construct(Scroller $model)
    {
        parent::__construct($model);
    }
    public function getAllScrollers($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }

}
