<?php

namespace App\Repositories\Interfaces;

interface PageRepositoryInterface
{

    public function getAllPages(int $paginator);
    public function getPageById(string $id);
}
