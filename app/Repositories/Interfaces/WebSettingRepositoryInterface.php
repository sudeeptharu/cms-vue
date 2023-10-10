<?php

namespace App\Repositories\Interfaces;

interface WebSettingRepositoryInterface
{
    public function getAllWebSettings(int $paginator);
}
