<?php

namespace App\Repositories;

use App\Models\Gallery;
use App\Repositories\Interfaces\GalleryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{

    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }
    public function getAllGalleries($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
