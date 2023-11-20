<?php

namespace App\Repositories;

use App\Models\Page;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function getAllPages($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
    public function getPageById(string $id)
    {
        // TODO: Implement getPageById() method.
        $page=$this->model->where('id',$id)->get();
        return $page;
    }
}
