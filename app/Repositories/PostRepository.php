<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
    public function getAllPost(int $paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
