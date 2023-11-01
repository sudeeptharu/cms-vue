<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{

    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }
    public function getAllMenus()
    {
        return $this->model->all();
    }
}
