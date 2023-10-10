<?php

namespace App\Repositories;

use App\Models\Video;
use App\Repositories\Interfaces\VideoRepositoryInterface;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    public function __construct(Video $model)
    {
        parent::__construct($model);
    }
    public function getAllVideos($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
