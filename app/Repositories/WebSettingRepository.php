<?php

namespace App\Repositories;

use App\Models\WebSetting;
use App\Repositories\Interfaces\WebSettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class WebSettingRepository extends BaseRepository implements WebSettingRepositoryInterface
{
    public function __construct(WebSetting $model)
    {
        parent::__construct($model);
    }
    public function getAllWebSettings($paginator)
    {
        return $this->model->orderBy('id','DESC')->paginate($paginator);
    }
}
