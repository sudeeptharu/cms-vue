<?php

namespace App\Repositories;

use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LinkRepository extends BaseRepository implements LinkRepositoryInterface
{

    public function __construct(Link $model)
    {
        parent::__construct($model);
    }

    public function getAllLinks($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
